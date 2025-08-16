<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorSuratCounter extends Model
{
    use HasFactory;
    protected $table = 'nomor_surat_counters';

    protected $fillable = [
        'tahun',
        'nomor_terakhir',
    ];
}
