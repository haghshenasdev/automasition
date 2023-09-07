<?php

namespace App\Filament\Resources\CartableResource\Pages;

use App\Filament\Resources\CartableResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCartable extends CreateRecord
{
    protected static string $resource = CartableResource::class;
}
