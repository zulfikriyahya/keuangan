<?php

namespace App\Filament\Resources\JenisPengeluaranResource\Pages;

use App\Filament\Resources\JenisPengeluaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisPengeluaran extends EditRecord
{
    protected static string $resource = JenisPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
