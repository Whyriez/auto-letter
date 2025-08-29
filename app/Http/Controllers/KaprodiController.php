<?php

namespace App\Http\Controllers;

use App\Models\LetterRequests;
use App\Models\LetterTemplate;
use App\Models\NomorSuratCounter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class KaprodiController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::user()->id;

        $letterTemplateIds = LetterTemplate::where('forward_to', $userId)->pluck('id');

        $letterTemplates = LetterTemplate::all();

        $baseQuery = LetterRequests::whereIn('letter_template_id', $letterTemplateIds);

        $pendingCount = (clone $baseQuery)->where('status', 'pending')->count();
        $approvedTodayCount = (clone $baseQuery)
            ->where('status', 'approved')
            ->whereDate('updated_at', now()->toDateString())
            ->count();
        $totalThisMonthCount = (clone $baseQuery)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $query = (clone $baseQuery)->where('status', 'pending')
            ->with('user', 'letterTemplate')
            ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('letter_template')) {
            $query->where('letter_template_id', $request->input('letter_template'));
        }

        $pendingRequests = $query->paginate(10)->withQueryString();

        return view('ketua_staff.kaprodi.index', compact('pendingRequests', 'letterTemplates', 'pendingCount', 'approvedTodayCount', 'totalThisMonthCount'));
    }

    public function approveAndExportPdf($id)
    {
        $letterRequest = LetterRequests::with(['user', 'letterTemplate.letterType'])
            ->findOrFail($id);

        if ($letterRequest->status !== 'pending') {
            $notification = [
                'message' => 'Surat ini sudah disetujui atau diproses.',
                'type' => 'error'
            ];
            return redirect()->back()->with('notification', $notification);
        }

        $userId = Auth::user()->id;
        $signer = User::findOrFail($userId);

        $tahun = now()->year;
        $templateId = $letterRequest->letterTemplate->id;

        $counter = NomorSuratCounter::firstOrCreate(
            ['letter_template_id' => $templateId, 'tahun' => $tahun],
            ['nomor_terakhir' => 0]
        );
        $counter->nomor_terakhir++;
        $counter->save();

        $nomor = $counter->nomor_terakhir;
        $kodeSeri = $letterRequest->letterTemplate->kode_seri;
        $kodeUnit = $letterRequest->letterTemplate->kode_unit;
        $kodeArsip = $letterRequest->letterTemplate->kode_arsip;
        $nomorSurat = $kodeSeri . '/' . $nomor . '/' . $kodeUnit . '/' . $kodeArsip . '/' . $tahun;
        $logoPath = public_path('images/logo-ung.jpeg');
        $logoBase64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPath));

        $signaturePath = public_path($signer->signature_image_path);

        if (file_exists($signaturePath)) {
            $signatureBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($signaturePath));
        } else {
            $signatureBase64 = null;
        }

        $mainStudent = $letterRequest->user;
        $requestDetails = $letterRequest->request_details;
        $additionalStudents = $requestDetails['additional_students'] ?? [];
        $location = $requestDetails['location'] ?? 'tidak tersedia';
        $waktu = $requestDetails['waktu'] ?? 'tidak tersedia';
        $researchLecturer = $requestDetails['research_lecturer'] ?? 'tidak tersedia';
        $course = $requestDetails['course'] ?? 'tidak tersedia';

        $verificationUrl = route('verify.check', ['unique_code' => $letterRequest->unique_code]);

        $studentTableHtml = '<table style="width: 100%; border-collapse: collapse; table-layout: fixed; margin: 0; padding: 0;">';
        $studentTableHtml .= '<tr>';
        $studentTableHtml .= '<td style="width: 5%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">' . 1 . '.</td>';
        $studentTableHtml .= '<td style="width: 30%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">' . $mainStudent->name . '</td>';
        $studentTableHtml .= '<td style="width: 65%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">NIM. ' . $mainStudent->nim_nip . '</td>';
        $studentTableHtml .= '</tr>';
        $counter = 1;
        if (!empty($additionalStudents)) {
            foreach ($additionalStudents as $student) {
                $counter++;
                $studentTableHtml .= '<tr>';
                $studentTableHtml .= '<td style="width: 5%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">' . $counter . '.</td>';
                $studentTableHtml .= '<td style="width: 30%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">' . $student['name'] . '</td>';
                $studentTableHtml .= '<td style="width: 65%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">NIM. ' . ($student['nim'] ?? '') . '</td>';
                $studentTableHtml .= '</tr>';
            }
        }
        $studentTableHtml .= '</table>';

        $jabatan = $signer->role;

        if ($jabatan === 'kajur') {
            $jabatan = 'Ketua Jurusan' . ' ' . $signer->jurusan;
        } elseif ($jabatan === 'kaprodi') {
            $jabatan = 'Ketua Program Studi' . ' ' . $signer->prodi;
        }

        $replacements = [
            '{{ DAFTAR_MAHASISWA }}' => $studentTableHtml,
            '{{ LOKASI }}' => $location,
            '{{ WAKTU }}' => $waktu,
            '{{ DOSEN_PEMBIMBING }}' => $researchLecturer,
            '{{ MATA_KULIAH }}' => $course,
            '{{ NAMA_DOSEN }}' => $signer->name,
            '{{ JABATAN }}' => $jabatan,
        ];
        $rawContent = $letterRequest->letterTemplate->konten;
        $processedContent = str_replace(array_keys($replacements), array_values($replacements), $rawContent);

        $lines = explode('<p>', $processedContent);
        $finalBodyContent = '';
        foreach ($lines as $line) {
            if (empty(trim($line))) continue;

            if (Str::contains($line, '{{ SPASI_PENYELARAS }}')) {
                $parts = explode('{{ SPASI_PENYELARAS }}', $line);
                $finalBodyContent .= '<table style="width: 100%; border-collapse: collapse;"><tr>';
                $finalBodyContent .= '<td style="width: 20%; padding: 0;">' . str_replace('</p>', '', $parts[0]) . '</td>';
                $finalBodyContent .= '<td style="padding: 0;">:' . str_replace('</p>', '', $parts[1]) . '</td>';
                $finalBodyContent .= '</tr></table>';
            } else {
                $finalBodyContent .= '<p style="margin: 0; line-height: 1.5;">' . str_replace('</p>', '', $line) . '</p>';
            }
        }
        $data = [
            'logo_base64' => $logoBase64,
            'nomor_surat' => $nomorSurat,
            'nama_surat' => $letterRequest->letterTemplate->nama_surat,
            'date' => now()->format('d F Y'),
            'perihal' => $letterRequest->letterTemplate->perihal,
            'tujuan_nama' => $letterRequest->letterTemplate->tujuan_nama,
            'tujuan_lokasi' => $letterRequest->letterTemplate->tujuan_lokasi,
            'bodyContent' => $finalBodyContent,
            'signer' => $signer,
            'signature_base64' => $signatureBase64,
            'verificationUrl' => $verificationUrl,
        ];

        $pdf = PDF::loadView('surat.template', $data);
        $pdfContent = $pdf->output();
        $documentHash = hash('sha256', $pdfContent);

        // ** Contoh konsep untuk ID Transaksi dari blockchain **
        $blockchainTxId = Str::uuid();

        $fileName = 'Surat_' . $letterRequest->unique_code . '.pdf';
        Storage::disk('public')->put('documents/' . $fileName, $pdfContent);

        $letterRequest->nomor_surat = $nomorSurat;
        $letterRequest->status = 'completed';
        $letterRequest->final_document_path = 'documents/' . $fileName;
        $letterRequest->blockchain_hash = $documentHash;
        $letterRequest->blockchain_tx_id = $blockchainTxId;
        $letterRequest->save();

        $notification = [
            'message' => 'Surat berhasil disetujui dan disimpan.',
            'type' => 'success'
        ];
        return redirect()->back()->with('notification', $notification);
    }

    public function rejected(Request $request, $id)
    {
        $letterRequest = LetterRequests::findOrFail($id);

        if ($letterRequest->status !== 'pending') {
            $notification = [
                'message' => 'Surat ini sudah disetujui atau diproses sebelumnya.',
                'type' => 'error'
            ];
            return redirect()->back()->with('notification', $notification);
        }

        if (!$request->has('notes') || empty($request->input('notes'))) {
            $notification = [
                'message' => 'Catatan penolakan tidak boleh kosong.',
                'type' => 'error'
            ];
            return redirect()->back()->with('notification', $notification);
        }

        $letterRequest->status = 'rejected';
        $letterRequest->notes = $request->input('notes');
        $letterRequest->save();

        $notification = [
            'message' => 'Surat berhasil ditolak.',
            'type' => 'success'
        ];
        return redirect()->back()->with('notification', $notification);
    }

    public function previewSurat($id)
    {
        $letterRequest = LetterRequests::with(['user', 'letterTemplate.letterType'])
            ->findOrFail($id);

        if ($letterRequest->status !== 'pending') {
            $notification = [
                'message' => 'Surat ini sudah disetujui atau diproses.',
                'type' => 'error'
            ];
            return redirect()->back()->with('notification', $notification);
        }

        $userId = Auth::user()->id;
        $signer = User::findOrFail($userId);

        $tahun = now()->year;

        $nomor = "****";
        $kodeSeri = $letterRequest->letterTemplate->kode_seri;
        $kodeUnit = $letterRequest->letterTemplate->kode_unit;
        $kodeArsip = $letterRequest->letterTemplate->kode_arsip;
        $nomorSurat = $kodeSeri . '/' . $nomor . '/' . $kodeUnit . '/' . $kodeArsip . '/' . $tahun;
        $logoPath = public_path('images/logo-ung.jpeg');
        $logoBase64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPath));

        $signaturePath = public_path($signer->signature_image_path);

        if (file_exists($signaturePath)) {
            $signatureBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($signaturePath));
        } else {
            $signatureBase64 = null;
        }

        $mainStudent = $letterRequest->user;
        $requestDetails = $letterRequest->request_details;
        $additionalStudents = $requestDetails['additional_students'] ?? [];
        $location = $requestDetails['location'] ?? 'tidak tersedia';
        $waktu = $requestDetails['waktu'] ?? 'tidak tersedia';
        $researchLecturer = $requestDetails['research_lecturer'] ?? 'tidak tersedia';
        $course = $requestDetails['course'] ?? 'tidak tersedia';

        $verificationUrl = route('verify.check', ['unique_code' => $letterRequest->unique_code]);

        $studentTableHtml = '<table style="width: 100%; border-collapse: collapse; table-layout: fixed; margin: 0; padding: 0;">';
        $studentTableHtml .= '<tr>';
        $studentTableHtml .= '<td style="width: 5%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">' . 1 . '.</td>';
        $studentTableHtml .= '<td style="width: 30%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">' . $mainStudent->name . '</td>';
        $studentTableHtml .= '<td style="width: 65%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">NIM. ' . $mainStudent->nim_nip . '</td>';
        $studentTableHtml .= '</tr>';
        $counter = 1;
        if (!empty($additionalStudents)) {
            foreach ($additionalStudents as $student) {
                $counter++;
                $studentTableHtml .= '<tr>';
                $studentTableHtml .= '<td style="width: 5%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">' . $counter . '.</td>';
                $studentTableHtml .= '<td style="width: 30%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">' . $student['name'] . '</td>';
                $studentTableHtml .= '<td style="width: 65%; padding: 0; margin: 0; line-height: 1.2; vertical-align: top;">NIM. ' . ($student['nim'] ?? '') . '</td>';
                $studentTableHtml .= '</tr>';
            }
        }
        $studentTableHtml .= '</table>';

        $jabatan = $signer->role;

        if ($jabatan === 'kajur') {
            $jabatan = 'Ketua Jurusan' . ' ' . $signer->jurusan;
        } elseif ($jabatan === 'kaprodi') {
            $jabatan = 'Ketua Program Studi' . ' ' . $signer->prodi;
        }

        $replacements = [
            '{{ DAFTAR_MAHASISWA }}' => $studentTableHtml,
            '{{ LOKASI }}' => $location,
            '{{ WAKTU }}' => $waktu,
            '{{ DOSEN_PEMBIMBING }}' => $researchLecturer,
            '{{ MATA_KULIAH }}' => $course,
            '{{ NAMA_DOSEN }}' => $signer->name,
            '{{ JABATAN }}' => $jabatan,
        ];
        $rawContent = $letterRequest->letterTemplate->konten;
        $processedContent = str_replace(array_keys($replacements), array_values($replacements), $rawContent);

        $lines = explode('<p>', $processedContent);
        $finalBodyContent = '';
        foreach ($lines as $line) {
            if (empty(trim($line))) continue;

            if (Str::contains($line, '{{ SPASI_PENYELARAS }}')) {
                $parts = explode('{{ SPASI_PENYELARAS }}', $line);
                $finalBodyContent .= '<table style="width: 100%; border-collapse: collapse;"><tr>';
                $finalBodyContent .= '<td style="width: 20%; padding: 0;">' . str_replace('</p>', '', $parts[0]) . '</td>';
                $finalBodyContent .= '<td style="padding: 0;">:' . str_replace('</p>', '', $parts[1]) . '</td>';
                $finalBodyContent .= '</tr></table>';
            } else {
                $finalBodyContent .= '<p style="margin: 0; line-height: 1.5;">' . str_replace('</p>', '', $line) . '</p>';
            }
        }
        $data = [
            'logo_base64' => $logoBase64,
            'nomor_surat' => $nomorSurat,
            'nama_surat' => $letterRequest->letterTemplate->nama_surat,
            'date' => now()->format('d F Y'),
            'perihal' => $letterRequest->letterTemplate->perihal,
            'tujuan_nama' => $letterRequest->letterTemplate->tujuan_nama,
            'tujuan_lokasi' => $letterRequest->letterTemplate->tujuan_lokasi,
            'bodyContent' => $finalBodyContent,
            'signer' => $signer,
            'signature_base64' => $signatureBase64,
            'verificationUrl' => $verificationUrl,
        ];

        $pdf = PDF::loadView('surat.preview_template', $data);
        $pdfContent = $pdf->output();
        return $pdf->stream('Surat_' . $letterRequest->unique_code . '.pdf');
    }
}
