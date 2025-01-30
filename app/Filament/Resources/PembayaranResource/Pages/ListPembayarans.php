<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Exports\PembayaranExporter;
use App\Filament\Resources\PembayaranResource;
use App\Models\Pembayaran;
use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPembayarans extends ListRecords
{
    protected static string $resource = PembayaranResource::class;

    protected function getHeaderActions(): array
    {
        if (Pembayaran::count() == 0) {
            return [];
        }

        return [
            // Actions\CreateAction::make(),
            ExportAction::make('Ekspor')
                ->label('Ekspor')
                ->icon('heroicon-m-cloud-arrow-down')
                ->color('success')
                ->exporter(PembayaranExporter::class)
                ->chunkSize(250),
        ];
    }
}
