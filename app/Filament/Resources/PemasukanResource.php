<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemasukanResource\Pages;
use App\Models\Pemasukan;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PemasukanResource extends Resource
{
    protected static ?string $model = Pemasukan::class;

    protected static ?string $navigationLabel = 'Pemasukan';

    protected static ?string $label = 'Jurnal Pemasukan';

    protected static ?string $navigationGroup = 'Jurnal Keuangan';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pemasukan')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required(),
                        Forms\Components\TextInput::make('kode')
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->required(),
                        Forms\Components\Select::make('bulan_id')
                            ->relationship('bulan', 'nama')
                            ->required(),

                        Forms\Components\Select::make('tahun_id')
                            ->relationship('tahun', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('nominal')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('kwitansi'),
                        Forms\Components\Select::make('jenis_pemasukan_id')
                            ->relationship('jenisPemasukan', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('deskripsi'),
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
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('kode'),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bulan.nama'),
                Tables\Columns\TextColumn::make('tahun.nama'),
                Tables\Columns\TextColumn::make('nominal')
                    ->prefix('Rp. ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('kwitansi'),
                Tables\Columns\TextColumn::make('jenisPemasukan.nama'),
                Tables\Columns\TextColumn::make('deskripsi'),
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
