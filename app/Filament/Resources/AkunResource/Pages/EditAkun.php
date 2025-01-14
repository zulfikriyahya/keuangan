<?php

namespace App\Filament\Resources\AkunResource\Pages;

use Filament\Actions;
use App\Filament\Resources\AkunResource;
use Filament\Resources\Pages\EditRecord;

class EditAkun extends EditRecord
{
    protected static string $resource = AkunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
