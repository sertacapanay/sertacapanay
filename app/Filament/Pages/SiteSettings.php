<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static \UnitEnum|string|null $navigationGroup = 'Yönetim';
    protected static ?string $navigationLabel = 'Site Ayarları';
    protected static ?string $title = 'Site Ayarları';
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.site-settings';

    public array $data = [];

    public function mount(): void
    {
        $all = Setting::allCached();
        $this->form->fill($all);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Ayarlar')
                    ->tabs([
                        // ── SOSYAL MEDYA ─────────────────────────────
                        Tab::make('Sosyal Medya')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Section::make('Sosyal Medya Linkleri')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('social.instagram')
                                            ->label('Instagram URL')
                                            ->url()
                                            ->placeholder('https://instagram.com/kullanici'),
                                        TextInput::make('social.youtube')
                                            ->label('YouTube Kanal URL')
                                            ->url()
                                            ->placeholder('https://youtube.com/@kanal'),
                                        TextInput::make('social.facebook')
                                            ->label('Facebook URL')
                                            ->url()
                                            ->placeholder('https://facebook.com/sayfa'),
                                        TextInput::make('social.twitter')
                                            ->label('X (Twitter) URL')
                                            ->url()
                                            ->placeholder('https://x.com/kullanici'),
                                        TextInput::make('social.linkedin')
                                            ->label('LinkedIn URL')
                                            ->url()
                                            ->placeholder('https://linkedin.com/in/kullanici'),
                                        TextInput::make('social.tiktok')
                                            ->label('TikTok URL')
                                            ->url()
                                            ->placeholder('https://tiktok.com/@kullanici'),
                                    ]),
                            ]),

                        // ── TASARIM ──────────────────────────────────
                        Tab::make('Tasarım')
                            ->icon('heroicon-o-paint-brush')
                            ->schema([
                                Section::make('Renkler')
                                    ->columns(3)
                                    ->schema([
                                        ColorPicker::make('design.color_coral')
                                            ->label('Ana Renk (coral)')
                                            ->default('hsl(24 76% 44%)'),
                                        ColorPicker::make('design.color_gold')
                                            ->label('Altın Rengi')
                                            ->default('hsl(24 70% 55%)'),
                                        ColorPicker::make('design.color_ink')
                                            ->label('Yazı Rengi (ink)')
                                            ->default('hsl(130 8% 10%)'),
                                    ]),
                                Section::make('Yazı Tipi')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('design.font_display')
                                            ->label('Başlık Fontu')
                                            ->options([
                                                "'Cormorant Garamond',Georgia,serif" => 'Cormorant Garamond (varsayılan)',
                                                "'Playfair Display',Georgia,serif"   => 'Playfair Display',
                                                "'EB Garamond',Georgia,serif"        => 'EB Garamond',
                                                "'Lora',Georgia,serif"               => 'Lora',
                                            ]),
                                        Select::make('design.font_ui')
                                            ->label('Metin Fontu')
                                            ->options([
                                                "'Public Sans',system-ui,sans-serif" => 'Public Sans (varsayılan)',
                                                "'Inter',system-ui,sans-serif"       => 'Inter',
                                                "'DM Sans',system-ui,sans-serif"     => 'DM Sans',
                                            ]),
                                    ]),
                                Section::make('Özel CSS')
                                    ->schema([
                                        Textarea::make('design.custom_css')
                                            ->label('Ekstra CSS (tüm sayfalara eklenir)')
                                            ->rows(8)
                                            ->placeholder(':root { --coral: #c45c2a; } .btn-coral { border-radius: 4px; }'),
                                    ]),
                            ]),

                        // ── SAYFA HEROLERİ ────────────────────────────
                        Tab::make('Hero Görseller')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make('Sayfa Hero Görselleri')
                                    ->description('Her sayfanın üst görselini buradan değiştirin')
                                    ->columns(2)
                                    ->schema([
                                        FileUpload::make('hero.home')
                                            ->label('Ana Sayfa Hero')
                                            ->image()
                                            ->directory('heroes')
                                            ->disk('public'),
                                        FileUpload::make('hero.blog')
                                            ->label('Blog Hero')
                                            ->image()
                                            ->directory('heroes')
                                            ->disk('public'),
                                        FileUpload::make('hero.places')
                                            ->label('Destinasyonlar Hero')
                                            ->image()
                                            ->directory('heroes')
                                            ->disk('public'),
                                        FileUpload::make('hero.tours')
                                            ->label('Turlar Hero')
                                            ->image()
                                            ->directory('heroes')
                                            ->disk('public'),
                                        FileUpload::make('hero.guides')
                                            ->label('Rehberler Hero')
                                            ->image()
                                            ->directory('heroes')
                                            ->disk('public'),
                                        FileUpload::make('hero.shop')
                                            ->label('Çarşı Hero')
                                            ->image()
                                            ->directory('heroes')
                                            ->disk('public'),
                                        FileUpload::make('hero.about')
                                            ->label('Hakkında Hero')
                                            ->image()
                                            ->directory('heroes')
                                            ->disk('public'),
                                    ]),
                            ]),

                        // ── ANALİTİK & REKLAMLAR ───────────────────────
                        Tab::make('Analitik & Reklam')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Section::make('Analitik Kodları')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('analytics.ga_id')
                                            ->label('Google Analytics ID')
                                            ->placeholder('G-XXXXXXXXXX'),
                                        TextInput::make('analytics.meta_pixel')
                                            ->label('Meta Pixel ID')
                                            ->placeholder('1234567890'),
                                    ]),
                                Section::make('Reklam Kodları')
                                    ->schema([
                                        TextInput::make('ads.adsense_publisher')
                                            ->label('AdSense Publisher ID')
                                            ->placeholder('pub-XXXXXXXXXXXXXXXX'),
                                        Textarea::make('ads.header_script')
                                            ->label('Header Script (tüm sayfalara eklenir)')
                                            ->rows(5)
                                            ->placeholder('<script async src="..."></script>'),
                                        Textarea::make('ads.footer_script')
                                            ->label('Footer Script (</body> öncesi)')
                                            ->rows(5),
                                    ]),
                            ]),

                        // ── CONTACT / GENEL ────────────────────────────
                        Tab::make('Genel')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('İletişim Bilgileri')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('site.email')
                                            ->label('İletişim E-posta')
                                            ->email()
                                            ->placeholder('sertac@sertacapanay.net'),
                                        TextInput::make('site.phone')
                                            ->label('Telefon')
                                            ->tel()
                                            ->placeholder('+90 555 000 0000'),
                                        TextInput::make('site.whatsapp')
                                            ->label('WhatsApp Numarası (başında +)')
                                            ->placeholder('+905550000000'),
                                        TextInput::make('site.maps_url')
                                            ->label('Google Maps Linki')
                                            ->url(),
                                    ]),
                                Section::make('Site Başlıkları')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('site.tagline_tr')
                                            ->label('Tagline (Türkçe)')
                                            ->placeholder('Kültürel anlatıcı, seyahat uzmanı'),
                                        TextInput::make('site.tagline_en')
                                            ->label('Tagline (English)')
                                            ->placeholder('Cultural storyteller, travel expert'),
                                    ]),
                                Section::make('Coming Soon')
                                    ->schema([
                                        Toggle::make('site.coming_soon')
                                            ->label('Coming Soon modunu aktif et')
                                            ->helperText('Aktif edildiğinde ziyaretçiler Coming Soon sayfasını görür, siz admin paneline erişebilirsiniz.'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            Setting::set($key, is_array($value) ? json_encode($value) : (string) $value);
        }

        Setting::clearCache();

        Notification::make()
            ->title('Ayarlar kaydedildi')
            ->success()
            ->send();
    }
}
