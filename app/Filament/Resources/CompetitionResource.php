<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompetitionResource\Pages;
use App\Filament\Resources\CompetitionResource\RelationManagers;
use App\Filament\Resources\CompetitionResource\RelationManagers\MembersRelationManager;
use App\Models\Competition;
use App\Models\Member;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompetitionResource extends Resource
{
    protected static ?string $model = Competition::class;

    protected static ?string $navigationGroup = 'Champions';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Username')
                    ->options(User::where('is_admin', false)->pluck('name', 'id')),
                Forms\Components\Select::make('contest_id')
                    ->relationship(
                        name: 'contests',
                        titleAttribute: 'program_name',
                        modifyQueryUsing: fn (Builder $query) => $query->where('parent_id', '!=', null),
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
            ->columns([
                Tables\Columns\TextColumn::make('users.education')->label('Nama Sekolah'),
                Tables\Columns\TextColumn::make('coach_name')->label('Nama Pembimbing'),
                Tables\Columns\TextColumn::make('coach_phone')->label('Nomor Telephone'),
                Tables\Columns\TextColumn::make('members.name')
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
