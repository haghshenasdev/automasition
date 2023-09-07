<?php

namespace App\Filament\Resources\ReplicationResource\Pages;

use App\Filament\Resources\ReplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReplications extends ListRecords
{
    protected static string $resource = ReplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
