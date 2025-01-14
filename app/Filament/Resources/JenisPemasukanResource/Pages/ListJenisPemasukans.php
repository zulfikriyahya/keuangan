<?php

namespace App\Filament\Resources\JenisPemasukanResource\Pages;

use App\Filament\Resources\JenisPemasukanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisPemasukans extends ListRecords
{
    protected static string $resource = JenisPemasukanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
