<?php

namespace App\Filament\Resources\AkunResource\Pages;

use App\Filament\Resources\AkunResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAkun extends CreateRecord
{
    protected static string $resource = AkunResource::class;

    protected function afterSave()
    {
        parent::afterSave();
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
