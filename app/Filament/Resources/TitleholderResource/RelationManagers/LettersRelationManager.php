<?php

namespace App\Filament\Resources\TitleholderResource\RelationManagers;

use App\Filament\Resources\LetterResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LettersRelationManager extends RelationManager
{
    protected static string $relationship = 'letters';

    public function form(Form $form): Form
    {
        return LetterResource::form($form);
    }

    public function table(Table $table): Table
    {
        return LetterResource::table($table);
    }
}
