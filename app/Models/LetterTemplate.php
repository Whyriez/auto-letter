<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LetterTemplate extends Model
{
    use HasFactory;
    protected $table = 'letter_templates';
    protected $fillable = [
        'kategori',
        'nama_surat',
        'kode_seri',
        'kode_unit',
        'kode_arsip',
        'tujuan_nama',
        'tujuan_lokasi',
        'konten',
        'requires_kaprodi',
        'requires_ketua_jurusan',
        'status',
        'created_at',
        'updated_at',
    ];

    public function letterRequests(): HasMany
    {
        return $this->hasMany(LetterRequests::class);
    }
}
