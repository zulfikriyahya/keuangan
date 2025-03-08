<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Siswa;
use App\Models\Pembayaran;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Blade;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists\Components\Section;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Exports\PembayaranExporter;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\PembayaranResource\Pages;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationLabel = 'Pembayaran';

    protected static ?string $label = 'Jurnal Pembayaran';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->sortable()
                    ->searchable(Siswa::count() > 10),
                Tables\Columns\TextColumn::make('siswa.kelas.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenisPembayaran.nama'),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->wrap()
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visible(fn(): string => Pembayaran::count() > 0),
                Tables\Columns\TextColumn::make('bulan.nama'),
                Tables\Columns\TextColumn::make('tahun.nama'),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->prefix('Rp. '),
                Tables\Columns\ImageColumn::make('kwitansi')
                    ->label('Kuitansi')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visible(fn(): string => Pembayaran::count() > 0),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => $state === 'Lunas' ? 'success' : 'gray')
                    ->icon(fn(string $state) => $state === 'Lunas' ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle'),
            ])
            ->filters([
                SelectFilter::make('Status')
                    ->label('Status')
                    ->options([
                        'Lunas' => 'Lunas',
                        'Terhutang' => 'Terhutang',
                    ])
                    ->visible(fn(): string => Pembayaran::count() > 5),
                SelectFilter::make('Tahun')
                    ->label('Tahun')
                    ->relationship('tahun', 'nama')
                    ->visible(fn(): string => Pembayaran::count() > 5),
                SelectFilter::make('Bulan')
                    ->label('Bulan')
                    ->relationship('bulan', 'nama')
                    ->visible(fn(): string => Pembayaran::count() > 5),
                SelectFilter::make('Jenis Pembayaran')
                    ->label('Jenis Pembayaran')
                    ->relationship('jenisPembayaran', 'nama')
                    ->visible(fn(): string => Pembayaran::count() > 5),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                ]),
                Tables\Actions\Action::make('Cetak')
                    ->color('success')
                    ->icon('heroicon-m-printer')
                    ->button()
                    ->hiddenLabel()
                    ->action(function (Pembayaran $record) {
                        return response()->streamDownload(function () use ($record) {
                            echo Pdf::loadHtml(Blade::render('pembayaran', ['record' => $record]))->stream();
                        }, $record->siswa->nama . ' - ' . $record->jenisPembayaran->nama . ' - ' . $record->bulan->nama . ' ' . $record->tahun->nama . '.pdf');
                    }),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportBulkAction::make()
                        ->exporter(PembayaranExporter::class),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ImageEntry::make('kwitansi')
                    ->label('Bukti Pembayaran')
                    ->maxWidth('100%'),
                Section::make('Detail Pembayaran')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('id')
                            ->label('ID Pembayaran')
                            ->badge()
                            ->color('gray'),
                        TextEntry::make('jenisPembayaran.akun.kode')
                            ->label('Akun Pembayaran')
                            ->badge()
                            ->color('gray'),
                        TextEntry::make('jenisPembayaran.kode')
                            ->label('Kode Jenis Pembayaran')
                            ->badge()
                            ->color('gray'),
                        TextEntry::make('jenisPembayaran.nama'),
                        TextEntry::make('siswa.nama')
                            ->label('Nama Siswa'),
                        TextEntry::make('tanggal')
                            ->label('Tanggal Pembayaran')
                            ->date('d F Y'),
                        TextEntry::make('deskripsi')
                            ->label('Catatan Pembayaran'),
                        TextEntry::make('bulan.nama'),
                        TextEntry::make('tahun.nama'),
                        TextEntry::make('nominal')
                            ->numeric()
                            ->prefix('Rp. '),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn(string $state) => $state === 'Lunas' ? 'success' : 'gray')
                            ->icon(fn(string $state) => $state === 'Lunas' ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle'),
                    ])
                    ->columnSpan(1)
                    ->columns(2),
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
            'index' => Pages\ListPembayarans::route('/'),
            // 'create' => Pages\CreatePembayaran::route('/create'),
            // 'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
