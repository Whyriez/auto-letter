<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterTypes extends Model
{
    use HasFactory;
    protected $table = 'letter_types';
    protected $fillable = [
        'id',
        'name'
    ];
}
