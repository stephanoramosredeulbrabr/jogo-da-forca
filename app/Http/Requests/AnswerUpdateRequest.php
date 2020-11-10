<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'answer' => ['sometimes', 'string', 'max:255',Rule::unique('answers','answer')->ignore($this->route('answer'))->where('question_id',$this->route('answer')->question_id)],
            'correct' => ['sometimes', 'boolean'],
        ];
    }
}
