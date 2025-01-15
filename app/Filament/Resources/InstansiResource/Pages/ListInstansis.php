<?php

namespace App\Filament\Resources\InstansiResource\Pages;

use Filament\Actions;
use App\Models\Instansi;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\InstansiResource;

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
