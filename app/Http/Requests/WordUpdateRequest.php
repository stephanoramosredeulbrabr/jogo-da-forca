<?php

namespace App\Http\Requests;

use App\Models\Word;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class WordUpdateRequest
 * @package App\Http\Requests
 */
class WordUpdateRequest extends FormRequest
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
            'name' => [
                'sometimes',
                'alpha',
                'string',
                'max:255',
                Rule::unique(Word::class)->ignore($this->route('word')),
            ]
        ];
    }
}
