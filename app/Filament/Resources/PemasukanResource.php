<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pemasukan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\PemasukanResource\Pages;

class PemasukanResource extends Resource
{
    protected static ?string $model = Pemasukan::class;

    protected static ?string $navigationLabel = 'Pemasukan';

    protected static ?string $label = 'Jurnal Pemasukan';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pemasukan')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama')
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required(),
                        Forms\Components\Select::make('bulan_id')
                            ->label('Bulan')
                            ->relationship('bulan', 'nama')
                            ->required(),
                        Forms\Components\Select::make('tahun_id')
                            ->label('Tahun')
                            ->relationship('tahun', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal')
                            ->required()
                            ->prefix('Rp. ')
                            ->numeric(),
                        Forms\Components\FileUpload::make('kwitansi')
                            ->label('Bukti/Kuitansi')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1' => '1:1',
                                '4:3' => '4:3',
                                '3:4' => '3:4',
                                '9:16' => '9:16',
                                '16:9' => '16:9',
                            ])
                            ->directory('img/kwitansi/pemasukan')
                            ->fetchFileInformation(false)
                            ->required(),
                        Forms\Components\Select::make('jenis_pemasukan_id')
                            ->label('Jenis Pemasukan')
                            ->relationship('jenisPemasukan', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('deskripsi')
                            ->label('Catatan'),
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
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bulan.nama')
                    ->label('Bulan'),
                Tables\Columns\TextColumn::make('tahun.nama')
                    ->label('Tahun'),
                Tables\Columns\TextColumn::make('nominal')
                    ->label('Nominal')
                    ->prefix('Rp. ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('kwitansi')
                    ->label('Kuitansi'),
                Tables\Columns\TextColumn::make('jenisPemasukan.nama')
                    ->label('Jenis Pemasukan'),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Catatan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPemasukans::route('/'),
            'create' => Pages\CreatePemasukan::route('/create'),
            'edit' => Pages\EditPemasukan::route('/{record}/edit'),
        ];
    }
}
