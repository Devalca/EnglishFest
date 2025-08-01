<?php

namespace App\Filament\User\Resources\CompetitionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'Members';

    protected function isExpired(): bool
    {
        $year = $this->getOwnerRecord()?->contest?->academicPeriod?->year;

        return $year && intval($year) < now()->year;
    }

    public function form(Form $form): Form
    {
        $disabled = $this->isExpired();

        return $form
            ->schema([
                Hidden::make('school')
                    ->default(fn() => auth()->user()->education),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->disabled($disabled)
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Nomor Whatsapp')
                    ->tel()
                    ->disabled($disabled)
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
                Forms\Components\DatePicker::make('date_birth')
                    ->disabled($disabled)
                    ->label('Tanggal Lahir'),
                // Forms\Components\FileUpload::make('payment_proof')
                //     ->disabled($disabled)
                //     ->label('Bukti Pembayaran')
                //     ->directory('file-payment/' . auth()->user()->id)
                //     ->acceptedFileTypes(['image/jpeg', 'image/png'])
                //     ->downloadable()
                //     ->preserveFilenames(false)
                //     ->getUploadedFileNameForStorageUsing(fn($file) => $this->ownerRecord->user_id . '-' . time() . '.' . $file->getClientOriginalExtension())
                //     ->optimize('webp')
                //     ->resize(20)
                //     ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        $disabled = $this->isExpired();

        return $table
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
                Tables\Actions\CreateAction::make()
                    ->label('Daftarkan Peserta')
                    ->disabled($disabled),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit Member')
                    ->disabled($disabled)
                    ->using(function (Model $record, array $data): Model {
                        if (isset($data['payment_proof']) && $record->payment_proof && $record->payment_proof !== $data['payment_proof']) {
                            Storage::disk('public')->delete($record->payment_proof);
                        }

                        $record->update($data);

                        return $record;
                    }),
                Tables\Actions\DeleteAction::make()
                    ->disabled($disabled)
                    ->before(function (Model $record) {
                        if ($record->payment_proof && Storage::disk('public')->exists($record->payment_proof)) {
                            Storage::disk('public')->delete($record->payment_proof);
                        }
                    }),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make()->disabled($disabled),
                // ]),
            ]);
    }
}
