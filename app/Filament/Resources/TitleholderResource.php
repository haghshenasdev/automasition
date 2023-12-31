<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TitleholderResource\Pages;
use App\Filament\Resources\TitleholderResource\RelationManagers;
use App\Models\Titleholder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TitleholderResource extends Resource
{
    protected static ?string $model = Titleholder::class;

    protected static ?string $navigationGroup = 'مراجع دریافت نامه';

    protected static ?string $label = "صاحب منصب";


    protected static ?string $pluralModelLabel = "صاحب منصبان";

    protected static ?string $pluralLabel = "صاحب منصب";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('نام')
                    ->maxLength(255),
                Forms\Components\TextInput::make('official')
                    ->required()
                    ->label('سمت'),
                Forms\Components\TextInput::make('phone')
                    ->label('شماره تماس')
                    ->tel(),
                Forms\Components\Select::make('organ_id')
                    ->label('سازمان')
                    ->relationship('organ', 'name')
                    ->searchable()
                    ->required()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('نام')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->label('آدرس'),
                        Forms\Components\TextInput::make('phone')
                            ->label('شماره تماس')
                            ->tel(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('نام'),
                Tables\Columns\TextColumn::make('official')->label('سمت'),
                Tables\Columns\TextColumn::make('organ.name')->label('سازمان'),
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
            RelationManagers\LettersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTitleholders::route('/'),
            'create' => Pages\CreateTitleholder::route('/create'),
            'edit' => Pages\EditTitleholder::route('/{record}/edit'),
        ];
    }
}
