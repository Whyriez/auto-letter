<?php

namespace App\Http\Controllers;

use App\Models\LetterRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerificationController extends Controller
{
    public function verify($unique_code)
    {
        $letterRequest = LetterRequests::where('unique_code', $unique_code)->first();

        $status = 'invalid';
        $message = 'Kode verifikasi tidak valid atau dokumen tidak ditemukan.';
        $documentUrl = null;

        if ($letterRequest) {
            if ($letterRequest->status === 'completed' && $letterRequest->final_document_path) {
                $documentContent = Storage::disk('public')->get($letterRequest->final_document_path);

                $calculatedHash = hash('sha256', $documentContent);

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
