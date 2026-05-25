<?php

namespace App\Filament\Resources\Cars\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('primaryImage.path')
                    ->label('Photo')
                    ->disk('public')
                    ->square(),
                TextColumn::make('manufacturer.name')
                    ->label('Manufacturer')
                    ->searchable(),
                TextColumn::make('machineModel.name')
                    ->label('Model')
                    ->searchable(),
                TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Stock')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),
                TextColumn::make('odometer')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('engine')
                    ->searchable(),
                TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('categories.name')
                    ->badge()
                    ->separator(',')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('manufacturer')
                    ->relationship('manufacturer', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
