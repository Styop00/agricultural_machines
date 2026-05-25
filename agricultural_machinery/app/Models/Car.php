<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Car extends Model
{
    protected $fillable = [
        'manufacturer_id',
        'machine_model_id',
        'year',
        'stock',
        'slug',
        'odometer',
        'engine',
        'price',
        'description',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'odometer' => 'integer',
            'price' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsTo<Manufacturer, $this>
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * @return BelongsTo<MachineModel, $this>
     */
    public function machineModel(): BelongsTo
    {
        return $this->belongsTo(MachineModel::class);
    }

    /**
     * @return BelongsToMany<Category, $this>
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    /**
     * @return HasMany<CarImage, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class)->orderByDesc('is_primary')->orderBy('sort_order');
    }

    /**
     * @return HasOne<CarImage, $this>
     */
    public function primaryImage(): HasOne
    {
        return $this->hasOne(CarImage::class)->where('is_primary', true);
    }
}
