<?php

namespace App\Filament\Resources\KelasResource\Pages;

use Filament\Actions;
use App\Models\Jurusan;
use App\Filament\Resources\KelasResource;
use Filament\Resources\Pages\ListRecords;

class ListKelas extends ListRecords
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        if (Jurusan::count() == 0) {
            return [];
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
