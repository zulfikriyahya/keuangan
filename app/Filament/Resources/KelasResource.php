<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kelas;
use App\Models\Siswa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\KelasResource\Pages;
use App\Filament\Resources\KelasResource\RelationManagers\SiswaRelationManager;

class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static ?string $navigationLabel = 'Rombel/Kelas';

    protected static ?string $label = 'Rombel/Kelas';

    protected static ?string $navigationGroup = 'Referensi';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kelas')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required(),
                        Forms\Components\Select::make('jenjang')
                            ->required()
                            ->options([
                                'PAUD' => 'PAUD',
                                'TK' => 'TK',
                                'SD/MI' => 'SD/MI',
                                'SMP/MTS' => 'SMP/MTs',
                                'SMA/SMK/MA' => 'SMA/SMK/MA',
                            ]),
                        Forms\Components\Select::make('tingkat')
                            ->required()
                            ->options([
                                'PAUD' => 'PAUD',
                                'TK' => 'TK',
                                '1' => '1 - SD/MI',
                                '2' => '2 - SD/MI',
                                '3' => '3 - SD/MI',
                                '4' => '4 - SD/MI',
                                '5' => '5 - SD/MI',
                                '6' => '6 - SD/MI',
                                '7' => '7 - SMP/MTs',
                                '8' => '8 - SMP/MTs',
                                '9' => '9 - SMP/MTs',
                                '10' => '10 - SMA/SMK/MA',
                                '11' => '11 - SMA/SMK/MA',
                                '12' => '12 - SMA/SMK/MA',
                            ]),
                        Forms\Components\Select::make('jurusan_id')
                            ->relationship('jurusan', 'nama')
                            ->required()
                            ->createOptionForm([
                                Section::make('Informasi Jurusan')
                                    ->schema([
                                        Forms\Components\TextInput::make('nama')
                                            ->required(),
                                        Forms\Components\TextInput::make('kode')
                                            ->required(),
                                    ])
                                    ->columns([
                                        'sm' => 1,
                                        'lg' => 2,
                                    ]),
                            ]),
                    ])
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Kelas'),
                Tables\Columns\TextColumn::make('tingkat'),
                Tables\Columns\TextColumn::make('jenjang'),
                Tables\Columns\TextColumn::make('jurusan.nama'),
                Tables\Columns\TextColumn::make('total_siswa')
                    ->label('Total Siswa')
                    ->badge()
                    ->color('success')
                    ->getStateUsing(fn($record): string => $record->siswa()->count() . " Orang"),
                Tables\Columns\TextColumn::make('total_pria')
                    ->label('Total Laki-Laki')
                    ->badge()
                    ->color('pria')
                    ->getStateUsing(fn($record): string => $record->siswa()->where('jenis_kelamin', 'Laki-laki')->count() . " Siswa"),
                Tables\Columns\TextColumn::make('total_wanita')
                    ->label('Total Perempuan')
                    ->badge()
                    ->color('wanita')
                    ->getStateUsing(fn($record): string => $record->siswa()->where('jenis_kelamin', 'Perempuan')->count() . " Siswi"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->hidden(function ($record) {
                            if ($record->siswa()->count() > 0) {
                                return $record;
                            }
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SiswaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelas::route('/'),
            'create' => Pages\CreateKelas::route('/create'),
            'edit' => Pages\EditKelas::route('/{record}/edit'),
        ];
    }
}
