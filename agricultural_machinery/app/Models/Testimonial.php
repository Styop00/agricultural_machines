<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'location',
        'context',
        'quote',
        'image_url',
        'avatar_url',
        'sort_order',
        'is_featured',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_featured' => 'boolean',
        ];
    }
}
