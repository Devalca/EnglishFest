<?php

namespace App\Filament\Resources\CompetitionResource\RelationManagers;

use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    public function form(Form $form): Form
    {
        $owner = $this->ownerRecord->user_id;
        $edu = $this->ownerRecord->user->education;

        return $form
            ->schema([
                Forms\Components\Hidden::make('school')
                    ->default(fn() => $edu),

                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),

                Forms\Components\TextInput::make('number')
                    ->label('NISN')
                    ->numeric()
                    ->required()
                    ->rule(function () {
                        return function (string $attribute, $value, \Closure $fail) {
                            $competition = $this->ownerRecord;
                            $contest = $competition->contest;

                            if (! $contest) {
                                $fail("Kontes tidak ditemukan.");
                                return;
                            }

                            $academicPeriodId = $contest->academic_period_id;

                            if (! $academicPeriodId) {
                                $fail("Kontes belum terkait dengan periode akademik.");
                                return;
                            }

                            $query = \App\Models\Member::where('number', $value)
                                ->whereHas('competition.contest', function ($query) use ($academicPeriodId) {
                                    $query->where('academic_period_id', $academicPeriodId);
                                });

                            if ($this->ownerRecord) {
                                $query->where('id', '!=', $this->ownerRecord->id);
                            }

                            if ($query->exists()) {
                                $fail("NISN ini sudah terdaftar pada periode akademik yang sama.");
                            }
                        };
                    }),


                Forms\Components\DatePicker::make('date_birth'),
                // Forms\Components\FileUpload::make('payment_proof')
                //     ->label('Bukti Pembayaran')
                //     ->directory('file-payment/' . $owner)
                //     ->acceptedFileTypes(['image/jpeg', 'image/png'])
                //     ->downloadable()
                //     ->preserveFilenames(false)
                //     ->getUploadedFileNameForStorageUsing(fn($file) => $this->ownerRecord->user_id . '-' . time() . '.' . $file->getClientOriginalExtension())
                //     ->optimize('webp')
                //     ->resize(20)
                //     ->required(),
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->record;

        if ($record) {
            // Cek apakah ada perubahan payment_proof
            if (isset($data['payment_proof']) && $data['payment_proof'] !== $record->payment_proof) {
                if ($record->payment_proof && Storage::disk('public')->exists($record->payment_proof)) {
                    Storage::disk('public')->delete($record->payment_proof);
                }
            }
        }

        return $data;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordAction(null)
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('number')->label('NISN'),
                Tables\Columns\TextColumn::make('date_birth'),
                Tables\Columns\ImageColumn::make('payment_proof')
                    ->label('Bukti Pembayaran')
                    ->url(fn($record) => asset('storage/' . $record->payment_proof))
                    ->openUrlInNewTab(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit Member')
                    ->using(function (Model $record, array $data): Model {
                        if (isset($data['payment_proof']) && $record->payment_proof && $record->payment_proof !== $data['payment_proof']) {
                            Storage::disk('public')->delete($record->payment_proof);
                        }

                        $record->update($data);

                        return $record;
                    }),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Model $record) {
                        if ($record->payment_proof && Storage::disk('public')->exists($record->payment_proof)) {
                            Storage::disk('public')->delete($record->payment_proof);
                        }
                    }),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
