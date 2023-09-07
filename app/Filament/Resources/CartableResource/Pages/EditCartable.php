<?php

namespace App\Filament\Resources\CartableResource\Pages;

use App\Filament\Resources\CartableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCartable extends EditRecord
{
    protected static string $resource = CartableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
