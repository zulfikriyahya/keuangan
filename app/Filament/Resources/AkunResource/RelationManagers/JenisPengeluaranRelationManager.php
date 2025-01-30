<?php

namespace App\Filament\Resources\AkunResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class JenisPengeluaranRelationManager extends RelationManager
{
    protected static string $relationship = 'jenisPengeluaran';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Jenis Pengeluaran')
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
                            ->required()
                            ->createOptionForm([
                                Forms\Components\Section::make('Akun')
                                    ->label('Akun')
                                    ->description('Informasi Akun Keuangan')
                                    ->schema([
                                        Forms\Components\TextInput::make('kode')
                                            ->label('Kode')
                                            ->required(),
                                        Forms\Components\TextInput::make('nama')
                                            ->label('Nama Akun')
                                            ->required(),
                                        Forms\Components\Textarea::make('deskripsi')
                                            ->label('Deskripsi')
                                            ->columnSpan([
                                                'sm' => '100%',
                                                'lg' => 2,
                                            ]),
                                    ])
                                    ->columns([
                                        'sm' => '100%',
                                        'lg' => 2,
                                    ])
                                    ->disabledOn('edit'),
                            ]),
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
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }
}
