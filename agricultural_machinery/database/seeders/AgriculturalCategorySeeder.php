<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AgriculturalCategorySeeder extends Seeder
{
    /**
     * Seed storefront categories for agricultural inventory.
     */
    public function run(): void
    {
        $categories = [
            'Row Crop Tractors' => 'High-horsepower tractors for planting, tillage, hauling, and heavy field work.',
            'Track Tractors' => 'Tracked machines built for traction, flotation, and large-acreage field performance.',
            'Compact Utility Tractors' => 'Versatile compact tractors for property maintenance, loader work, and lighter farm jobs.',
            'Combine Harvesters' => 'Grain harvesting machines for corn, soybeans, wheat, and other row crops.',
            'Forage Harvesters' => 'Machines for chopping silage, haylage, and forage crops.',
            'Balers' => 'Round and square balers for hay, straw, and forage packaging.',
            'Loaders' => 'Wheel loaders, compact track loaders, and front loader equipment for material handling.',
            'Telehandlers' => 'Agricultural handlers for lifting, stacking, loading, and yard operations.',
            'Sprayers' => 'Self-propelled and pull-type sprayers for crop protection and nutrient application.',
            'Seeders & Planters' => 'Planting and seeding equipment for precise crop establishment.',
            'Tillage Equipment' => 'Discs, cultivators, rippers, and field preparation implements.',
            'Hay & Forage' => 'Mowers, rakes, tedders, balers, and forage support equipment.',
            'Attachments' => 'Buckets, forks, blades, grapples, and machine-specific implements.',
            'Work-Ready Inventory' => 'Inspected machines prepared for immediate farm, contractor, or acreage use.',
        ];

        foreach ($categories as $name => $description) {
            Category::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => $description,
                ],
            );
        }
    }
}
