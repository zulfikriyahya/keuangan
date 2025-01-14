<?php

namespace App\Filament\Resources\PeriodeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PeriodeResource;

class EditPeriode extends EditRecord
{
    protected static string $resource = PeriodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
