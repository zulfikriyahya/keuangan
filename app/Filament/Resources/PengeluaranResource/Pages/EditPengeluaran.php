<?php

namespace App\Filament\Resources\PengeluaranResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PengeluaranResource;

class EditPengeluaran extends EditRecord
{
    protected static string $resource = PengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
