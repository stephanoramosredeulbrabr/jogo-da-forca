<?php

namespace App\Http\Requests;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class QuestionStoreRequest
 * @package App\Http\Requests
 */
class QuestionStoreRequest extends FormRequest
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
            'question' => ['required', 'string', 'max:255', Rule::unique(Question::class)]
        ];
    }
}
