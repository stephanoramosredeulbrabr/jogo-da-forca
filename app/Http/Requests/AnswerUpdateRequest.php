<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AnswerUpdateRequest
 * @package App\Http\Requests
 */
class AnswerUpdateRequest extends FormRequest
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
            'answer' => ['sometimes', 'string', 'max:255'],
            'correct' => ['sometimes', 'boolean'],
        ];
    }
}
