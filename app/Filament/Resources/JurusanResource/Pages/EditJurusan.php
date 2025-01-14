<?php

namespace App\Filament\Resources\JurusanResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JurusanResource;

class EditJurusan extends EditRecord
{
    protected static string $resource = JurusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
