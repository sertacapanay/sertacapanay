<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
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
                TextInput::make('category_tr'),
                TextInput::make('category_en'),
                TextInput::make('source_place_tr'),
                TextInput::make('source_place_en'),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('currency')
                    ->required()
                    ->default('EUR'),
                FileUpload::make('image')
                    ->image(),
                Textarea::make('description_tr')
                    ->columnSpanFull(),
                Textarea::make('description_en')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
