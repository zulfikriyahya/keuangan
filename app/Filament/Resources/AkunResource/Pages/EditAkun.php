<?php

namespace App\Filament\Resources\AkunResource\Pages;

use Filament\Actions;
use App\Filament\Resources\AkunResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Redirect;

class EditAkun extends EditRecord
{
    protected static string $resource = AkunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
    protected function afterSave()
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
