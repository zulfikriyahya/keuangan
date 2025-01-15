<?php

namespace App\Filament\Resources\InstansiResource\Pages;

use App\Filament\Resources\InstansiResource;
use App\Models\Instansi;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstansis extends ListRecords
{
    protected static string $resource = InstansiResource::class;

    protected function getHeaderActions(): array
    {
        if (Instansi::count() > 0) {
            return [];
        }

        return [
            Actions\CreateAction::make(),
        ];
    }
}
