<?php

namespace App\Filament\Resources\LetterResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'replications';

    protected static ?string $label = 'رونوشت';

    protected static ?string $pluralLabel = 'رونوشت';

    protected static ?string $modelLabel = 'رونوشت';

    protected static ?string $title = 'رونوشت ها';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('titleholder_id')
                    ->label('گیرنده نامه')
                    ->relationship('titleholder', 'name')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titleholder.name')->label('گیرنده'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
