<?php

namespace App\Filament\Resources\JenisPengeluaranResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JenisPengeluaranResource;

class EditJenisPengeluaran extends EditRecord
{
    protected static string $resource = JenisPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
