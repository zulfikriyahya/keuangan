<?php

namespace App\Filament\Resources\BendaharaResource\Pages;

use Filament\Actions;
use App\Models\Bendahara;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BendaharaResource;

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
