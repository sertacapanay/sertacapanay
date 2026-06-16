<?php

namespace App\Filament\Resources\Tours\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TourForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title_tr')
                    ->required(),
                TextInput::make('title_en'),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('region_tr'),
                TextInput::make('region_en'),
                TextInput::make('country_tr'),
                TextInput::make('country_en'),
                TextInput::make('duration_days')
                    ->numeric(),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('currency')
                    ->required()
                    ->default('EUR'),
                DatePicker::make('start_date'),
                FileUpload::make('cover_image')
                    ->image(),
                Textarea::make('short_description_tr')
                    ->columnSpanFull(),
                Textarea::make('short_description_en')
                    ->columnSpanFull(),
                Textarea::make('description_tr')
                    ->columnSpanFull(),
                Textarea::make('description_en')
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
