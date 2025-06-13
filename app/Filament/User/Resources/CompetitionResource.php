<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\CompetitionResource\Pages;
use App\Filament\User\Resources\CompetitionResource\RelationManagers\MembersRelationManager;
use App\Models\AcademicPeriod;
use App\Models\Competition;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Get;

class CompetitionResource extends Resource
{
    protected static ?string $navigationLabel = 'Kompetisi';

    protected static ?string $model = Competition::class;

    protected static ?string $modelLabel = 'Kompetisi';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('contest_id')
                    ->label('Program')
                    ->relationship(
                        name: 'contest',
                        titleAttribute: 'program_name',
                        modifyQueryUsing: function (Builder $query) {
                            $currentYear = AcademicPeriod::where('active', true)->first()?->year;

                            $query->whereNotNull('parent_id');

                            if ($currentYear) {
                                $query->whereHas('academicPeriod', function (Builder $subQuery) use ($currentYear) {
                                    $subQuery->where('year', $currentYear);
                                });
                            }
                        }
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) =>
                        "{$record->program_name} | Periode Lomba : Tahun {$record->academicPeriod->name}"
                    )
                    ->disabled(function (Get $get) {
                        $contest = \App\Models\Contest::with('academicPeriod')->find($get('contest_id'));
                        $year = $contest?->academicPeriod?->year;
                        return $year && intval($year) < now()->year;
                    })
                    ->searchable()
                    ->preload(),

                Forms\Components\TextInput::make('coach_name')
                    ->label('Nama Pembimbing')
                    ->required()
                    ->disabled(function (Get $get) {
                        $contest = \App\Models\Contest::with('academicPeriod')->find($get('contest_id'));
                        $year = $contest?->academicPeriod?->year;
                        return $year && intval($year) < now()->year;
                    }),

                Forms\Components\TextInput::make('coach_phone')
                    ->label('Nomor Telephone')
                    ->required()
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->disabled(function (Get $get) {
                        $contest = \App\Models\Contest::with('academicPeriod')->find($get('contest_id'));
                        $year = $contest?->academicPeriod?->year;
                        return $year && intval($year) < now()->year;
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->modifyQueryUsing(function (Builder $query) {
                $get_id = auth()->user()->id;
                $query->where('user_id', $get_id);
            })
            ->columns([
                Tables\Columns\TextColumn::make('contest.program_name')->wrap()->label('Nama Program'),
                Tables\Columns\TextColumn::make('contest.academicPeriod.year')->label('Periode'),
                Tables\Columns\TextColumn::make('coach_name')->label('Nama Pembimbing'),
                Tables\Columns\TextColumn::make('coach_phone')->label('Nomor Telephone'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Detail & Daftarkan Peserta')
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
            MembersRelationManager::class
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
