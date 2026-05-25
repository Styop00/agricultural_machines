<?php

namespace App\Filament\Resources\Cars\Schemas;

use App\Models\Category;
use App\Models\MachineModel;
use App\Models\Manufacturer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Vehicle details')
                    ->description('Main inventory fields shown on the storefront.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('manufacturer_id')
                                    ->label('Manufacturer')
                                    ->relationship('manufacturer', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(fn (Set $set): mixed => $set('machine_model_id', null))
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->createOptionUsing(fn (array $data): int => Manufacturer::query()->create($data)->getKey()),

                                Select::make('machine_model_id')
                                    ->label('Model')
                                    ->options(fn (Get $get): array => MachineModel::query()
                                        ->where('manufacturer_id', $get('manufacturer_id'))
                                        ->orderBy('name')
                                        ->pluck('name', 'id')
                                        ->all())
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->disabled(fn (Get $get): bool => blank($get('manufacturer_id')))
                                    ->helperText('Select or create a manufacturer first so models stay connected correctly.')
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->createOptionUsing(fn (array $data, Get $get): int => MachineModel::query()->create([
                                        'manufacturer_id' => (int) $get('manufacturer_id'),
                                        'name' => $data['name'],
                                    ])->getKey()),

                                TextInput::make('year')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1900)
                                    ->maxValue((int) date('Y') + 1),

                                TextInput::make('stock')
                                    ->label('Stock number')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                TextInput::make('slug')
                                    ->helperText('Auto-generated after save: category-manufacturer-model-year-stock number.')
                                    ->readOnly()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                TextInput::make('odometer')
                                    ->numeric()
                                    ->minValue(0),

                                TextInput::make('engine')
                                    ->maxLength(255),

                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->prefix('$'),

                                Select::make('categories')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->columnSpanFull()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('description')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->createOptionUsing(fn (array $data): int => Category::query()->create($data)->getKey()),

                                Textarea::make('description')
                                    ->rows(6)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Images')
                    ->description('Upload storefront photos. Mark one image as primary for listing cards.')
                    ->schema([
                        Repeater::make('images')
                            ->relationship()
                            ->schema([
                                FileUpload::make('path')
                                    ->label('Image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('car-images')
                                    ->visibility('public')
                                    ->required()
                                    ->columnSpanFull(),

                                TextInput::make('alt_text')
                                    ->label('Alt text')
                                    ->maxLength(255),

                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),

                                Toggle::make('is_primary')
                                    ->label('Primary image')
                                    ->helperText('Only one image should be primary. The backend will clear the previous primary image when this is enabled.'),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->reorderable()
                            ->addActionLabel('Add image')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
