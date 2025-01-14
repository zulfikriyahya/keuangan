<?php

namespace App\Filament\Resources\PimpinanResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PimpinanResource;

class EditPimpinan extends EditRecord
{
    protected static string $resource = PimpinanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
