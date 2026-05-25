<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\WorkingTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class WorkingTimeRequest extends FormRequest
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
            'company_id' => [$required, 'integer', 'exists:companies,id'],
            'department' => [$required, 'string', Rule::in(WorkingTime::departments())],
            'day_of_week' => [$required, 'integer', 'between:0,6'],
            'opens_at' => ['nullable', 'date_format:H:i'],
            'closes_at' => ['nullable', 'date_format:H:i', 'after:opens_at'],
            'is_closed' => ['sometimes', 'boolean'],
        ];
    }
}
