<?php

namespace App\Filament\Resources\Widgets\Schemas;

use App\Models\Widget;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WidgetForm
{
    public static function make(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Temel Bilgiler')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Admin Etiketi')
                        ->required()
                        ->maxLength(120)
                        ->placeholder('Örn: Anasayfa YouTube Videosu'),

                    Select::make('type')
                        ->label('Widget Tipi')
                        ->required()
                        ->options(Widget::TYPES)
                        ->live()
                        ->afterStateUpdated(fn ($state, $set) => $set('config', [])),

                    Select::make('position')
                        ->label('Pozisyon')
                        ->required()
                        ->options(Widget::POSITIONS),

                    Select::make('pages')
                        ->label('Görüneceği Sayfalar')
                        ->multiple()
                        ->options([
                            'all'     => 'Tüm Sayfalar',
                            'home'    => 'Ana Sayfa',
                            'blog'    => 'Blog',
                            'places'  => 'Destinasyonlar',
                            'tours'   => 'Turlar',
                            'guides'  => 'Rehberler',
                            'shop'    => 'Çarşı',
                            'about'   => 'Hakkımda',
                            'contact' => 'İletişim',
                        ])
                        ->default(['all']),

                    TextInput::make('title_tr')->label('Başlık (TR)')->maxLength(200),
                    TextInput::make('title_en')->label('Başlık (EN)')->maxLength(200),

                    TextInput::make('sort')->label('Sıra')->numeric()->default(0),

                    Toggle::make('is_active')->label('Aktif')->default(true)->columnSpanFull(),
                ]),

            Section::make('Widget Ayarları')
                ->description('Widget tipine göre gerekli alanları doldurun')
                ->schema([
                    // YouTube
                    TextInput::make('config.video_id')
                        ->label('YouTube Video ID')
                        ->placeholder('dQw4w9WgXcQ')
                        ->helperText('YouTube URL\'sindeki 11 karakterlik kod. Boş bırakırsanız kanal butonu gösterilir.')
                        ->visible(fn ($get) => $get('type') === 'youtube'),

                    TextInput::make('config.channel_url')
                        ->label('YouTube Kanal URL')
                        ->url()
                        ->placeholder('https://youtube.com/@kanaliniz')
                        ->visible(fn ($get) => $get('type') === 'youtube'),

                    // Instagram
                    TextInput::make('config.url')
                        ->label('Instagram Profil URL')
                        ->url()
                        ->placeholder('https://instagram.com/profiliniz')
                        ->visible(fn ($get) => $get('type') === 'instagram'),

                    // HTML / Reklam
                    Textarea::make('config.code')
                        ->label('HTML / Reklam Kodu')
                        ->rows(8)
                        ->placeholder('<script async src="..."></script> veya herhangi bir HTML')
                        ->visible(fn ($get) => in_array($get('type'), ['html', 'ad'])),

                    // WhatsApp
                    TextInput::make('config.number')
                        ->label('WhatsApp Numarası (+ ile başlayın)')
                        ->placeholder('+905550000000')
                        ->visible(fn ($get) => $get('type') === 'whatsapp'),

                    TextInput::make('config.message_tr')
                        ->label('Varsayılan Mesaj (TR)')
                        ->placeholder('Merhaba, bilgi almak istiyorum.')
                        ->visible(fn ($get) => $get('type') === 'whatsapp'),

                    // Newsletter
                    TextInput::make('config.action_url')
                        ->label('Form Action URL')
                        ->url()
                        ->placeholder('https://mailchimp.com/...')
                        ->visible(fn ($get) => $get('type') === 'newsletter'),

                    TextInput::make('config.description_tr')
                        ->label('Açıklama (TR)')
                        ->visible(fn ($get) => $get('type') === 'newsletter'),

                    TextInput::make('config.description_en')
                        ->label('Açıklama (EN)')
                        ->visible(fn ($get) => $get('type') === 'newsletter'),

                    TextInput::make('config.button_tr')
                        ->label('Buton Metni (TR)')
                        ->default('Abone Ol')
                        ->visible(fn ($get) => $get('type') === 'newsletter'),

                    TextInput::make('config.button_en')
                        ->label('Buton Metni (EN)')
                        ->default('Subscribe')
                        ->visible(fn ($get) => $get('type') === 'newsletter'),
                ]),
        ]);
    }
}
