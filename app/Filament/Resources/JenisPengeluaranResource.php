<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\JenisPengeluaran;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\JenisPengeluaranResource\Pages;

class JenisPengeluaranResource extends Resource
{
    protected static ?string $model = JenisPengeluaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Jenis Pengeluaran')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required(),
                        Forms\Components\Select::make('akun_id')
                            ->relationship('akun', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('kode')
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
                Tables\Columns\TextColumn::make('akun.nama'),
                Tables\Columns\TextColumn::make('kode'),
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
            'index' => Pages\ListJenisPengeluarans::route('/'),
            'create' => Pages\CreateJenisPengeluaran::route('/create'),
            'edit' => Pages\EditJenisPengeluaran::route('/{record}/edit'),
        ];
    }
}
