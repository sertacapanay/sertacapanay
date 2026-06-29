<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SiteSettings extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static \UnitEnum|string|null $navigationGroup = 'Yönetim';
    protected static ?string $navigationLabel = 'Site Ayarları';
    protected static ?string $title = 'Site Ayarları';
    protected static ?int $navigationSort = 99;
    protected string $view = 'filament.pages.site-settings';

    public array $data = [];

    public function mount(): void
    {
        $this->data = Setting::allCached();
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Tabs::make('Ayarlar')
                    ->tabs([
                        Tab::make('Sosyal Medya')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Section::make('Sosyal Medya Linkleri')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('data.social.instagram')->label('Instagram URL')->url()->placeholder('https://instagram.com/kullanici'),
                                        TextInput::make('data.social.youtube')->label('YouTube URL')->url()->placeholder('https://youtube.com/@kanal'),
                                        TextInput::make('data.social.facebook')->label('Facebook URL')->url()->placeholder('https://facebook.com/sayfa'),
                                        TextInput::make('data.social.twitter')->label('X (Twitter) URL')->url()->placeholder('https://x.com/kullanici'),
                                        TextInput::make('data.social.linkedin')->label('LinkedIn URL')->url()->placeholder('https://linkedin.com/in/kullanici'),
                                        TextInput::make('data.social.tiktok')->label('TikTok URL')->url()->placeholder('https://tiktok.com/@kullanici'),
                                    ]),
                            ]),

                        Tab::make('Tasarım')
                            ->icon('heroicon-o-paint-brush')
                            ->schema([
                                Section::make('Renkler')
                                    ->columns(3)
                                    ->schema([
                                        ColorPicker::make('data.design.color_coral')->label('Ana Renk (coral)'),
                                        ColorPicker::make('data.design.color_gold')->label('Altın Rengi'),
                                        ColorPicker::make('data.design.color_ink')->label('Yazı Rengi'),
                                    ]),
                                Section::make('Yazı Tipi')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('data.design.font_display')
                                            ->label('Başlık Fontu')
                                            ->options([
                                                "'Cormorant Garamond',Georgia,serif" => 'Cormorant Garamond (varsayılan)',
                                                "'Playfair Display',Georgia,serif"   => 'Playfair Display',
                                                "'Lora',Georgia,serif"               => 'Lora',
                                            ]),
                                        Select::make('data.design.font_ui')
                                            ->label('Metin Fontu')
                                            ->options([
                                                "'Public Sans',system-ui,sans-serif" => 'Public Sans (varsayılan)',
                                                "'Inter',system-ui,sans-serif"       => 'Inter',
                                                "'DM Sans',system-ui,sans-serif"     => 'DM Sans',
                                            ]),
                                    ]),
                                Section::make('Özel CSS')
                                    ->schema([
                                        Textarea::make('data.design.custom_css')->label('Ekstra CSS')->rows(8),
                                    ]),
                            ]),

                        Tab::make('Hero Görseller')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make('Sayfa Hero Görselleri')
                                    ->columns(2)
                                    ->schema([
                                        FileUpload::make('data.hero.home')->label('Ana Sayfa Hero')->image()->directory('heroes')->disk('public'),
                                        FileUpload::make('data.hero.blog')->label('Blog Hero')->image()->directory('heroes')->disk('public'),
                                        FileUpload::make('data.hero.places')->label('Destinasyonlar Hero')->image()->directory('heroes')->disk('public'),
                                        FileUpload::make('data.hero.tours')->label('Turlar Hero')->image()->directory('heroes')->disk('public'),
                                        FileUpload::make('data.hero.guides')->label('Rehberler Hero')->image()->directory('heroes')->disk('public'),
                                        FileUpload::make('data.hero.shop')->label('Çarşı Hero')->image()->directory('heroes')->disk('public'),
                                        FileUpload::make('data.hero.about')->label('Hakkında Hero')->image()->directory('heroes')->disk('public'),
                                    ]),
                            ]),

                        Tab::make('Analitik & Reklam')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Section::make('Analitik')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('data.analytics.ga_id')->label('Google Analytics ID')->placeholder('G-XXXXXXXXXX'),
                                        TextInput::make('data.analytics.meta_pixel')->label('Meta Pixel ID'),
                                    ]),
                                Section::make('Reklam Kodları')
                                    ->schema([
                                        TextInput::make('data.ads.adsense_publisher')->label('AdSense Publisher ID')->placeholder('pub-XXXXXXXXXXXXXXXX'),
                                        Textarea::make('data.ads.header_script')->label('Header Script')->rows(5),
                                        Textarea::make('data.ads.footer_script')->label('Footer Script')->rows(5),
                                    ]),
                            ]),

                        Tab::make('Genel')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('İletişim')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('data.site.email')->label('E-posta')->email(),
                                        TextInput::make('data.site.phone')->label('Telefon')->tel(),
                                        TextInput::make('data.site.whatsapp')->label('WhatsApp')->placeholder('+905550000000'),
                                        TextInput::make('data.site.maps_url')->label('Google Maps URL')->url(),
                                    ]),
                                Section::make('Coming Soon')
                                    ->schema([
                                        Toggle::make('data.site.coming_soon')->label('Coming Soon modunu aktif et'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }

    public function save(): void
    {
        foreach ($this->data as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            Setting::set($key, is_array($value) ? json_encode($value) : (string) $value);
        }

        Setting::clearCache();

        Notification::make()->title('Ayarlar kaydedildi')->success()->send();
    }
}
