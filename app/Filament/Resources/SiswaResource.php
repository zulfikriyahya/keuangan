<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Kelas;
use App\Models\Siswa;
use Filament\Forms\Form;
use App\Models\Pembayaran;
use Filament\Tables\Table;
use App\Models\JenisPembayaran;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\BulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\SiswaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use IbrahimBougaoua\FilaProgress\Tables\Columns\ProgressBar;
use IbrahimBougaoua\FilaProgress\Tables\Columns\CircleProgress;
use App\Filament\Resources\SiswaResource\RelationManagers\PembayaransRelationManager;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationLabel = 'Siswa';

    protected static ?string $label = 'Siswa';

    protected static ?string $navigationGroup = 'Referensi';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
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
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->maxLength(16)
                            ->minLength(16)
                            ->unique(Siswa::class, 'nik', ignoreRecord: true)
                            ->validationMessages([
                                'unique' => 'NIK ini sudah terdaftar. Silakan masukkan ulang NIK anda.',
                                'min_digits' => 'Masukkan minimal 16 digit. Silakan masukkan ulang NIK anda.',
                                'max_digits' => 'Masukkan maksimal 16 digit. Silakan masukkan ulang NIK anda.',
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
                            ->reactive()
                            ->default('Aktif'),
                        // Forms\Components\DatePicker::make('lulus_tanggal')
                        //     ->label('Perkiraan Tanggal Lulus')
                        //     ->visible(fn($get) => $get('status') === 'Aktif'),
                        Forms\Components\DatePicker::make('mutasi_tanggal')
                            ->label('Tanggal Mutasi Keluar')
                            ->visible(fn($get) => $get('status') === 'Mutasi'),
                        Forms\Components\DatePicker::make('do_tanggal')
                            ->label('Tanggal Drop Out')
                            ->visible(fn($get) => $get('status') === 'Drop Out'),
                        Forms\Components\DatePicker::make('lulus_tanggal')
                            ->label('Tanggal Kelulusan')
                            ->visible(fn($get) => $get('status') === 'Alumni'),

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl('/default/foto.png'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->description(
                        fn(Siswa $record) => 'NISN: ' . $record->nisn ?? null
                    )
                    ->searchable(Siswa::count() > 10),

                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(Siswa::count() > 10),
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
                Tables\Columns\TextColumn::make('mutasi_tanggal')
                    ->date('d F Y')
                    ->label('Tanggal Mutasi Keluar')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('do_tanggal')
                    ->date('d F Y')
                    ->label('Tanggal Drop Out')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('lulus_tanggal')
                    ->date('d F Y')
                    ->label('Tahun Lulus')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->visible(fn(): string => Siswa::count() > 0)
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->icon('heroicon-o-user-circle')
                    ->color(fn($state): string => match ($state) {
                        'Laki-laki' => 'pria',
                        'Perempuan' => 'wanita'
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
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
                        'Aktif' => 'heroicon-o-check-circle',
                        'Nonaktif' => 'heroicon-o-x-circle',
                        'Mutasi' => 'heroicon-o-arrows-right-left',
                        'Alumni' => 'heroicon-o-academic-cap',
                        'Drop Out' => 'heroicon-o-arrow-right-start-on-rectangle',
                    }),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->visible(fn(): string => Siswa::count() > 0)
                    ->wrap()
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



                ProgressBar::make('bar')
                    ->label('Progress Pembayaran')
                    ->getStateUsing(function ($record) {
                        // Jumlah pembayaran per siswa
                        $progress = $record->pembayaran()->sum('nominal');

                        // Hitung total bulan antara diterimaTanggal dan lulus_tanggal
                        $diterimaTanggal = Carbon::parse($record->diterima_tanggal);
                        $lulusTanggal = Carbon::parse($record->lulus_tanggal);
                        $totalBulan = $diterimaTanggal->diffInMonths($lulusTanggal);

                        /* Lebih Efektif Perhitungannya Pertahun. karena setiap siswa bisa saja berubah jurusan.
                        Kalau ingin disekaliguskan. tolong pikirkan logika jika suatu saat siswa berpindah jurusan. */

                        $nominalPembayaran = $record->kelas->jurusan->jenisPembayaran()->pluck('nominal')->all();
                        // @dd($nominalPembayaran);

                        $totalYangHarusDibayar = $totalBulan * $nominalPembayaran[0];
                        return [
                            'total' => $totalYangHarusDibayar,
                            'progress' => $progress,
                        ];
                    }),
                // ->hideProgressValue(),
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
                        ->label('Set Status')
                        ->icon('heroicon-o-check-circle')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->form([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'Aktif' => 'Aktif',
                                    'Nonaktif' => 'Nonaktif',
                                    'Alumni' => 'Alumni',
                                    'Mutasi' => 'Mutasi',
                                    'Drop Out' => 'Drop Out',
                                ])
                                ->reactive()
                                ->required(),

                            DatePicker::make('lulus_tanggal')
                                ->label('Perkiraan Tanggal Kelulusan')
                                ->visible(fn($get) => $get('status') === 'Aktif')
                                ->required(fn($get) => $get('status') === 'Aktif'),
                            DatePicker::make('lulus_tanggal')
                                ->label('Tanggal Kelulusan')
                                ->maxDate(now())
                                ->visible(fn($get) => $get('status') === 'Alumni'),
                            DatePicker::make('mutasi_tanggal')
                                ->label('Tanggal Mutasi Keluar')
                                ->maxDate(now())
                                ->visible(fn($get) => $get('status') === 'Mutasi'),
                            DatePicker::make('do_tanggal')
                                ->label('Tanggal Drop Out')
                                ->maxDate(now())
                                ->visible(fn($get) => $get('status') === 'Drop Out'),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                $updateData = [
                                    'status' => $data['status'],
                                ];
                                // Tambahkan 'lulus_tanggal' hanya jika ada dalam $data
                                if (array_key_exists('lulus_tanggal', $data)) {
                                    $updateData['lulus_tanggal'] = $data['lulus_tanggal'];
                                }
                                // Tambahkan 'mutasi_tanggal' hanya jika ada dalam $data
                                if (array_key_exists('mutasi_tanggal', $data)) {
                                    $updateData['mutasi_tanggal'] = $data['mutasi_tanggal'];
                                }
                                // Tambahkan 'do_tanggal' hanya jika ada dalam $data
                                if (array_key_exists('do_tanggal', $data)) {
                                    $updateData['do_tanggal'] = $data['do_tanggal'];
                                }
                                Siswa::where('id', $record->id)->update($updateData);
                            });
                        }),

                    BulkAction::make('Set Kenaikan Kelas')
                        ->label('Set Kenaikan Kelas')
                        ->icon('heroicon-o-building-storefront')
                        ->color('success')
                        ->requiresConfirmation()
                        ->form([
                            Select::make('kelas')
                                ->label('Kelas')
                                ->relationship('kelas', 'nama')
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                Siswa::where('id', $record->id)->update([
                                    'kelas_id' => $data['kelas'],
                                ]);
                            });
                        }),

                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PembayaransRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
