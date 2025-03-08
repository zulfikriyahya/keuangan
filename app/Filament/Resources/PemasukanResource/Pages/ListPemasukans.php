<?php

namespace App\Filament\Resources\PemasukanResource\Pages;

use Filament\Actions;
use App\Models\JenisPemasukan;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PemasukanResource;

class ListPemasukans extends ListRecords
{
    protected static string $resource = PemasukanResource::class;

    protected function getHeaderActions(): array
    {
        if (JenisPemasukan::count() == 0) {
            return [];
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
