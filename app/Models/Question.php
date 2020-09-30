<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Question
 * @package App\Models
 */
class Question extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'question',
    ];

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
