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
                            ->label('Tanggal Pembayaran')
                            ->required()
                            ->default(now()),
                        Forms\Components\Select::make('jenis_pembayaran_id')
                            ->label('Jenis Pembayaran')
                            ->relationship('jenisPembayaran', 'kode')
                            ->required()
                            ->disabledOn('edit'),
                        Forms\Components\TextInput::make('deskripsi')
                            ->label('Catatan'),

                        Forms\Components\Select::make('bulan_id')
                            ->label('Bulan')
                            ->relationship('bulan', 'nama')
                            // ->options([
                            //     'Januari' => 'Januari',
                            //     'Februari' => 'Februari',
                            //     'Maret' => 'Maret',
                            //     'April' => 'April',
                            //     'Mei' => 'Mei',
                            //     'Juni' => 'Juni',
                            //     'Juli' => 'Juli',
                            //     'Agustus' => 'Agustus',
                            //     'September' => 'September',
                            //     'Oktober' => 'Oktober',
                            //     'November' => 'November',
                            //     'Desember' => 'Desember',
                            // ])
                            ->required(),

                        Forms\Components\Select::make('tahun_id')
                            ->label('Tahun')
                            ->relationship('tahun', 'nama')
                            ->required(),

                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal')
                            ->required()
                            ->prefix('Rp. ')
                            ->numeric()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                if ($state == $get('jenisPembayaran.nominal')) {
                                    $set('status', 'Lunas');
                                } else if ($state > $get('jenisPembayaran.nominal')) {
                                    $set('status', null);
                                } else if ($state < $get('jenisPembayaran.nominal')) {
                                    $set('status', 'Terhutang');
                                }
                            })
                            ->reactive(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'Lunas' => 'Lunas',
                                'Terhutang' => 'Terhutang',
                            ])
                            ->afterStateHydrated(
                                function (?Pembayaran $record, callable $get, callable $set) {
                                    if ($record === null) {
                                        return $set('status', null);
                                    }
                                    $nominal = $get('nominal');
                                    if ($nominal != $record->jenisPembayaran->nominal) {
                                        return $set('status', 'Terhutang');
                                    } else {
                                        return $set('status', 'Lunas');
                                    }
                                }
                            )
                            ->live()
                            ->visible(fn($get) => $get('nominal') != null),

                        Forms\Components\FileUpload::make('kwitansi')
                            ->label('Kuitansi')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1' => '1:1',
                                '4:3' => '4:3',
                                '3:4' => '3:4',
                                '9:16' => '9:16',
                                '16:9' => '16:9',
                            ])
                            ->directory('img/kwitansi/pembayaran')
                            ->fetchFileInformation(false)
                            ->columnSpan([
                                'sm' => '100%',
                                'xl' => 2,
                            ])
                            ->visible(fn($get) => $get('status') != null),
                    ])
                    ->columns([
                        'sm' => '100%',
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
                    ->label('Tanggal')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenisPembayaran.nama')
                    ->label('Jenis Pembayaran')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Catatan')
                    ->wrap()
                    ->limit(50),
                Tables\Columns\TextColumn::make('bulan.nama')
                    ->label('Bulan'),
                Tables\Columns\TextColumn::make('tahun.nama')
                    ->label('Tahun'),
                Tables\Columns\TextColumn::make('nominal')
                    ->label('Nominal')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('kwitansi')
                    ->label('Kuitansi'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state) => $state === 'Lunas' ? 'success' : 'gray')
                    ->icon(fn(string $state) => $state === 'Lunas' ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->visible(fn(): string => Pembayaran::count() > 0)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->visible(fn(): string => Pembayaran::count() > 0)
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
