<?php

namespace App\Filament\Resources\KelasResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Siswa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SiswaRelationManager extends RelationManager
{
    protected static string $relationship = 'siswa';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Siswa')
                            ->required(),
                        Forms\Components\TextInput::make('nisn')
                            ->label('NISN')
                            ->maxLength(10)
                            ->minLength(10)
                            ->unique(Siswa::class, 'nisn', ignoreRecord: true)
                            ->validationMessages([
                                'unique' => 'NISN ini sudah terdaftar. Silakan masukkan ulang NISN anda.',
                                'min_digits' => 'Masukkan minimal 10 digit. Silakan masukkan ulang NISN anda.',
                                'max_digits' => 'Masukkan maksimal 10 digit. Silakan masukkan ulang NISN anda.',
                            ])
                            ->numeric()
                            ->required(),
                        Forms\Components\DatePicker::make('diterima_tanggal')
                            ->label('Tanggal Diterima')
                            ->required(),
                        Forms\Components\Select::make('kelas_id')
                            ->label('Kelas')
                            ->relationship('kelas', 'nama')
                            ->preload(5)
                            ->searchable()
                            ->required(),
                        Forms\Components\DatePicker::make('lulus_tanggal')
                            ->label('Tanggal Kelulusan'),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]),
                        Forms\Components\TextInput::make('nama_ibu')
                            ->label('Nama Ibu'),
                        Forms\Components\TextInput::make('nama_ayah')
                            ->label('Nama Ayah'),
                        Forms\Components\TextInput::make('telepon')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(13)
                            ->minLength(10)
                            ->validationMessages([
                                'min_digits' => 'Masukkan minimal 10 digit. Silakan masukkan ulang Nomor Telepon anda.',
                                'max_digits' => 'Masukkan maksimal 13 digit. Silakan masukkan ulang Nomor Telepon anda.',
                            ])
                            ->numeric()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'Aktif' => 'Aktif',
                                'Nonaktif' => 'Nonaktif',
                                'Mutasi' => 'Mutasi',
                                'Alumni' => 'Alumni',
                                'Drop Out' => 'Drop Out',
                            ])
                            ->default('Aktif'),
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat'),
                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1' => '1:1',
                                '3:4' => '3:4',
                                '4:3' => '4:3',
                            ])
                            ->minSize(10)
                            ->maxSize(1024)
                            ->directory('img/foto/siswa')
                            ->fetchFileInformation(false)
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'sm' => 1,
                        'xl' => 3,
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl('/default/foto.png'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Siswa')
                    ->description(
                        fn(Siswa $record) => 'NISN: ' . $record->nisn ?? null
                    )
                    ->searchable(Siswa::count() > 0),
                Tables\Columns\TextColumn::make('diterima_tanggal')
                    ->date('d F Y')
                    ->label('Tanggal Diterima'),
                Tables\Columns\TextColumn::make('kelas.nama')
                    ->label('Kelas')
                    ->description(function (Siswa $record) {
                        return implode(' | ', [
                            $record->kelas->jenjang,
                            $record->kelas->jurusan->nama,
                        ]);
                    }),
                Tables\Columns\TextColumn::make('lulus_tanggal')
                    ->date('Y')
                    ->label('Tahun Lulus'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Nonaktif' => 'gray',
                        'Mutasi' => 'warning',
                        'Alumni' => 'info',
                        'Drop Out' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'Aktif' => 'heroicon-m-check-circle',
                        'Nonaktif' => 'heroicon-m-x-circle',
                        'Mutasi' => 'heroicon-m-arrows-right-left',
                        'Alumni' => 'heroicon-m-academic-cap',
                        'Drop Out' => 'heroicon-m-arrow-right-start-on-rectangle',
                    }),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->visible(fn(): string => Siswa::count() > 0)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->visible(fn(): string => Siswa::count() > 0)
                    ->label('Jenis Kelamin')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nama_ibu')
                    ->label('Nama Ibu')
                    ->visible(fn(): string => Siswa::count() > 0)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nama_ayah')
                    ->visible(fn(): string => Siswa::count() > 0)
                    ->label('Nama Ayah')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('telepon')
                    ->label('Nomor Telepon')
                    ->visible(fn(): string => Siswa::count() > 0)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('Kelas')
                    ->label('Kelas')
                    ->relationship('kelas', 'nama')
                    ->visible(fn(): string => Siswa::count() > 10),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->hidden(function ($record) {
                            if ($record->pembayaran()->count() > 0) {
                                return $record;
                            }
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('Ubah Status')
                        ->icon('heroicon-o-check-circle')
                        ->requiresConfirmation()
                        ->form([
                            Select::make('Status')
                                ->label('Status')
                                ->options([
                                    'Aktif' => 'Aktif',
                                    'Nonaktif' => 'Nonaktif',
                                    'Alumni' => 'Alumni',
                                    'Mutasi' => 'Mutasi',
                                    'Drop Out' => 'Drop Out',
                                ])
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                Siswa::where('id', $record->id)->update([
                                    'status' => $data['Status'],
                                ]);
                            });
                        }),
                    BulkAction::make('Ubah Kelas')
                        ->icon('heroicon-o-building-storefront')
                        ->requiresConfirmation()
                        ->form([
                            Select::make('Kelas')
                                ->label('Kelas')
                                ->relationship('kelas', 'nama')
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                Siswa::where('id', $record->id)->update([
                                    'kelas_id' => $data['Kelas'],
                                ]);
                            });
                        }),
                ]),
            ]);
    }
}
