<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Akun;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AkunResource\Pages;
use App\Filament\Resources\AkunResource\Pages\CreateAkun;
use App\Filament\Resources\AkunResource\RelationManagers\JenisPemasukanRelationManager;
use App\Filament\Resources\AkunResource\RelationManagers\JenisPembayaranRelationManager;
use App\Filament\Resources\AkunResource\RelationManagers\JenisPengeluaranRelationManager;

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
                        Forms\Components\Radio::make('kategori')
                            ->label('Kategori :')
                            ->options([
                                'Pembayaran' => 'Pembayaran',
                                'Pemasukan' => 'Pemasukan',
                                'Pengeluaran' => 'Pengeluaran',
                            ])
                            ->inline()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->columnSpan([
                                'sm' => '100%',
                                'lg' => 3,
                            ]),
                    ])
                    ->disabledOn('edit')
                    ->columns([
                        'sm' => '100%',
                        'lg' => 3,
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
                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori'),
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


    // Hanya berlaku jika database telah dibuat
    public static function getRelations(): array
    {
        $recordId = request()->route('record');
        $record = Akun::find($recordId);
        if ($record) {
            return static::getRelationManagersForKategori($record->kategori);
        }
        return [];
    }

    protected static function getRelationManagersForKategori($kategori): array
    {
        switch ($kategori) {
            case 'Pembayaran':
                return [JenisPembayaranRelationManager::class];
            case 'Pemasukan':
                return [JenisPemasukanRelationManager::class];
            case 'Pengeluaran':
                return [JenisPengeluaranRelationManager::class];
            default:
                return [];
        }
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
