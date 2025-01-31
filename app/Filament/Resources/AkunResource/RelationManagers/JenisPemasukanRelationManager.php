<?php

namespace App\Filament\Resources\AkunResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Resources\RelationManagers\RelationManager;

class JenisPemasukanRelationManager extends RelationManager
{
    protected static string $relationship = 'jenisPemasukan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Jenis Pemasukan')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama')
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->icon('heroicon-o-credit-card')
                    ->iconColor('success'),
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
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }
}
