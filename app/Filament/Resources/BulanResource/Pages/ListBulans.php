<?php

namespace App\Filament\Resources\BulanResource\Pages;

use App\Filament\Resources\BulanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBulans extends ListRecords
{
    protected static string $resource = BulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
