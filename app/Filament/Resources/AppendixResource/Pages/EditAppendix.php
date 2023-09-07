<?php

namespace App\Filament\Resources\AppendixResource\Pages;

use App\Filament\Resources\AppendixResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppendix extends EditRecord
{
    protected static string $resource = AppendixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
