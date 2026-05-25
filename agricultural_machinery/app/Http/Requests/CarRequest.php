<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $required = $this->isMethod('post') ? 'required' : 'sometimes';

        return [
            'manufacturer_id' => [$required, 'integer', 'exists:manufacturers,id'],
            'machine_model_id' => [$required, 'integer', 'exists:machine_models,id'],
            'year' => [$required, 'integer', 'between:1900,'.((int) date('Y') + 1)],
            'stock' => [$required, 'string', 'max:100', Rule::unique('cars', 'stock')->ignore($this->route('car'))],
            'odometer' => ['nullable', 'integer', 'min:0'],
            'engine' => ['nullable', 'string', 'max:255'],
            'price' => [$required, 'numeric', 'min:0', 'max:9999999999.99'],
            'description' => ['nullable', 'string'],
            'category_ids' => [$required, 'array'],
            'category_ids.*' => ['integer', 'exists:categories,id'],
        ];
    }
}
