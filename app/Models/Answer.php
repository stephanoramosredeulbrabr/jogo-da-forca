<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Answer
 * @package App\Models
 */
class Answer extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'answer',
        'correct',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'correct' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
