<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Siswa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SiswaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SiswaResource\RelationManagers;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required(),
                        Forms\Components\TextInput::make('foto'),
                        Forms\Components\DatePicker::make('diterima_tanggal')
                            ->required(),
                        Forms\Components\TextInput::make('diterima_dikelas')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('kelas_tahun_id')
                            ->relationship('kelasTahun', 'id')
                            ->required(),
                        Forms\Components\TextInput::make('status')
                            ->required(),
                        Forms\Components\TextInput::make('alamat'),
                        Forms\Components\TextInput::make('nama_ibu'),
                        Forms\Components\TextInput::make('nama_ayah'),
                        Forms\Components\TextInput::make('telepon')
                            ->tel(),
                    ])
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                        'xl' => 3,
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('diterima_tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('diterima_dikelas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelasTahun.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_ibu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_ayah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telepon')
                    ->searchable(),
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
                ])
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
