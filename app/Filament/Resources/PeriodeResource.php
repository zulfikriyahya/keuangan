<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Bulan;
use App\Models\Periode;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PeriodeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\PeriodeResource\RelationManagers;
use App\Filament\Resources\PeriodeResourcesResource\RelationManagers\PemasukansRelationManager;


class PeriodeResource extends Resource
{
    protected static ?string $model = Periode::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pengguna')
                    ->schema([
                        Forms\Components\Select::make('tahun_id')
                            ->relationship('tahun', 'nama')
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nama')
                                    ->label('Tahun')
                                    ->required()
                                    ->maxLength(4)
                                    ->minLength(4),
                            ]),
                        Forms\Components\Select::make('bulan_id')
                            ->relationship('bulan', 'nama')
                            ->required()
                            ->preload(3)
                            ->searchable(),
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
                    ->label('Tahun')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bulan.nama')
                    ->label('Bulan')
                    ->sortable()
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
                SelectFilter::make('Tahun')
                    ->relationship('tahun', 'nama'),
                SelectFilter::make('Bulan')
                    ->relationship('bulan', 'nama'),
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
            'index' => Pages\ListPeriodes::route('/'),
            'create' => Pages\CreatePeriode::route('/create'),
            'edit' => Pages\EditPeriode::route('/{record}/edit'),
        ];
    }
}
