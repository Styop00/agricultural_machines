<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CarImageRequest extends FormRequest
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
            'car_id' => [$required, 'integer', 'exists:cars,id'],
            'path' => [$required, 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['sometimes', 'integer', 'min:0', 'max:65535'],
            'is_primary' => ['sometimes', 'boolean'],
        ];
    }
}
