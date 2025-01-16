<?php

namespace App\Filament\Resources\JenisPembayaranResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JenisPembayaranResource;

class EditJenisPembayaran extends EditRecord
{
    protected static string $resource = JenisPembayaranResource::class;

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
