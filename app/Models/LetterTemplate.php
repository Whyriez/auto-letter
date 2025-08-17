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
        'letter_type_id',
        'nama_surat',
        'kode_seri',
        'kode_unit',
        'kode_arsip',
        'perihal',
        'tujuan_nama',
        'tujuan_lokasi',
        'konten',
        'forward_to',
        'status',
        'created_at',
        'updated_at',
    ];

    public function letterRequests(): HasMany
    {
        return $this->hasMany(LetterRequests::class);
    }

    public function LetterTemplate()
    {
        return $this->belongsTo(LetterTypes::class, 'letter_type_id');
    }

    public function letterType()
    {
        return $this->belongsTo(LetterTypes::class, 'letter_type_id');
    }
}
