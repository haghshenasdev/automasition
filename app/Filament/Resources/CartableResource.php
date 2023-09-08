<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartableResource\Pages;
use App\Filament\Resources\CartableResource\RelationManagers;
use App\Models\Cartable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CartableResource extends Resource
{
    protected static ?string $model = Cartable::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'دستور';


    protected static ?string $label = "کارپوشه";


    protected static ?string $pluralModelLabel = "کارپوشه";

    protected static ?string $pluralLabel = "کارپوشه";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('user.name')->label('کارتابل کابر'),
                TextColumn::make('letter_id')->label('نامه'),
                Tables\Columns\CheckboxColumn::make('checked')->label('بررسی شده'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCartables::route('/'),
            'create' => Pages\CreateCartable::route('/create'),
            'edit' => Pages\EditCartable::route('/{record}/edit'),
        ];
    }
}
