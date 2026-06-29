<?php

namespace App\Filament\Resources\Widgets\Pages;

use App\Filament\Resources\Widgets\WidgetResource;
use App\Filament\Resources\Widgets\Schemas\WidgetForm;
use App\Models\Widget;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;

class EditWidget extends EditRecord
{
    protected static string $resource = WidgetResource::class;

    public function form(Schema $schema): Schema
    {
        return WidgetForm::make($schema);
    }

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()->after(fn () => Widget::clearCache())];
    }

    protected function afterSave(): void
    {
        Widget::clearCache();
    }
}
