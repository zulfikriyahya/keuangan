<?php

namespace App\Filament\Resources\PimpinanResource\Pages;

use App\Filament\Resources\PimpinanResource;
use App\Models\Pimpinan;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

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
