<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SuperAdminController extends Controller
{

    public function index(Request $request)
    {
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalActiveUsers = User::where('status', 'active')->count();
        $totalInactiveUsers = User::where('status', 'inactive')->count();
        $totalSuspendedUsers = User::where('is_suspend', 1)->count();

        $rawRoleCounts = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        $roles = ['mahasiswa', 'admin_jurusan', 'kaprodi', 'kajur'];
        $roleCounts = collect($roles)
            ->mapWithKeys(fn($r) => [$r => $rawRoleCounts[$r] ?? 0])
            ->all();

        return view('admin.super.index', compact('totalMahasiswa', 'totalActiveUsers', 'totalInactiveUsers', 'totalSuspendedUsers', 'roleCounts'));
    }
    public function user(Request $request)
    {
        $query = User::orderBy('created_at', 'asc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nim_nip', 'like', '%' . $search . '%')
                    ->orWhere('jurusan', 'like', '%' . $search . '%')
                    ->orWhere('prodi', 'like', '%' . $search . '%');
            });
        }


        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $statusMap = [
                'active' => 0,
                'inactive' => 1,
            ];
            if (isset($statusMap[$request->status])) {
                $query->where('is_suspend', $statusMap[$request->status]);
            }
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.super.users', compact('users'));
    }



    public function submit_new_user(Request $request)
    {
        $validatedData = $request->validate([
            'user-name' => ['required', 'string', 'max:255'],
            'user-email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'user-role' => ['required', 'string', Rule::in(['super_admin', 'admin_jurusan', 'kaprodi', 'kajur', 'mahasiswa'])],
            'user-status' => ['required', 'string'],
            'password' => ['required', 'string'],
            'nim_nip' => ['nullable', 'string', 'max:255', 'unique:users,nim_nip'],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'prodi' => ['nullable', 'string', 'max:255'],
        ], [
            'user-email.unique' => 'Email ini sudah terdaftar.',
            'nim_nip.unique' => 'NIM/NIP ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.'
        ]);

        try {
            $role = $validatedData['user-role'];
            $userData = [
                'name' => $validatedData['user-name'],
                'email' => $validatedData['user-email'],
                'role' => $role,
                'status' => $validatedData['user-status'],
                'password' => Hash::make($validatedData['password']),
            ];

            switch ($role) {
                case 'mahasiswa':
                case 'kaprodi':
                    $userData['nim_nip'] = $validatedData['nim_nip'];
                    $userData['jurusan'] = $validatedData['jurusan'];
                    $userData['prodi'] = $validatedData['prodi'];
                    break;

                case 'kajur':
                case 'admin_jurusan':
                    $userData['nim_nip'] = $validatedData['nim_nip'];
                    $userData['jurusan'] = $validatedData['jurusan'];
                    $userData['prodi'] = null;
                    break;

                case 'super_admin':
                default:
                    $userData['nim_nip'] = null;
                    $userData['jurusan'] = null;
                    $userData['prodi'] = null;
                    break;
            }

            $user = User::create($userData);

            $notification = [
                'message' => 'Pengguna "' . $user->name . '" berhasil dibuat!',
                'type' => 'success'
            ];

            return redirect()->route('super_admin.users')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan pada server, pengguna gagal dibuat.',
                'type' => 'error'
            ];

            return back()->with('notification', $notification)->withInput();
        }
    }

    public function show_user($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'user-name'   => ['required', 'string', 'max:255'],
            'user-email'  => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'user-role'   => ['required', 'string', Rule::in(['super_admin', 'admin_jurusan', 'kaprodi', 'kajur', 'mahasiswa'])],
            'user-status' => ['required', 'string'],
            'password'    => ['nullable', 'string'],
            'nim_nip'     => ['nullable', 'string', 'max:255', Rule::unique('users', 'nim_nip')->ignore($user->id)],
            'jurusan'     => ['nullable', 'string', 'max:255'],
            'prodi'       => ['nullable', 'string', 'max:255'],
        ], [
            'user-email.unique' => 'Email ini sudah terdaftar.',
            'nim_nip.unique'    => 'NIM/NIP ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.'
        ]);

        try {
            $role = $validatedData['user-role'];

            $updateData = [
                'name'   => $validatedData['user-name'],
                'email'  => $validatedData['user-email'],
                'role'   => $role,
                'status' => $validatedData['user-status'],
            ];

            if (!empty($validatedData['password'])) {
                $updateData['password'] = Hash::make($validatedData['password']);
            }

            switch ($role) {
                case 'mahasiswa':
                case 'kaprodi':
                    $updateData['nim_nip'] = $validatedData['nim_nip'];
                    $updateData['jurusan'] = $validatedData['jurusan'];
                    $updateData['prodi']   = $validatedData['prodi'];
                    break;

                case 'kajur':
                case 'admin_jurusan':
                    $updateData['nim_nip'] = $validatedData['nim_nip'];
                    $updateData['jurusan'] = $validatedData['jurusan'];
                    $updateData['prodi']   = null;
                    break;

                case 'super_admin':
                default:
                    $updateData['nim_nip'] = null;
                    $updateData['jurusan'] = null;
                    $updateData['prodi']   = null;
                    break;
            }

            $user->update($updateData);

            $notification = [
                'message' => 'Pengguna "' . $user->name . '" berhasil diperbarui!',
                'type'    => 'success'
            ];

            return redirect()->route('super_admin.users')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan pada server, pengguna gagal diperbarui.',
                'type'    => 'error'
            ];

            return back()->with('notification', $notification)->withInput();
        }
    }


    public function delete_user($id)
    {
        $user  = User::findOrFail($id);
        $username = $user->name;
        $user->delete();

        $notification = [
            'message' => 'Pengguna ' . $username . ' telah dihapus!',
            'type' => 'success'
        ];

        return redirect()->route('super_admin.users')->with('notification', $notification);
    }

    public function toggleSuspend(Request $request, $id)
    {
        $validated = $request->validate([
            'is_suspend' => ['required', Rule::in([0, 1])],
        ]);

        try {
            $user = User::findOrFail($id);

            if ($user->role === 'super_admin') {
                return back()->with('notification', [
                    'message' => 'Super Admin tidak dapat diblokir atau disuspend.',
                    'type' => 'error'
                ]);
            }

            $user->is_suspend = $validated['is_suspend'];
            $user->save();

            $statusText = $user->is_suspend ? 'diblokir' : 'diaktifkan';

            return back()->with('notification', [
                'message' => 'Pengguna "' . $user->name . '" telah berhasil ' . $statusText . '!',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            return back()->with('notification', [
                'message' => 'Gagal mengubah status pengguna.',
                'type' => 'error'
            ]);
        }
    }

    public function updateRole(Request $request, $id)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(['super_admin', 'admin_jurusan', 'kaprodi', 'kajur', 'mahasiswa'])],
        ]);

        try {
            $user = User::findOrFail($id);
            $user->role = $validated['role'];
            $user->save();

            return response()->json(['message' => 'Peran untuk ' . $user->name . ' telah berhasil diubah!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengubah peran.'], 500);
        }
    }

    public function importMahasiswa(Request $request)
    {
        // 1) Validasi dasar input
        $request->validate([
            'file'  => ['required', 'file', 'mimes:csv,txt,xlsx,xls', 'max:5120'],
            'sheet' => ['nullable', 'string'],
        ]);

        $file  = $request->file('file');
        $sheet = $request->input('sheet'); // nama sheet yang dipilih dari modal

        // 2) Load workbook
        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
        } catch (\Throwable $e) {
            $notification = [
                'message' => 'Gagal membaca file. Pastikan format CSV/XLSX sesuai.',
                'type'    => 'error',
            ];
            return back()->with('notification', $notification);
        }

        // 3) Tentukan sheet yang dipakai
        try {
            if ($sheet && in_array($sheet, $spreadsheet->getSheetNames(), true)) {
                $ws = $spreadsheet->getSheetByName($sheet);
            } else {
                $ws = $spreadsheet->getSheet(0); // fallback ke sheet pertama
            }
        } catch (\Throwable $e) {
            $notification = [
                'message' => 'Sheet yang dipilih tidak ditemukan di file.',
                'type'    => 'error',
            ];
            return back()->with('notification', $notification);
        }

        // 4) Ambil semua baris sebagai array (header + data)
        $rows = $ws->toArray(null, true, true, true); // keys: A,B,C,...
        if (empty($rows) || count($rows) < 2) {
            $notification = [
                'message' => 'Tidak ada data untuk diimpor (file kosong).',
                'type'    => 'error',
            ];
            return back()->with('notification', $notification);
        }

        // 5) Validasi header HARUS sesuai template
        //    Urutan & nama kolom: name, email, nim, prodi, jurusan
        $expected = ['name', 'email', 'nim', 'prodi', 'jurusan'];

        $headerRow = array_shift($rows); // ambil baris pertama sebagai header
        // Normalisasi header: ambil dari kolom A..E saja
        $header = [
            $this->normHeader($headerRow['A'] ?? ''),
            $this->normHeader($headerRow['B'] ?? ''),
            $this->normHeader($headerRow['C'] ?? ''),
            $this->normHeader($headerRow['D'] ?? ''),
            $this->normHeader($headerRow['E'] ?? ''),
        ];

        if ($header !== $expected) {
            $notification = [
                'message' => 'Header tidak sesuai template. Periksa kembali sheet yang digunakan atau silahkan gunakan template yang sudah disediakan',
                'type'    => 'error',
            ];
            return back()->with('notification', $notification);
        }

        // 6) Parsing baris data + validasi per baris ringan
        $errors         = [];
        $fileRows       = []; // data bersih dari file (unik per nim)
        $seenNimsInFile = []; // untuk dedup di DALAM file

        $lineNumber = 1; // sudah tarik header, baris data mulai 2
        foreach ($rows as $r) {
            $lineNumber++;

            $name   = trim((string)($r['A'] ?? ''));
            $email  = trim((string)($r['B'] ?? ''));
            $nim    = trim((string)($r['C'] ?? ''));
            $prodi  = trim((string)($r['D'] ?? ''));
            $jur    = trim((string)($r['E'] ?? ''));

            // lewati baris kosong total
            if ($name === '' && $email === '' && $nim === '' && $prodi === '' && $jur === '') {
                continue;
            }

            // Validasi ringkas
            if ($name === '' || $email === '' || $nim === '' || $prodi === '' || $jur === '') {
                $errors[] = "Baris {$lineNumber}: kolom wajib ada yang kosong.";
                continue;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Baris {$lineNumber}: format email tidak valid.";
                continue;
            }
            // nim minimal 5-12, boleh angka/string (karena bisa leading zero), contoh template 9 digit mulai '5'
            if (strlen($nim) < 5 || strlen($nim) > 20) {
                $errors[] = "Baris {$lineNumber}: NIM tidak wajar (panjang 5-20).";
                continue;
            }

            // Dedup di dalam file (berdasarkan NIM)
            $nimKey = mb_strtolower($nim);
            if (isset($seenNimsInFile[$nimKey])) {
                // sudah ada → skip baris ini
                continue;
            }
            $seenNimsInFile[$nimKey] = true;

            $fileRows[] = [
                'name'   => $name,
                'email'  => $email,
                'nim'    => $nim,     // akan dipetakan ke nim_nip
                'prodi'  => $prodi,
                'jur'    => $jur,
                'line'   => $lineNumber,
            ];
        }

        if (empty($fileRows)) {
            $notification = [
                'message' => 'Tidak ada baris valid yang bisa diimpor.',
                'type'    => 'error',
            ];
            return back()->with('notification', $notification);
        }

        // 7) Ambil existing data SEKALI (efisien)
        $nimList    = array_values(array_unique(array_map(fn($x) => $x['nim'], $fileRows)));
        $emailList  = array_values(array_unique(array_map(fn($x) => $x['email'], $fileRows)));

        $existingNims   = User::query()
            ->whereIn('nim_nip', $nimList)
            ->pluck('nim_nip')
            ->map(fn($v) => mb_strtolower($v))
            ->all();

        $existingEmails = User::query()
            ->whereIn('email', $emailList)
            ->pluck('email')
            ->map(fn($v) => mb_strtolower($v))
            ->all();

        $existingNimsSet   = array_fill_keys($existingNims, true);
        $existingEmailsSet = array_fill_keys($existingEmails, true);

        // 8) Siapkan data insert (skip existing nim/email)
        $toInsert         = [];
        $skippedByNim     = 0;
        $skippedByEmail   = 0;
        $validFromFile    = 0;

        foreach ($fileRows as $row) {
            $validFromFile++;

            $nimKey   = mb_strtolower($row['nim']);
            $emailKey = mb_strtolower($row['email']);

            if (isset($existingNimsSet[$nimKey])) {
                $skippedByNim++;
                continue;
            }
            if (isset($existingEmailsSet[$emailKey])) {
                $skippedByEmail++;
                continue;
            }

            $toInsert[] = [
                'name'               => $row['name'],
                'email'              => $row['email'],
                'password'           => Hash::make($row['nim']),   // default: nim
                'role'               => 'mahasiswa',               // default
                'status'             => 'active',                  // default
                'is_suspend'         => false,                     // default
                'nim_nip'            => $row['nim'],
                'prodi'              => $row['prodi'],
                'jurusan'            => $row['jur'],
                'email_verified_at'  => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ];

            // tandai email & nim agar baris berikutnya (dalam file) juga menghindari duplicate
            $existingNimsSet[$nimKey]   = true;
            $existingEmailsSet[$emailKey] = true;
        }

        if (empty($toInsert) && empty($errors)) {
            $notification = [
                'message' => 'Semua baris sudah ada (berdasarkan NIM/Email). Tidak ada data baru diimpor.',
                'type'    => 'error',
            ];
            return back()->with('notification', $notification);
        }

        // 9) Bulk insert per chunk (efisien)
        $inserted = 0;
        DB::beginTransaction();
        try {
            $chunks = array_chunk($toInsert, 500); // chunk insert
            foreach ($chunks as $chunk) {
                DB::table('users')->insert($chunk);
                $inserted += count($chunk);
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            // kemungkinan constraint unik di DB yg belum terfilter
            $notification = [
                'message' => 'Gagal menyimpan sebagian/seluruh data. Pastikan tidak ada email/NIM duplikat.',
                'type'    => 'error',
            ];
            return back()->with('notification', $notification);
        }

        // 10) Susun ringkasan
        $errCount = count($errors);
        $msg  = "Impor selesai. Disiapkan: {$validFromFile} baris. ";
        $msg .= "Berhasil: {$inserted}. ";
        if ($skippedByNim > 0)   $msg .= "Lewati (NIM sudah ada): {$skippedByNim}. ";
        if ($skippedByEmail > 0) $msg .= "Lewati (Email sudah ada): {$skippedByEmail}. ";
        if ($errCount > 0)       $msg .= "Error baris: {$errCount} (periksa format).";

        $notification = [
            'message' => $msg,
            'type'    => $inserted > 0 ? 'success' : 'error',
        ];

        return back()->with('notification', $notification);
    }

    private function normHeader(string $v): string
    {
        // normalisasi header: lowercase + trim
        $v = trim(mb_strtolower($v));
        return $v;
    }

    public function downloadTemplateUser()
    {
        $publicFile = public_path('templates/AutoLetter_User_Import_Template.xlsx');
        if (! file_exists($publicFile)) {
            $notification = [
                'message' => 'Template tidak ditemukan. Hubungi admin sistem.',
                'type'    => 'error',
            ];
            return back()->with('notification', $notification);
        }
        $downloadName = 'AutoLetter_User_Import_Template.xlsx';

        return response()->download(
            $publicFile,
            $downloadName,
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
        );
    }
}
