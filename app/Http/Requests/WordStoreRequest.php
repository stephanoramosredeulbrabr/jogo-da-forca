<?php

namespace App\Http\Requests;

use App\Models\Word;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class WordStoreRequest
 * @package App\Http\Requests
 */
class WordStoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha', 'string', 'max:255', Rule::unique(Word::class)]
        ];
    }
}
