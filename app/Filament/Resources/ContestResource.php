<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContestResource\Pages;
use App\Filament\Resources\ContestResource\RelationManagers;
use App\Models\Contest;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContestResource extends Resource
{
    protected static ?string $model = Contest::class;

    protected static ?string $navigationGroup = 'Champions';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Select::make('parent_id')
                            ->label('Nama Lomba')
                            ->hint('Kosongkan Jika Ingin Membuat Lomba Baru')
                            ->hintColor('danger')
                            ->helperText(new HtmlString('<span style="color: green;">Pilih Lomba Untuk Mendaftarkan Program Lomba</span>'))
                            ->live()
                            ->relationship(
                                name: 'parent',
                                titleAttribute: 'program_name',
                                modifyQueryUsing: fn (Builder $query) => $query->where('parent_id', null),
                            ),
                        Forms\Components\TextInput::make('program_name')
                            ->label('Nama Program Untuk Lomba Tertentu')->required(),
                        Forms\Components\FileUpload::make('image')
                            ->required()
                            ->label('Gambar Lomba')
                            ->hidden(fn (Get $get) => $get('parent_id') == null)
                            ->directory('file-contest')
                            ->acceptedFileTypes(['image/png', 'image/jpeg'])
                            ->downloadable(),
                        Forms\Components\FileUpload::make('guidelines')
                            ->required()
                            ->label('Panduan')
                            ->hidden(fn (Get $get) => $get('parent_id') == null)
                            ->directory('file-guidelines')
                            ->acceptedFileTypes([
                                'application/pdf',
                            ])
                            ->downloadable(),
                    ])->columnSpan(8),
                Section::make()
                    ->schema([
                        DatePicker::make('time_start')->hidden(fn (Get $get) => $get('parent_id') == null)->required(),
                        DatePicker::make('time_end')->hidden(fn (Get $get) => $get('parent_id') == null)->required(),
                    ])->columnSpan(4),
                Forms\Components\Textarea::make('desc')
                    ->label('Keterangan Lomba')->columnSpanFull(),
                RichEditor::make('condition')
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->label('PERSYARATAN')->hidden(fn (Get $get) => $get('parent_id') == null)->columnSpanFull(),
                RichEditor::make('terms')
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->label('KETENTUAN DAN TAHAPAN PERLOMBAAN')->hidden(fn (Get $get) => $get('parent_id') == null)->columnSpanFull(),
                RichEditor::make('assessment')
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->label('ASPEK PENILAIAN')->hidden(fn (Get $get) => $get('parent_id') == null)->columnSpanFull(),
                RichEditor::make('awards')
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->label('HADIAH DAN PENGHARGAAN')->hidden(fn (Get $get) => $get('parent_id') == null)->columnSpanFull(),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent_id'),
                Tables\Columns\TextColumn::make('program_name'),
                Tables\Columns\TextColumn::make('desc')->limit(20),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('guidelines')->limit(20),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListContests::route('/'),
            'create' => Pages\CreateContest::route('/create'),
            'edit' => Pages\EditContest::route('/{record}/edit'),
        ];
    }
}
