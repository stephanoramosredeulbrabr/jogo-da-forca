<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class AnswerStoreRequest
 * @package App\Http\Requests
 */
class AnswerStoreRequest extends FormRequest
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
            'answer' => ['required', 'string', 'max:255',Rule::unique('answers','answer')->where('question_id',$this->question->id)],
            'correct' => ['sometimes', 'boolean'],
        ];
    }
}
