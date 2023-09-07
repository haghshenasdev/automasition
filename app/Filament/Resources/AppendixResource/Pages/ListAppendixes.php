<?php

namespace App\Filament\Resources\AppendixResource\Pages;

use App\Filament\Resources\AppendixResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppendixes extends ListRecords
{
    protected static string $resource = AppendixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
