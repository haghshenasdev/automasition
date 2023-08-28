<?php

namespace App\Filament\Resources\TitleholderResource\Pages;

use App\Filament\Resources\TitleholderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTitleholder extends EditRecord
{
    protected static string $resource = TitleholderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
