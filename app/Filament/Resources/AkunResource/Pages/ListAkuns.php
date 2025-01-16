<?php

namespace App\Filament\Resources\AkunResource\Pages;

use Filament\Actions;
use App\Filament\Resources\AkunResource;
use Illuminate\Support\Facades\Redirect;
use Filament\Resources\Pages\ListRecords;


class ListAkuns extends ListRecords
{
    protected static string $resource = AkunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function afterCreate()
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
