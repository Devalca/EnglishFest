<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompetitionResource\Pages;
use App\Filament\Resources\CompetitionResource\RelationManagers\MembersRelationManager;
use App\Models\AcademicPeriod;
use App\Models\Competition;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CompetitionResource extends Resource
{
    protected static ?string $model = Competition::class;

    protected static ?string $navigationGroup = 'Champions';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    // Pastikan eager load relasi
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['contest.academicPeriod', 'user', 'members']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Username')
                    ->options(User::where('is_admin', false)->pluck('name', 'id')),
                Forms\Components\Select::make('contest_id')
                    ->relationship(
                        name: 'contest',
                        titleAttribute: 'program_name',
                        modifyQueryUsing: fn(Builder $query) => $query->whereNotNull('parent_id'),
                    ),
                Forms\Components\TextInput::make('coach_name'),
                Forms\Components\TextInput::make('coach_phone')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                Tables\Columns\TextColumn::make('contest.academicPeriod.year')->wrap()->label('Periode Lomba'),
                Tables\Columns\TextColumn::make('user.education')
                    ->wrap()
                    ->label('Nama Sekolah')
                    ->description(fn($record): string => $record->coach_name),
                Tables\Columns\TextColumn::make('contest.program_name')->wrap(),
                Tables\Columns\TextColumn::make('coach_phone')->label('Nomor Telephone'),
                Tables\Columns\TextColumn::make('members.name')->wrap()
            ])
            ->filters([
                SelectFilter::make('academic_period')
                    ->label('Periode Lomba')
                    ->options(function () {
                        return \App\Models\AcademicPeriod::orderBy('year', 'desc')
                            ->pluck('year', 'id')
                            ->toArray();
                    })
                    ->default(function () {
                        $currentYear = Carbon::now()->year;
                        $period = \App\Models\AcademicPeriod::where('year', $currentYear)->first();
                        return $period ? $period->id : null;
                    })
                    ->query(function (Builder $query, $data) {
                        if (isset($data['value']) && $data['value']) {
                            $value = $data['value'];
                            $query->whereHas('contest', function ($q) use ($value) {
                                $q->where('academic_period_id', $value);
                            });
                        }
                    })
                    ->searchable()
                    ->native(false)
                    ->preload()
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()->label('Detail'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            MembersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompetitions::route('/'),
            'create' => Pages\CreateCompetition::route('/create'),
            'edit' => Pages\EditCompetition::route('/{record}/edit'),
        ];
    }
}
