<?php

namespace App\Filament\Resources\Widgets\Tables;

use App\Models\Widget;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WidgetsTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Ad')->searchable()->sortable(),
                TextColumn::make('type')
                    ->label('Tip')
                    ->formatStateUsing(fn ($state) => Widget::TYPES[$state] ?? $state)
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'youtube'    => 'danger',
                        'instagram'  => 'warning',
                        'html', 'ad' => 'info',
                        'whatsapp'   => 'success',
                        default      => 'gray',
                    }),
                TextColumn::make('position')
                    ->label('Pozisyon')
                    ->formatStateUsing(fn ($state) => Widget::POSITIONS[$state] ?? $state),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
                TextColumn::make('sort')->label('Sıra')->sortable(),
            ])
            ->defaultSort('sort')
            ->actions([
                EditAction::make(),
                DeleteAction::make()->after(fn () => Widget::clearCache()),
            ]);
    }
}
