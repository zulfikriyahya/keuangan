<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Instansi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InstansiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InstansiResource\RelationManagers;

class InstansiResource extends Resource
{
    protected static ?string $model = Instansi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Instansi')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required(),
                        Forms\Components\TextInput::make('npsn'),
                        Forms\Components\TextInput::make('nss'),
                        Forms\Components\TextInput::make('logo'),
                        Forms\Components\TextInput::make('alamat'),
                        Forms\Components\TextInput::make('kode_pos'),
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
                            ->email(),
                        Forms\Components\TextInput::make('telepon')
                            ->tel(),
                        Forms\Components\TextInput::make('website'),
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
                            ->relationship('pimpinan', 'nama')
                            ->required(),
                        Forms\Components\Select::make('bendahara_id')
                            ->relationship('bendahara', 'nama')
                            ->required(),
                    ])
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                        'xl' => 3,
                    ]),
                Section::make('Informasi Rekening')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('nama_bank'),
                        Forms\Components\TextInput::make('nama_rekening'),
                        Forms\Components\TextInput::make('nomor_rekening'),
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('npsn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nss')
                    ->searchable(),
                Tables\Columns\TextColumn::make('logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_pos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pimpinan.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bendahara.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_bank')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_rekening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_rekening')
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
            'index' => Pages\ListInstansis::route('/'),
            'create' => Pages\CreateInstansi::route('/create'),
            'edit' => Pages\EditInstansi::route('/{record}/edit'),
        ];
    }
}
