<?php

namespace App\Filament\Resources\AkunResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;

class JenisPembayaranRelationManager extends RelationManager
{
    protected static string $relationship = 'jenisPembayaran';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Jenis Pembayaran')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama')
                            ->required(),
                        Forms\Components\Select::make('tahun_id')
                            ->label('Tahun')
                            ->relationship('tahun', 'nama')
                            ->required()
                            ->createOptionForm([
                                Forms\Components\Section::make('tahun')
                                    ->heading('Tahun')
                                    ->description('Tambahkan Informasi Tahun')
                                    ->schema([
                                        Forms\Components\TextInput::make('nama')
                                            ->label('Tahun')
                                            ->required()
                                            ->placeholder('Contoh: 2025')
                                            ->minLength(4)
                                            ->maxLength(4)
                                            ->helperText(new HtmlString('<p style="color:red">Tambahkan tahun hanya ketika dibutuhkan!</p>'))
                                            ->unique(),
                                    ]),
                            ])
                            ->disabledOn('edit'),
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
                            ]),
                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal')
                            ->numeric()
                            ->prefix('Rp. ')
                            ->required(),
                        // Forms\Components\Select::make('akun_id')
                        //     ->label('Referensi Akun')
                        //     ->relationship('akun', 'nama')
                        //     ->required()
                        //     ->createOptionForm([
                        //         Forms\Components\Section::make('Akun')
                        //             ->label('Akun')
                        //             ->description('Informasi Akun Keuangan')
                        //             ->schema([
                        //                 Forms\Components\TextInput::make('kode')
                        //                     ->label('Kode')
                        //                     ->required(),
                        //                 Forms\Components\TextInput::make('nama')
                        //                     ->label('Nama Akun')
                        //                     ->required(),
                        //                 Forms\Components\Textarea::make('deskripsi')
                        //                     ->label('Deskripsi')
                        //                     ->columnSpan([
                        //                         'sm' => '100%',
                        //                         'lg' => 2,
                        //                     ]),
                        //             ])
                        //             ->columns([
                        //                 'sm' => '100%',
                        //                 'lg' => 2,
                        //             ]),
                        //     ])
                        //     ->disabledOn('edit'),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi'),
                    ])
                    ->columns([
                        'sm' => '100%',
                        'lg' => 2,
                        'xl' => 3,
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
                    ->label('Kode')
                    ->badge()
                    ->icon('heroicon-o-banknotes')
                    ->color('success'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('tahun.nama')
                    ->label('Tahun'),
                Tables\Columns\TextColumn::make('nominal')
                    ->label('Nominal')
                    ->numeric()
                    ->prefix('Rp. '),
                Tables\Columns\TextColumn::make('jurusan.nama')
                    ->label('Jurusan'),
                Tables\Columns\TextColumn::make('akun.nama')
                    ->label('Referensi Akun')
                    ->badge(),
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
                            if ($record->pembayaran()->count() > 0) {
                                Notification::make()
                                    ->title('Gagal Menghapus')
                                    ->body('Tidak dapat menghapus jenis pembayaran yang memiliki pembayaran terkait.')
                                    ->danger()
                                    ->send();
                                $action->cancel();

                                return;
                            }
                        })
                        // Cara Kedua (Lebih aku sukai.)
                        ->hidden(function ($record) {
                            if ($record->pembayaran()->count() > 0) {
                                return $record;
                            }
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }
}
