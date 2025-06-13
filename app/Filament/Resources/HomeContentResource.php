<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeContentResource\Pages;
use App\Models\HomeContent;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// HAPUS FILE APAPUN KETIKA MELAKUKAN EDIT

class HomeContentResource extends Resource
{
    protected static ?string $model = HomeContent::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function canViewAny(): bool
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin == true) {
                return true;
            }
        }

        return false;
    }

    public static function canEdit($record): bool
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin == true) {
                return true;
            }
        }

        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin == true) {
                return true;
            }
        }

        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        TextInput::make('title')->label('Judul Utama')->columnSpanFull(),
                                        Textarea::make('description')->rows(10)->label('Deskripsi')->columnSpanFull(),
                                    ]),
                                Grid::make()
                                    ->schema([
                                        FileUpload::make('hero_image')
                                            ->label('Gambar Hero')
                                            ->image()
                                            ->disk('public')
                                            ->directory('file-home')
                                            ->preserveFilenames(false)
                                            ->getUploadedFileNameForStorageUsing(fn($file) => 'hero-' . time() . '.' . $file->getClientOriginalExtension()),
                                        FileUpload::make('logo_image')
                                            ->label('Gambar Logo')
                                            ->image()
                                            ->disk('public')
                                            ->directory('file-home')
                                            ->preserveFilenames(false)
                                            ->getUploadedFileNameForStorageUsing(fn($file) => 'logo-' . time() . '.' . $file->getClientOriginalExtension()),
                                    ]),
                            ]),
                    ]),
                Section::make('Quote')
                    ->schema([
                        Textarea::make('quote')->label('Quote'),
                    ]),
                Section::make('Kontak & Sosial Media')
                    ->schema([
                        Textarea::make('contact_paragraph')->rows(10)->label('Paragraf Kontak'),
                        TextInput::make('whatsapp_link')->label('Link WhatsApp'),
                        TextInput::make('email')->label('Email'),
                        TextInput::make('instagram')->label('Instagram'),
                    ]),
                Section::make('Customer Service (CS)')
                    ->schema([
                        Repeater::make('cs')
                            ->schema([
                                TextInput::make('name')->label('Nama CS')->required(),
                                TextInput::make('wa_number')->label('Nomor WA')->required(),
                                TextInput::make('wa_link')->label('Link WhatsApp')->required(),
                            ])
                            ->columns(3)
                            ->minItems(1),
                    ]),
                Section::make('Biaya')
                    ->schema([
                        TextInput::make('payment_title')->label('Nomor Dana/OVO'),
                        TextInput::make('payment_number')->label('Nomor Dana/OVO'),
                        TextInput::make('payment_owner')->label('A.N (Pemilik Rekening)'),
                        Repeater::make('fees')->schema([
                            TextInput::make('title')->label('Jenis Lomba'),
                            TextInput::make('price')->label('Harga'),
                        ])->columns(2),
                    ]),
                Section::make('Tentang Kami')
                    ->schema([
                        Textarea::make('about_paragraph')->rows(10)->label('Paragraf Tentang Kami'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->wrap()->label('Title'),
                Tables\Columns\TextColumn::make('description')->wrap()->label('Description'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Nonaktifkan delete bulk action supaya tidak bisa hapus massal
                // Tapi kamu bisa tambah bulk action lain jika mau
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeContents::route('/'),
            //'create' => Pages\CreateHomeContent::route('/create'), // dinonaktifkan
            'edit' => Pages\EditHomeContent::route('/{record}/edit'),
        ];
    }
}
