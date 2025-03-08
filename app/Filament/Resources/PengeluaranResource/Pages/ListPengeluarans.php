<?php

namespace App\Filament\Resources\PengeluaranResource\Pages;

use Filament\Actions;
use App\Models\JenisPengeluaran;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PengeluaranResource;

class ListPengeluarans extends ListRecords
{
    protected static string $resource = PengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        if (JenisPengeluaran::count() == 0) {
            return [];
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
