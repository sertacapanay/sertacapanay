<?php

namespace App\Filament\Resources\Widgets;

use App\Models\Widget;
use Filament\Resources\Resource;
use App\Filament\Resources\Widgets\Pages\CreateWidget;
use App\Filament\Resources\Widgets\Pages\EditWidget;
use App\Filament\Resources\Widgets\Pages\ListWidgets;

class WidgetResource extends Resource
{
    protected static ?string $model = Widget::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static \UnitEnum|string|null $navigationGroup = 'Yönetim';
    protected static ?string $navigationLabel = 'Widget\'lar';
    protected static ?string $modelLabel = 'Widget';
    protected static ?string $pluralModelLabel = 'Widget\'lar';
    protected static ?int $navigationSort = 98;

    public static function getPages(): array
    {
        return [
            'index'  => ListWidgets::route('/'),
            'create' => CreateWidget::route('/create'),
            'edit'   => EditWidget::route('/{record}/edit'),
        ];
    }
}
