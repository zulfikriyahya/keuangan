<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Pengeluaran;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\PengeluaranResource\Pages;

class PengeluaranResource extends Resource
{
    protected static ?string $model = Pengeluaran::class;

    protected static ?string $navigationLabel = 'Pengeluaran';

    protected static ?string $label = 'Jurnal Pengeluaran';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pengeluaran')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama')
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->date('d F Y'),
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
                            ->directory('img/kwitansi/pengeluaran')
                            ->fetchFileInformation(false)
                            ->required(),
                        Forms\Components\Select::make('jenis_pengeluaran_id')
                            ->label('Jenis Pengeluaran')
                            ->relationship('jenisPengeluaran', 'nama')
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
                    ->label('Nama')
                    ->searchable(Pengeluaran::count() > 10),
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
                    ->numeric()
                    ->prefix('Rp. ')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('kwitansi')
                    ->label('Kuitansi'),
                Tables\Columns\TextColumn::make('jenisPengeluaran.nama')
                    ->label('Jenis Pengeluaran')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Catatan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visible(fn(): string => Pengeluaran::count() > 0),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visible(fn(): string => Pengeluaran::count() > 0),
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
            'index' => Pages\ListPengeluarans::route('/'),
            'create' => Pages\CreatePengeluaran::route('/create'),
            'edit' => Pages\EditPengeluaran::route('/{record}/edit'),
        ];
    }
}
