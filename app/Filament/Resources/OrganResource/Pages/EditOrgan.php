<?php

namespace App\Filament\Resources\OrganResource\Pages;

use App\Filament\Resources\OrganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrgan extends EditRecord
{
    protected static string $resource = OrganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
