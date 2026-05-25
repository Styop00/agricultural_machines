<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CompanyRequest extends FormRequest
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
            'name' => [$required, 'string', 'max:255'],
            'address' => [$required, 'string', 'max:255'],
            'phone' => [$required, 'string', 'max:50'],
            'email' => [$required, 'email', 'max:255', Rule::unique('companies', 'email')->ignore($this->route('company'))],
        ];
    }
}
