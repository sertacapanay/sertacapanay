<?php

namespace App\Filament\Resources\Flights\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FlightForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('airline'),
                TextInput::make('flight_number'),
                TextInput::make('from_city'),
                TextInput::make('to_city'),
                DatePicker::make('flight_date'),
                TextInput::make('distance_km')
                    ->numeric(),
                Textarea::make('notes_tr')
                    ->columnSpanFull(),
                Textarea::make('notes_en')
                    ->columnSpanFull(),
            ]);
    }
}
