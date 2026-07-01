<?php

namespace App\Filament\Resources\Cruises\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CruiseForm
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
                TextInput::make('ship_name')
                    ->label('Gemi Adı'),
                TextInput::make('cruise_line')
                    ->label('Gemi Şirketi'),
                TextInput::make('from_port_tr')
                    ->label('Kalkış Limanı (TR)'),
                TextInput::make('from_port_en')
                    ->label('Kalkış Limanı (EN)'),
                TextInput::make('to_port_tr')
                    ->label('Varış Limanı (TR)'),
                TextInput::make('to_port_en')
                    ->label('Varış Limanı (EN)'),
                TextInput::make('country_tr')
                    ->label('Ülke/Bölge (TR)'),
                TextInput::make('country_en')
                    ->label('Ülke/Bölge (EN)'),
                TextInput::make('nights')
                    ->label('Gece Sayısı')
                    ->numeric(),
                DatePicker::make('departure_date')
                    ->label('Kalkış Tarihi'),
                FileUpload::make('cover_image')
                    ->image(),
                Textarea::make('short_description_tr')
                    ->columnSpanFull(),
                Textarea::make('short_description_en')
                    ->columnSpanFull(),
                Textarea::make('description_tr')
                    ->label('Seyir Günlüğü (TR)')
                    ->columnSpanFull(),
                Textarea::make('description_en')
                    ->label('Seyir Günlüğü (EN)')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }
}
