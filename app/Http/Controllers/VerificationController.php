<?php

namespace App\Http\Controllers;

use App\Models\LetterRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerificationController extends Controller
{
    public function verify($unique_code)
    {
        // 1. Cari surat berdasarkan unique_code
        $letterRequest = LetterRequests::where('unique_code', $unique_code)->first();

        // Inisialisasi status default
        $status = 'invalid';
        $message = 'Kode verifikasi tidak valid atau dokumen tidak ditemukan.';
        $documentUrl = null;

        if ($letterRequest) {
            if ($letterRequest->status === 'completed' && $letterRequest->final_document_path) {
                $documentContent = Storage::disk('public')->get($letterRequest->final_document_path);

                // 3. Hitung hash dari konten dokumen yang tersimpan
                $calculatedHash = hash('sha256', $documentContent);

                // 4. Bandingkan hash yang dihitung dengan hash di database
                if ($calculatedHash === $letterRequest->blockchain_hash) {
                    $status = 'valid';
                    $message = 'Dokumen ini resmi dan telah disetujui.';
                } else {
                    $status = 'mismatched';
                    $message = 'Dokumen ini telah diubah dan tidak valid.';
                }

                $documentUrl = Storage::url($letterRequest->final_document_path);
            } else {
                $message = 'Dokumen ini belum disetujui atau tidak lengkap.';
            }
        }

        $data = [
            'letter' => $letterRequest,
            'status' => $status,
            'message' => $message,
            'documentUrl' => $documentUrl,
        ];

        return view('verification.result', $data);
    }
}
