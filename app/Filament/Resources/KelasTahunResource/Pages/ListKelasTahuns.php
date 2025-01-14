<?php

namespace App\Filament\Resources\KelasTahunResource\Pages;

use App\Filament\Resources\KelasTahunResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKelasTahuns extends ListRecords
{
    protected static string $resource = KelasTahunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
