<?php

namespace App\Filament\Resources\SiswaResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pembayaran;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Section;
use App\Filament\Exports\PembayaranExporter;
use Filament\Resources\RelationManagers\RelationManager;

class PembayaransRelationManager extends RelationManager
{
    protected static string $relationship = 'pembayaran';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pembayaran')
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal')
                            ->required()
                            ->default(now()),
                        Forms\Components\Select::make('jenis_pembayaran_id')
                            ->relationship('jenisPembayaran', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('deskripsi'),

                        Forms\Components\Select::make('bulan_id')
                            ->relationship('bulan', 'nama')
                            ->required(),

                        Forms\Components\Select::make('tahun_id')
                            ->relationship('tahun', 'nama')
                            ->required(),

                        Forms\Components\TextInput::make('nominal')
                            ->required()
                            ->prefix('Rp. ')
                            ->numeric(),

                        Forms\Components\FileUpload::make('kwitansi')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1' => '1:1',
                                '4:3' => '4:3',
                                '3:4' => '3:4',
                                '9:16' => '9:16',
                                '16:9' => '16:9',
                            ]),

                        Forms\Components\Select::make('status')
                            ->required()
                            ->options([
                                'Lunas' => 'Lunas',
                                'Terhutang' => 'Terhutang',
                            ]),
                    ])
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                        'xl' => 3,
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenisPembayaran.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->wrap()
                    ->limit(50),
                Tables\Columns\TextColumn::make('bulan.nama'),
                Tables\Columns\TextColumn::make('tahun.nama'),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('kwitansi'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state) => $state === 'Lunas' ? 'success' : 'gray')
                    ->icon(fn(string $state) => $state === 'Lunas' ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle'),
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\ExportAction::make('Ekspor')
                    ->label('Ekspor')
                    ->icon('heroicon-m-cloud-arrow-down')
                    ->color('success')
                    ->exporter(PembayaranExporter::class)
                    ->visible(function () {
                        if (Pembayaran::count() > 0);
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('Cetak')
                        ->color('success')
                        ->icon('heroicon-m-printer')
                        // ->button()
                        // ->hiddenLabel()
                        ->action(function (Pembayaran $record) {
                            return response()->streamDownload(function () use ($record) {
                                echo Pdf::loadHtml(Blade::render('pembayaran', ['record' => $record]))->stream();
                            }, $record->siswa->nama . ' - ' . $record->jenisPembayaran->nama . ' - ' . $record->bulan->nama . ' ' . $record->tahun->nama . '.pdf');
                        }),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
