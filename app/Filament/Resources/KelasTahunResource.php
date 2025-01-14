<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\KelasTahun;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KelasTahunResource\Pages;
use App\Filament\Resources\KelasTahunResource\RelationManagers;

class KelasTahunResource extends Resource
{
    protected static ?string $model = KelasTahun::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pengguna')
                    ->schema([
                        Forms\Components\Select::make('tahun_id')
                            ->relationship('tahun', 'id')
                            ->required(),
                        Forms\Components\Select::make('kelas_id')
                            ->relationship('kelas', 'id')
                            ->required(),
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
                Tables\Columns\TextColumn::make('tahun.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelas.nama')
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
            'index' => Pages\ListKelasTahuns::route('/'),
            'create' => Pages\CreateKelasTahun::route('/create'),
            'edit' => Pages\EditKelasTahun::route('/{record}/edit'),
        ];
    }
}
