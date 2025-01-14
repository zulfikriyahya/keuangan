<?php

namespace App\Filament\Resources\InstansiResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\InstansiResource;

class EditInstansi extends EditRecord
{
    protected static string $resource = InstansiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
