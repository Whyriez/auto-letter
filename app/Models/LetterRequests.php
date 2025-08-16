<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LetterRequests extends Model
{
    use HasFactory;
    protected $table = 'letter_requests';

    protected $fillable = [
        'user_id',
        'letter_template_id',
        'status',
        'unique_code',
        'final_document_path',
        'blockchain_hash',
        'blockchain_tx_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the template for this request.
     */
    public function letterTemplate(): BelongsTo
    {
        return $this->belongsTo(LetterTemplate::class);
    }
}
