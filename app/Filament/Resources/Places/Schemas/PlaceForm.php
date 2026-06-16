<?php

namespace App\Filament\Resources\Places\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PlaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_tr')
                    ->required(),
                TextInput::make('name_en'),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('type'),
                TextInput::make('country_tr'),
                TextInput::make('country_en'),
                TextInput::make('city_tr'),
                TextInput::make('city_en'),
                TextInput::make('region_tr'),
                TextInput::make('region_en'),
                FileUpload::make('cover_image')
                    ->image(),
                Textarea::make('short_description_tr')
                    ->columnSpanFull(),
                Textarea::make('short_description_en')
                    ->columnSpanFull(),
                Textarea::make('history_tr')
                    ->columnSpanFull(),
                Textarea::make('history_en')
                    ->columnSpanFull(),
                Textarea::make('stories_tr')
                    ->columnSpanFull(),
                Textarea::make('stories_en')
                    ->columnSpanFull(),
                Textarea::make('what_to_see_tr')
                    ->columnSpanFull(),
                Textarea::make('what_to_see_en')
                    ->columnSpanFull(),
                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
