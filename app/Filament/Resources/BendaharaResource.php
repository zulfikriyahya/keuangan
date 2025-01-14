<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Bendahara;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BendaharaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BendaharaResource\RelationManagers;

class BendaharaResource extends Resource
{
    protected static ?string $model = Bendahara::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Bendahara')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required(),
                        Forms\Components\TextInput::make('foto'),
                        Forms\Components\TextInput::make('nip'),
                        Forms\Components\DatePicker::make('periode_awal'),
                        Forms\Components\DatePicker::make('periode_akhir'),
                        Forms\Components\TextInput::make('status')
                            ->required(),
                        Forms\Components\TextInput::make('tte'),
                        Forms\Components\TextInput::make('telepon')
                            ->tel()
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
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nip')
                    ->searchable(),
                Tables\Columns\TextColumn::make('periode_awal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('periode_akhir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tte')
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
            'index' => Pages\ListBendaharas::route('/'),
            'create' => Pages\CreateBendahara::route('/create'),
            'edit' => Pages\EditBendahara::route('/{record}/edit'),
        ];
    }
}
