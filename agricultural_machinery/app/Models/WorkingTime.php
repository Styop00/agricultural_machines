<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class WorkingTime extends Model
{
    public const DEPARTMENT_COMPANY = 'company';

    public const DEPARTMENT_SERVICES = 'services';

    protected $fillable = [
        'company_id',
        'department',
        'day_of_week',
        'opens_at',
        'closes_at',
        'is_closed',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'day_of_week' => 'integer',
            'is_closed' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Company, $this>
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return array<int, string>
     */
    public static function departments(): array
    {
        return [
            self::DEPARTMENT_COMPANY,
            self::DEPARTMENT_SERVICES,
        ];
    }
}
