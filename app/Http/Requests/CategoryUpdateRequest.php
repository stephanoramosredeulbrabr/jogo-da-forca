<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CategoryUpdateRequest
 * @package App\Http\Requests
 */
class CategoryUpdateRequest extends FormRequest
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
                'string',
                'nullable',
                'max:255',
                Rule::unique(Category::class)->ignore($this->route('category')),
            ]
        ];
    }
}
