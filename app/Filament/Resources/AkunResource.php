<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AkunResource\Pages;
use App\Filament\Resources\AkunResource\RelationManagers\JenisPemasukanRelationManager;
use App\Filament\Resources\AkunResource\RelationManagers\JenisPembayaranRelationManager;
use App\Filament\Resources\AkunResource\RelationManagers\JenisPengeluaranRelationManager;
use App\Models\Akun;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AkunResource extends Resource
{
    protected static ?string $model = Akun::class;

    protected static ?string $navigationLabel = 'Akun';

    protected static ?string $label = 'Akun Keuangan';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Akun'),
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
                    Tables\Actions\DeleteAction::make()
                        ->hidden(function ($record) {
                            if ($record->jenisPembayaran()->count() > 0 || $record->jenisPemasukan()->count() > 0 || $record->jenisPengeluaran()->count() > 0) {
                                return $record;
                            }
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            JenisPembayaranRelationManager::class,
            JenisPemasukanRelationManager::class,
            JenisPengeluaranRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAkuns::route('/'),
            'create' => Pages\CreateAkun::route('/create'),
            'edit' => Pages\EditAkun::route('/{record}/edit'),
        ];
    }
}
