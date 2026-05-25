<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer story')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('location')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('context')
                                    ->helperText('Example: Vehicle Purchase, Nationwide Delivery, Warranty Support')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),
                                TextInput::make('image_url')
                                    ->label('Large image URL')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                TextInput::make('avatar_url')
                                    ->label('Avatar URL')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Toggle::make('is_featured')
                                    ->label('Show on storefront')
                                    ->default(true),
                                Textarea::make('quote')
                                    ->required()
                                    ->rows(5)
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
