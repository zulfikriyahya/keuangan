<?php

namespace App\Filament\Resources\BendaharaResource\Pages;

use App\Filament\Resources\BendaharaResource;
use App\Models\Bendahara;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBendaharas extends ListRecords
{
    protected static string $resource = BendaharaResource::class;

    protected function getHeaderActions(): array
    {
        if (Bendahara::count() > 0) {
            return [];
        }

        return [
            Actions\CreateAction::make(),
        ];
    }
}
