<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Testimonials';
    protected static \UnitEnum|string|null $navigationGroup = 'İçerik';
    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        $count = Testimonial::where('is_approved', false)->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('guest_user_id')
                ->relationship('guestUser', 'name')
                ->label('Kullanıcı')
                ->disabled(),

            Forms\Components\Select::make('tour_id')
                ->relationship('tour', 'title_tr')
                ->label('Tur')
                ->nullable(),

            Forms\Components\Textarea::make('body')
                ->label('Yorum')
                ->rows(5)
                ->required(),

            Forms\Components\Toggle::make('is_approved')
                ->label('Onaylı')
                ->default(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('guestUser.name')
                    ->label('Kullanıcı')
                    ->searchable(),

                Tables\Columns\TextColumn::make('guestUser.email')
                    ->label('E-posta')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('tour.title_tr')
                    ->label('Tur')
                    ->default('—'),

                Tables\Columns\TextColumn::make('body')
                    ->label('Yorum')
                    ->limit(80),

                Tables\Columns\IconColumn::make('is_approved')
                    ->label('Onaylı')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarih')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('Onay Durumu')
                    ->trueLabel('Onaylı')
                    ->falseLabel('Bekleyen'),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Onayla')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (Testimonial $record) => ! $record->is_approved)
                    ->action(fn (Testimonial $record) => $record->update(['is_approved' => true])),

                Tables\Actions\Action::make('reject')
                    ->label('Reddet')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Testimonial $record) => $record->is_approved)
                    ->action(fn (Testimonial $record) => $record->update(['is_approved' => false])),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('approve_all')
                        ->label('Seçilenleri Onayla')
                        ->icon('heroicon-o-check')
                        ->action(fn ($records) => $records->each->update(['is_approved' => true])),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTestimonials::route('/'),
            'edit'   => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
