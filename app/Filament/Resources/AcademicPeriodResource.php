<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicPeriodResource\Pages;
use App\Filament\Resources\AcademicPeriodResource\RelationManagers;
use App\Models\AcademicPeriod;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AcademicPeriodResource extends Resource
{
    protected static ?string $model = AcademicPeriod::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 5;

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

    public static function canCreate(): bool
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

    public static function canDelete($record): bool
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin == true) {
                return true;
            }
        }

        return false;
    }

    public static function getAcademicYearsOptions(): array
    {
        $years = [];
        $currentYear = now()->year;

        for ($i = 0; $i < 5; $i++) {
            $startYear = $currentYear - $i;
            $endYear = $startYear + 1;
            $label = "{$startYear}/{$endYear}";
            $years[$label] = $label;
        }

        return $years;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Periode')
                    ->required(),

                Select::make('year')
                    ->label('Tahun Akademik')
                    ->options(self::getAcademicYearsOptions())
                    ->unique(ignorable: fn($record) => $record)
                    ->required(),

                Toggle::make('active')
                    ->label('Aktifkan Periode Ini?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('year'),
                IconColumn::make('active')
                    ->boolean()
                    ->label('Aktif'),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListAcademicPeriods::route('/'),
            'create' => Pages\CreateAcademicPeriod::route('/create'),
            'edit' => Pages\EditAcademicPeriod::route('/{record}/edit'),
        ];
    }
}
