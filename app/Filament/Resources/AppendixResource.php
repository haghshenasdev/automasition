<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppendixResource\Pages;
use App\Filament\Resources\AppendixResource\RelationManagers;
use App\Models\Appendix;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppendixResource extends Resource
{
    protected static ?string $model = Appendix::class;

    protected static ?string $navigationGroup = 'نامه';

    protected static ?int $navigationSort = 4;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = "ضمیمه";


    protected static ?string $pluralModelLabel = "ضمیمه ها";

    protected static ?string $pluralLabel = "ضمیمه";

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
                //
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
            'index' => Pages\ListAppendixes::route('/'),
            'create' => Pages\CreateAppendix::route('/create'),
            'edit' => Pages\EditAppendix::route('/{record}/edit'),
        ];
    }
}
