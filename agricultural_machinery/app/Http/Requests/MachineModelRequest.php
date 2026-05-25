<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class MachineModelRequest extends FormRequest
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
            'name' => [$required, 'string', 'max:255'],
        ];
    }
}
