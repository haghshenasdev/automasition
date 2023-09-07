<?php

namespace App\Filament\Resources\OrganResource\Pages;

use App\Filament\Resources\OrganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrgans extends ListRecords
{
    protected static string $resource = OrganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
