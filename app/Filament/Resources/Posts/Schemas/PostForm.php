<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
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
                TextInput::make('type'),
                TextInput::make('category_tr'),
                TextInput::make('category_en'),
                FileUpload::make('cover_image')
                    ->image(),
                Textarea::make('excerpt_tr')
                    ->columnSpanFull(),
                Textarea::make('excerpt_en')
                    ->columnSpanFull(),
                Textarea::make('content_tr')
                    ->columnSpanFull(),
                Textarea::make('content_en')
                    ->columnSpanFull(),
                TextInput::make('seo_title_tr'),
                TextInput::make('seo_title_en'),
                Textarea::make('seo_description_tr')
                    ->columnSpanFull(),
                Textarea::make('seo_description_en')
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->required(),
                DateTimePicker::make('published_at'),
            ]);
    }
}
