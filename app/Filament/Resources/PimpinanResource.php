<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PimpinanResource\Pages;
use App\Models\Pimpinan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PimpinanResource extends Resource
{
    protected static ?string $model = Pimpinan::class;

    protected static ?string $navigationLabel = 'Pimpinan';

    protected static ?string $label = 'Pimpinan Instansi';

    protected static ?string $navigationGroup = 'Referensi';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->defaultImageUrl('/default/foto.png')
                    ->circular(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->description(fn (Pimpinan $record) => 'NIP '.$record->nip),
                Tables\Columns\TextColumn::make('periode_awal')
                    ->label('Periode')
                    ->date('d F Y')
                    ->description(function (Pimpinan $record) {
                        if ($record->periode_akhir) {
                            return 'Hingga: '.date('d F Y', strtotime($record->periode_akhir));
                        }

                        return 'Hingga: (Sekarang)';
                    }),
                Tables\Columns\TextColumn::make('telepon')
                    ->label('Nomor Telepon'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Nonaktif' => 'gray'
                    }),
                Tables\Columns\ImageColumn::make('tte')
                    ->label('TTE'),
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
            'index' => Pages\ListPimpinans::route('/'),
        ];
    }
}
