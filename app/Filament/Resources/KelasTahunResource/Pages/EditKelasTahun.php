<?php

namespace App\Filament\Resources\KelasTahunResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\KelasTahunResource;

class EditKelasTahun extends EditRecord
{
    protected static string $resource = KelasTahunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
