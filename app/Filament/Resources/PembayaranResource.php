<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pembayaran;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\PembayaranResource\Pages;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;
    protected static ?string $navigationLabel = 'Pembayaran';

    protected static ?string $label = 'Jurnal Pembayaran';

    protected static ?string $navigationGroup = 'Jurnal Keuangan';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pembayaran')
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal')
                            ->required(),
                        Forms\Components\Select::make('jenis_pembayaran_id')
                            ->relationship('jenisPembayaran', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('deskripsi'),

                        Forms\Components\Select::make('bulan_id')
                            ->relationship('bulan', 'nama')
                            ->required(),

                        Forms\Components\Select::make('tahun_id')
                            ->relationship('tahun', 'nama')
                            ->required(),

                        Forms\Components\TextInput::make('nominal')
                            ->required()
                            ->prefix('Rp. ')
                            ->numeric(),

                        Forms\Components\FileUpload::make('kwitansi')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1' => '1:1',
                                '4:3' => '4:3',
                                '3:4' => '3:4',
                                '9:16' => '9:16',
                                '16:9' => '16:9',
                            ]),

                        Forms\Components\TextInput::make('status')
                            ->required(),

                        Forms\Components\Select::make('siswa_id')
                            ->relationship('siswa', 'nama')
                            ->required(),
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
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenisPembayaran.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bulan.nama'),
                Tables\Columns\TextColumn::make('tahun.nama'),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('kwitansi'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
