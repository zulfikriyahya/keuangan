<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Pengeluaran;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PengeluaranResource\Pages;
use App\Filament\Resources\PengeluaranResource\RelationManagers;

class PengeluaranResource extends Resource
{
    protected static ?string $model = Pengeluaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pengguna')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required(),
                        Forms\Components\TextInput::make('kode')
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->required(),
                        Forms\Components\Select::make('periode_id')
                            ->relationship('periode', 'id')
                            ->required(),
                        Forms\Components\TextInput::make('nominal')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('kwitansi'),
                        Forms\Components\Select::make('jenis_pengeluaran_id')
                            ->relationship('jenisPengeluaran', 'id')
                            ->required(),
                        Forms\Components\TextInput::make('deskripsi'),
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
                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('periode.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kwitansi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenisPengeluaran.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')
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
            'index' => Pages\ListPengeluarans::route('/'),
            'create' => Pages\CreatePengeluaran::route('/create'),
            'edit' => Pages\EditPengeluaran::route('/{record}/edit'),
        ];
    }
}
