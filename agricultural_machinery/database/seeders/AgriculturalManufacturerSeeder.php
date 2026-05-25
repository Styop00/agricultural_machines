<?php

namespace Database\Seeders;

use App\Models\MachineModel;
use App\Models\Manufacturer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AgriculturalManufacturerSeeder extends Seeder
{
    /**
     * Seed agricultural vehicle manufacturers and their models.
     */
    public function run(): void
    {
        $manufacturers = [
            'John Deere' => [
                '6R 250 Tractor',
                '8R 370 Tractor',
                '9RX 590 Track Tractor',
                'S780 Combine Harvester',
            ],
            'Case IH' => [
                'Magnum 380 Tractor',
                'Puma 240 Tractor',
                'Steiger 620 Quadtrac',
                'Axial-Flow 8250 Combine',
            ],
            'New Holland' => [
                'T7.270 Tractor',
                'T8.410 Genesis Tractor',
                'CR9.90 Combine',
                'BigBaler 1290 High Density',
            ],
            'Massey Ferguson' => [
                '8S.265 Tractor',
                '8740 S Tractor',
                'IDEAL 8T Combine',
            ],
            'Fendt' => [
                '724 Vario Tractor',
                '942 Vario Tractor',
                '1167 Vario MT Track Tractor',
            ],
            'Claas' => [
                'Axion 960 Tractor',
                'Lexion 8900 Combine',
                'Jaguar 970 Forage Harvester',
            ],
            'Kubota' => [
                'M6-141 Tractor',
                'M7-172 Premium Tractor',
                'SVL97-2 Compact Track Loader',
            ],
            'Deutz-Fahr' => [
                '7250 TTV Tractor',
                '9340 TTV Warrior Tractor',
            ],
            'Valtra' => [
                'Q305 Tractor',
                'T255 Versu Tractor',
            ],
            'Challenger' => [
                'MT775E Track Tractor',
                'MT865E Track Tractor',
            ],
            'JCB' => [
                'Fastrac 8330 Tractor',
                'TM420 Agri Telehandler',
            ],
            'Caterpillar' => [
                '299D3 Compact Track Loader',
                'TH408D Ag Handler',
            ],
            'Mahindra' => [
                '6075 Power Shuttle Tractor',
                '9125 P Tractor',
            ],
        ];

        foreach ($manufacturers as $manufacturerName => $modelNames) {
            $manufacturer = Manufacturer::query()->updateOrCreate(
                ['slug' => Str::slug($manufacturerName)],
                ['name' => $manufacturerName],
            );

            foreach ($modelNames as $modelName) {
                MachineModel::query()->updateOrCreate(
                    [
                        'manufacturer_id' => $manufacturer->id,
                        'slug' => Str::slug($modelName),
                    ],
                    [
                        'name' => $modelName,
                    ],
                );
            }
        }
    }
}
