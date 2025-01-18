<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\JenisPembayaran;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;
use App\Filament\Resources\JenisPembayaranResource\Pages;

class JenisPembayaranResource extends Resource
{
    protected static ?string $model = JenisPembayaran::class;

    protected static ?string $navigationLabel = 'Jenis Pembayaran';

    protected static ?string $label = 'Jenis Pembayaran';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Jenis Pembayaran')
                    ->schema([
                        Forms\Components\TextInput::make('kode')
                            ->label('Kode')
                            ->required(),
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama')
                            ->required(),
                        Forms\Components\Select::make('jurusan_id')
                            ->label('Jurusan')
                            ->relationship('jurusan', 'nama')
                            ->required()
                            ->createOptionForm([
                                Section::make('Informasi Jurusan')
                                    ->schema([
                                        Forms\Components\TextInput::make('nama')
                                            ->required(),
                                        Forms\Components\TextInput::make('kode')
                                            ->required(),
                                    ])
                                    ->columns([
                                        'sm' => 1,
                                        'lg' => 2,
                                        'xl' => 3,
                                    ]),
                            ])
                            ->disabledOn('edit'),
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
                                    ]),
                            ])
                            ->disabledOn('edit'),
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
                        'xl' => 3,
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
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('jurusan.nama')
                    ->label('Jurusan'),
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
                    Tables\Actions\DeleteAction::make()
                        // Cara Pertama
                        ->before(function ($record, $action) {
                            if ($record->pembayarans()->count() > 0) {
                                Notification::make()
                                    ->title('Gagal Menghapus')
                                    ->body('Tidak dapat menghapus jenis pembayaran yang memiliki pembayaran terkait.')
                                    ->danger()
                                    ->send();
                                $action->cancel();
                                return;
                            };
                        })
                        // Cara Kedua (Lebih aku sukai.)
                        ->hidden(function ($record) {
                            if ($record->pembayarans()->count() > 0) {
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJenisPembayarans::route('/'),
            'create' => Pages\CreateJenisPembayaran::route('/create'),
            'edit' => Pages\EditJenisPembayaran::route('/{record}/edit'),
        ];
    }
}
