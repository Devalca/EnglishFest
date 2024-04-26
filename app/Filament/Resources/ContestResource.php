<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContestResource\Pages;
use App\Filament\Resources\ContestResource\RelationManagers;
use App\Models\Contest;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
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
                Forms\Components\Select::make('parent_id')
                    ->live()
                    ->relationship(
                        name: 'parent',
                        titleAttribute: 'program_name',
                        modifyQueryUsing: fn (Builder $query) => $query->where('parent_id', null),
                    ),
                Forms\Components\TextInput::make('program_name')->required(),
                Forms\Components\FileUpload::make('image')
                    ->hidden(fn (Get $get) => $get('parent_id') == null)
                    ->directory('file-contest')
                    ->acceptedFileTypes(['image/png', 'image/jpeg'])
                    ->downloadable(),
                Forms\Components\FileUpload::make('guidelines')
                    ->hidden(fn (Get $get) => $get('parent_id') == null)
                    ->directory('file-guidelines')
                    ->acceptedFileTypes([
                        'application/pdf',
                    ])
                    ->downloadable(),
                DatePicker::make('time_start')->hidden(fn (Get $get) => $get('parent_id') == null),
                DatePicker::make('time_end')->hidden(fn (Get $get) => $get('parent_id') == null),
                Forms\Components\Textarea::make('desc'),
                RichEditor::make('condition')->hidden(fn (Get $get) => $get('parent_id') == null),
                RichEditor::make('terms')->hidden(fn (Get $get) => $get('parent_id') == null),
                RichEditor::make('assessment')->hidden(fn (Get $get) => $get('parent_id') == null),
                RichEditor::make('awards')->hidden(fn (Get $get) => $get('parent_id') == null),
            ]);
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
