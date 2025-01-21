<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use App\Filament\Exports\SiswaExporter;
use App\Filament\Imports\SiswaImporter;
use App\Filament\Resources\SiswaResource;
use Filament\Resources\Pages\ListRecords;

class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->label('Impor')
                ->icon('heroicon-m-cloud-arrow-up')
                ->color('info')
                ->importer(SiswaImporter::class),
            ExportAction::make()
                ->label('Ekspor')
                ->icon('heroicon-m-cloud-arrow-down')
                ->color('success')
                ->exporter(SiswaExporter::class)
                ->chunkSize(250),
        ];
    }
}
