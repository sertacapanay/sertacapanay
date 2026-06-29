<?php

namespace App\Filament\Resources\Widgets\Pages;

use App\Filament\Resources\Widgets\WidgetResource;
use App\Filament\Resources\Widgets\Tables\WidgetsTable;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListWidgets extends ListRecords
{
    protected static string $resource = WidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }

    public function table(Table $table): Table
    {
        return WidgetsTable::make($table);
    }
}
