<?php

namespace App\Filament\Resources\KelasResource\Pages;

use App\Models\Kelas;
use Filament\Actions;
use App\Models\Jurusan;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use App\Filament\Exports\KelasExporter;
use App\Filament\Imports\KelasImporter;
use App\Filament\Resources\KelasResource;
use Filament\Resources\Pages\ListRecords;

class ListKelas extends ListRecords
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        if (Jurusan::count() == 0) {
            return [];
        }
        return [
            Actions\CreateAction::make(),
            // ImportAction::make()
            //     ->label('Impor')
            //     ->icon('heroicon-m-cloud-arrow-down')
            //     ->color('info')
            //     ->importer(KelasImporter::class)
            //     ->visible(fn(): string => Jurusan::count() > 0),
            // ExportAction::make()
            //     ->label('Ekspor')
            //     ->icon('heroicon-m-cloud-arrow-up')
            //     ->color('success')
            //     ->exporter(KelasExporter::class)
            //     ->visible(fn(): string => Kelas::count() > 0),
        ];
    }
}
