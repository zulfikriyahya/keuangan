<?php

namespace App\Filament\Exports;

use App\Models\Pembayaran;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PembayaranExporter extends Exporter
{
    protected static ?string $model = Pembayaran::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('siswa.nama')
                ->label('Nama Siswa'),
            ExportColumn::make('jenisPembayaran.kode')
                ->label('Kode Jenis Pembayaran'),
            ExportColumn::make('jenisPembayaran.nama')
                ->label('Jenis Pembayaran'),
            ExportColumn::make('deskripsi')
                ->label('Catatan'),
            ExportColumn::make('tanggal')
                ->label('Tanggal Pembayaran'),
            ExportColumn::make('bulan.nama')
                ->label('Bulan'),
            ExportColumn::make('tahun.nama')
                ->label('Tahun'),
            ExportColumn::make('nominal')
                ->label('Nominal'),
            ExportColumn::make('kwitansi'),
            ExportColumn::make('status')
                ->label('Status Pembayaran'),
            // ExportColumn::make('created_at')
            //     ->label('Dibuat'),
            // ExportColumn::make('updated_at')
            //     ->label('Diperbarui'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pembayaran export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
