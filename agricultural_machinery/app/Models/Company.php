<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    /**
     * @return HasMany<WorkingTime, $this>
     */
    public function workingTimes(): HasMany
    {
        return $this->hasMany(WorkingTime::class);
    }
}
