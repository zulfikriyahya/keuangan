<?php

namespace App\Filament\Resources\JenisPemasukanResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JenisPemasukanResource;

class EditJenisPemasukan extends EditRecord
{
    protected static string $resource = JenisPemasukanResource::class;

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
