<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Bulan;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
// use Filament\Forms\Components\Section;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Blade;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationLabel = 'Pembayaran';

    protected static ?string $label = 'Jurnal Pembayaran';

    protected static ?string $navigationGroup = 'Jurnal Keuangan';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';
    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Section::make('Informasi Pembayaran')
    //                 ->schema([
    //                     Forms\Components\DatePicker::make('tanggal')
    //                         ->required()
    //                         ->date('d F Y'),
    //                     Forms\Components\Select::make('jenis_pembayaran_id')
    //                         ->relationship('jenisPembayaran', 'nama')
    //                         ->required(),
    //                     Forms\Components\TextInput::make('deskripsi'),

    //                     Forms\Components\Select::make('bulan_id')
    //                         ->relationship('bulan', 'nama')
    //                         ->required(),

    //                     Forms\Components\Select::make('tahun_id')
    //                         ->relationship('tahun', 'nama')
    //                         ->required(),

    //                     Forms\Components\TextInput::make('nominal')
    //                         ->required()
    //                         ->prefix('Rp. ')
    //                         ->numeric(),

    //                     Forms\Components\FileUpload::make('kwitansi')
    //                         ->image()
    //                         ->imageEditor()
    //                         ->imageEditorAspectRatios([
    //                             null,
    //                             '1:1' => '1:1',
    //                             '4:3' => '4:3',
    //                             '3:4' => '3:4',
    //                             '9:16' => '9:16',
    //                             '16:9' => '16:9',
    //                         ]),

    //                     Forms\Components\TextInput::make('status')
    //                         ->required(),

    //                     Forms\Components\Select::make('siswa_id')
    //                         ->relationship('siswa', 'nama')
    //                         ->required(),
    //                 ])
    //                 ->columns([
    //                     'sm' => 1,
    //                     'lg' => 2,
    //                     'xl' => 3,
    //                 ]),
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('siswa.kelas.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenisPembayaran.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->wrap()
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('bulan.nama'),
                Tables\Columns\TextColumn::make('tahun.nama'),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->prefix('Rp. '),
                Tables\Columns\ImageColumn::make('kwitansi')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => $state === 'Lunas' ? 'success' : 'gray')
                    ->icon(fn (string $state) => $state === 'Lunas' ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle'),
            ])
            ->filters([
                SelectFilter::make('Status')
                    ->label('Status')
                    ->options([
                        'Lunas' => 'Lunas',
                        'Terhutang' => 'Terhutang',
                    ]),
                SelectFilter::make('Tahun')
                    ->label('Tahun')
                    ->relationship('tahun', 'nama'),
                SelectFilter::make('Bulan')
                    ->label('Bulan')
                    ->relationship('bulan', 'nama'),
                SelectFilter::make('Jenis Pembayaran')
                    ->label('Jenis Pembayaran')
                    ->relationship('jenisPembayaran', 'nama'),
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
                        }, $record->siswa->nama.' - '.$record->jenisPembayaran->nama.' - '.$record->bulan->nama.' '.$record->tahun->nama.'.pdf');
                    }),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
        // ->headerActions([

        // ])
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
                        TextEntry::make('jenisPembayaran.kode')
                            ->label('Kode Jenis Pembayaran')
                            ->badge()
                            ->color('gray'),
                        TextEntry::make('siswa.nama')
                            ->label('Nama Siswa'),
                        TextEntry::make('tanggal')
                            ->label('Tanggal Pembayaran')
                            ->date('d F Y'),
                        TextEntry::make('jenisPembayaran.nama'),
                        TextEntry::make('deskripsi')
                            ->label('Catatan Pembayaran'),
                        TextEntry::make('bulan.nama'),
                        TextEntry::make('tahun.nama'),
                        TextEntry::make('nominal')
                            ->numeric()
                            ->prefix('Rp. '),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state) => $state === 'Lunas' ? 'success' : 'gray')
                            ->icon(fn (string $state) => $state === 'Lunas' ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle'),
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
