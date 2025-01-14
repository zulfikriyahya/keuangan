<?php

namespace App\Filament\Resources\BendaharaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BendaharaResource;

class EditBendahara extends EditRecord
{
    protected static string $resource = BendaharaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
