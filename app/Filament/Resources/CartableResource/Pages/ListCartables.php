<?php

namespace App\Filament\Resources\CartableResource\Pages;

use App\Filament\Resources\CartableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCartables extends ListRecords
{
    protected static string $resource = CartableResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
