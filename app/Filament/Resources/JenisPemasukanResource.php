<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\JenisPemasukan;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\JenisPemasukanResource\Pages;

class JenisPemasukanResource extends Resource
{
    protected static ?string $model = JenisPemasukan::class;

    protected static ?string $navigationLabel = 'Jenis Pemasukan';

    protected static ?string $label = 'Jenis Pemasukan';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Jenis Pemasukan')
                    ->schema([
                        Forms\Components\TextInput::make('kode')
                            ->label('Kode')
                            ->required(),
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama')
                            ->required(),
                        Forms\Components\Select::make('akun_id')
                            ->label('Referensi Akun')
                            ->relationship('akun', 'nama')
                            ->required(),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi'),
                    ])
                    ->columns([
                        'sm' => '100%',
                        'lg' => 2,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('akun.nama')
                    ->label('Referensi Akun'),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->wrap(),
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListJenisPemasukans::route('/'),
            'create' => Pages\CreateJenisPemasukan::route('/create'),
            'edit' => Pages\EditJenisPemasukan::route('/{record}/edit'),
        ];
    }
}
