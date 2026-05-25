<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Manufacturer extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * @return HasMany<MachineModel, $this>
     */
    public function machineModels(): HasMany
    {
        return $this->hasMany(MachineModel::class);
    }

    /**
     * @return HasMany<Car, $this>
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
