<?php

namespace App\Filament\Resources\Widgets\Pages;

use App\Filament\Resources\Widgets\WidgetResource;
use App\Filament\Resources\Widgets\Schemas\WidgetForm;
use App\Models\Widget;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;

class CreateWidget extends CreateRecord
{
    protected static string $resource = WidgetResource::class;

    public function form(Schema $schema): Schema
    {
        return WidgetForm::make($schema);
    }

    protected function afterCreate(): void
    {
        Widget::clearCache();
    }
}
