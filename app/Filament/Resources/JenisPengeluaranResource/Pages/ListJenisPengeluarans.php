<?php

namespace App\Filament\Resources\JenisPengeluaranResource\Pages;

use App\Filament\Resources\JenisPengeluaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisPengeluarans extends ListRecords
{
    protected static string $resource = JenisPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
