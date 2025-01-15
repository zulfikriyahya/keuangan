<?php

namespace App\Filament\Resources\PimpinanResource\Pages;

use Filament\Actions;
use App\Models\Pimpinan;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PimpinanResource;

class ListPimpinans extends ListRecords
{
    protected static string $resource = PimpinanResource::class;

    protected function getHeaderActions(): array
    {
        if (Pimpinan::count() > 0) {
            return [];
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
