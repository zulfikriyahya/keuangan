<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstansiResource\Pages;
use App\Models\Instansi;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InstansiResource extends Resource
{
    protected static ?string $model = Instansi::class;

    protected static ?string $navigationLabel = 'Instansi';

    protected static ?string $label = 'Instansi';

    protected static ?string $navigationGroup = 'Referensi';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Instansi')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Instansi')
                            ->required(),
                        Forms\Components\TextInput::make('npsn')
                            ->label('NPSN')
                            ->placeholder('Nomor Pokok Sekolah Nasional'),
                        Forms\Components\TextInput::make('nss')
                            ->label('NSS/NSM')
                            ->placeholder('Nomor Statistik Sekolah/Madrasah'),
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo')
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
                            ->directory('img/logo')
                            ->fetchFileInformation(false),
                        Forms\Components\TextInput::make('alamat')
                            ->label('Alamat'),
                        Forms\Components\TextInput::make('kode_pos')
                            ->label('Kode Pos')
                            ->minLength(5)
                            ->maxLength(5),
                    ])
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                        'xl' => 3,
                    ]),
                Section::make('Informasi Kontak')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email(),
                        Forms\Components\TextInput::make('telepon')
                            ->label('Nomor Telepon')
                            ->tel(),
                        Forms\Components\TextInput::make('website')
                            ->label('Website'),
                    ])
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                        'xl' => 3,
                    ]),
                Section::make('Informasi Pejabat')
                    ->collapsed()
                    ->schema([
                        Forms\Components\Select::make('pimpinan_id')
                            ->label('Nama Pimpinan')
                            ->relationship('pimpinan', 'nama')
                            ->required()
                            ->native(false)
                            ->createOptionForm([
                                Section::make('Informasi Pimpinan')
                                    ->schema([
                                        Forms\Components\TextInput::make('nama')
                                            ->label('Nama Lengkap')
                                            ->required(),
                                        Forms\Components\TextInput::make('nip')
                                            ->label('NIP')
                                            ->minLength(18)
                                            ->maxLength(18),
                                        Forms\Components\TextInput::make('telepon')
                                            ->label('Nomor Telepon')
                                            ->tel()
                                            ->required(),
                                        Forms\Components\DatePicker::make('periode_awal')
                                            ->label('Periode Awal')
                                            ->maxDate(now()),
                                        Forms\Components\DatePicker::make('periode_akhir')
                                            ->label('Periode Akhir')
                                            ->minDate(now()),
                                        Forms\Components\Select::make('status')
                                            ->label('Status')
                                            ->options([
                                                'Aktif' => 'Aktif',
                                                'Nonaktif' => 'Nonaktif',
                                            ])
                                            ->default('Aktif')
                                            ->required(),
                                        FileUpload::make('foto')
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
                                            ->directory('img/foto')
                                            ->fetchFileInformation(false),
                                        FileUpload::make('tte')
                                            ->label('Tanda Tangan Elektronik')
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
                                            ->directory('img/tte')
                                            ->fetchFileInformation(false),
                                    ])
                                    ->columns([
                                        'sm' => 1,
                                        'lg' => 2,
                                        'xl' => 3,
                                    ]),
                            ]),
                        Forms\Components\Select::make('bendahara_id')
                            ->label('Nama Bendahara')
                            ->relationship('bendahara', 'nama')
                            ->required()
                            ->native(false)
                            ->createOptionForm([
                                Section::make('Informasi Bendahara')
                                    ->schema([
                                        Forms\Components\TextInput::make('nama')
                                            ->label('Nama Lengkap')
                                            ->required(),
                                        Forms\Components\TextInput::make('nip')
                                            ->label('NIP')
                                            ->minLength(18)
                                            ->maxLength(18),
                                        Forms\Components\TextInput::make('telepon')
                                            ->label('Nomor Telepon')
                                            ->tel()
                                            ->required(),
                                        Forms\Components\DatePicker::make('periode_awal')
                                            ->label('Periode Awal'),
                                        Forms\Components\DatePicker::make('periode_akhir')
                                            ->label('Periode Akhir'),
                                        Forms\Components\Select::make('status')
                                            ->label('Status')
                                            ->options([
                                                'Aktif' => 'Aktif',
                                                'Nonaktif' => 'Nonaktif',
                                            ])
                                            ->default('Aktif')
                                            ->required(),
                                        FileUpload::make('foto')
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
                                            ->directory('img/foto')
                                            ->fetchFileInformation(false),
                                        FileUpload::make('tte')
                                            ->label('Tanda Tangan Elektronik')
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
                                            ->directory('img/tte')
                                            ->fetchFileInformation(false),
                                    ])
                                    ->columns([
                                        'sm' => 1,
                                        'lg' => 2,
                                        'xl' => 3,
                                    ]),
                            ]),
                    ])
                    ->disabledOn('edit')
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                        'xl' => 3,
                    ]),
                Section::make('Informasi Rekening')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('nama_bank')
                            ->label('Nama Bank'),
                        Forms\Components\TextInput::make('nama_rekening')
                            ->label('Nama Rekening'),
                        Forms\Components\TextInput::make('nomor_rekening')
                            ->label('Nomor Rekening'),
                    ])
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                        'xl' => 3,
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->defaultImageUrl('/default/foto.png'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Instansi'),
                Tables\Columns\TextColumn::make('npsn')
                    ->label('NPSN'),
                Tables\Columns\TextColumn::make('nss')
                    ->label('NSS/NSM'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('telepon')
                    ->label('Nomor Telepon')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('website')
                    ->label('Website')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kode_pos')
                    ->label('Kode Pos')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pimpinan.nama')
                    ->label('Nama Pimpinan')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('bendahara.nama')
                    ->label('Nama Bendahara')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nama_bank')
                    ->label('Nama Bank')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nama_rekening')
                    ->label('Nama Rekening')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nomor_rekening')
                    ->label('Nomor Rekening')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
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
            'index' => Pages\ListInstansis::route('/'),
        ];
    }
}
