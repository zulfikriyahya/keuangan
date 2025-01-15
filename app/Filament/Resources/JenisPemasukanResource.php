<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisPemasukanResource\Pages;
use App\Models\JenisPemasukan;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JenisPemasukanResource extends Resource
{
    protected static ?string $model = JenisPemasukan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Jenis Pemasukan')
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
            'index' => Pages\ListJenisPemasukans::route('/'),
            'create' => Pages\CreateJenisPemasukan::route('/create'),
            'edit' => Pages\EditJenisPemasukan::route('/{record}/edit'),
        ];
    }
}
