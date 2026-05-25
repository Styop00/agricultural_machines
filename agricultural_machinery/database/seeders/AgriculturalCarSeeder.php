<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Category;
use App\Models\MachineModel;
use App\Models\Manufacturer;
use App\Support\CarSlug;
use Illuminate\Database\Seeder;

class AgriculturalCarSeeder extends Seeder
{
    /**
     * Seed agricultural inventory listings with public demo images.
     */
    public function run(): void
    {
        $cars = [
            [
                'manufacturer' => 'John Deere',
                'model' => '8R 370 Tractor',
                'categories' => ['Row Crop Tractors', 'Work-Ready Inventory'],
                'year' => 2023,
                'stock' => 'AG-JD-8370',
                'odometer' => 412,
                'engine' => '9.0L PowerTech Diesel',
                'price' => 318500,
                'description' => 'Premium row crop tractor with guidance-ready cab, front weights, fresh service, and excellent tire condition.',
                'images' => [
                    'https://images.unsplash.com/photo-1592982537447-7440770cbfc9?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1627920769842-6887c6df05ca?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'manufacturer' => 'Case IH',
                'model' => 'Axial-Flow 8250 Combine',
                'categories' => ['Combine Harvesters', 'Work-Ready Inventory'],
                'year' => 2021,
                'stock' => 'AG-CI-8250',
                'odometer' => 785,
                'engine' => 'FPT Cursor 13 Diesel',
                'price' => 389900,
                'description' => 'High-capacity combine with inspected feeder house, clean cab, field tracker, and harvest-ready wear components.',
                'images' => [
                    'https://images.unsplash.com/photo-1598512752271-33f913a5af13?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'manufacturer' => 'New Holland',
                'model' => 'BigBaler 1290 High Density',
                'categories' => ['Balers', 'Hay & Forage'],
                'year' => 2022,
                'stock' => 'AG-NH-1290',
                'odometer' => 236,
                'engine' => 'PTO Driven',
                'price' => 142750,
                'description' => 'Large square baler with high-density package, moisture sensing, road lights, and clean pickup assembly.',
                'images' => [
                    'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1523741543316-beb7fc7023d8?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'manufacturer' => 'Fendt',
                'model' => '942 Vario Tractor',
                'categories' => ['Row Crop Tractors', 'Track Tractors'],
                'year' => 2024,
                'stock' => 'AG-FD-942V',
                'odometer' => 126,
                'engine' => 'MAN 9.0L Diesel',
                'price' => 421000,
                'description' => 'Late-model Vario tractor with premium suspension, CVT transmission, LED lighting, and precision farming package.',
                'images' => [
                    'https://images.unsplash.com/photo-1605333396915-47ed6b68a00c?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'manufacturer' => 'Claas',
                'model' => 'Jaguar 970 Forage Harvester',
                'categories' => ['Forage Harvesters', 'Hay & Forage'],
                'year' => 2020,
                'stock' => 'AG-CL-970J',
                'odometer' => 1105,
                'engine' => 'MAN V12 Diesel',
                'price' => 274500,
                'description' => 'Forage harvester with kernel processor, auto lube, metal detector, and inspected cutterhead.',
                'images' => [
                    'https://images.unsplash.com/photo-1530267981375-f0de937f5f13?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'manufacturer' => 'Kubota',
                'model' => 'SVL97-2 Compact Track Loader',
                'categories' => ['Loaders', 'Attachments'],
                'year' => 2023,
                'stock' => 'AG-KB-SVL97',
                'odometer' => 344,
                'engine' => '3.8L Kubota Diesel',
                'price' => 68900,
                'description' => 'Compact track loader with high-flow hydraulics, enclosed cab, quick attach, and general purpose bucket.',
                'images' => [
                    'https://images.unsplash.com/photo-1578374173705-969cbe6f2d6b?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'manufacturer' => 'JCB',
                'model' => 'TM420 Agri Telehandler',
                'categories' => ['Telehandlers', 'Loaders'],
                'year' => 2022,
                'stock' => 'AG-JCB-TM420',
                'odometer' => 518,
                'engine' => 'JCB EcoMAX Diesel',
                'price' => 119500,
                'description' => 'Agri telehandler with pallet forks, hydraulic coupler, cab heat and AC, and strong yard-ready tires.',
                'images' => [
                    'https://images.unsplash.com/photo-1605000797499-95a51c5269ae?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1586771107445-d3ca888129ff?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'manufacturer' => 'Massey Ferguson',
                'model' => 'IDEAL 8T Combine',
                'categories' => ['Combine Harvesters', 'Track Tractors'],
                'year' => 2021,
                'stock' => 'AG-MF-ID8T',
                'odometer' => 692,
                'engine' => 'AGCO Power Diesel',
                'price' => 356000,
                'description' => 'Tracked combine with premium cab, yield monitoring, residue management, and inspected threshing system.',
                'images' => [
                    'https://images.unsplash.com/photo-1560493676-04071c5f467b?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
        ];

        foreach ($cars as $carData) {
            $manufacturer = Manufacturer::query()->where('name', $carData['manufacturer'])->firstOrFail();
            $model = MachineModel::query()
                ->where('manufacturer_id', $manufacturer->id)
                ->where('name', $carData['model'])
                ->firstOrFail();

            $car = Car::query()->updateOrCreate(
                ['stock' => $carData['stock']],
                [
                    'manufacturer_id' => $manufacturer->id,
                    'machine_model_id' => $model->id,
                    'year' => $carData['year'],
                    'odometer' => $carData['odometer'],
                    'engine' => $carData['engine'],
                    'price' => $carData['price'],
                    'description' => $carData['description'],
                ],
            );

            $categoryIds = Category::query()
                ->whereIn('name', $carData['categories'])
                ->pluck('id')
                ->all();

            $car->categories()->sync($categoryIds);
            $car->forceFill([
                'slug' => CarSlug::make($car->fresh(['categories', 'manufacturer', 'machineModel'])),
            ])->saveQuietly();
            $car->images()->delete();

            foreach ($carData['images'] as $index => $imageUrl) {
                $car->images()->create([
                    'path' => "seeded/{$carData['stock']}-{$index}.jpg",
                    'url' => $imageUrl,
                    'alt_text' => "{$carData['year']} {$carData['manufacturer']} {$carData['model']}",
                    'sort_order' => $index,
                    'is_primary' => $index === 0,
                ]);
            }
        }
    }
}
