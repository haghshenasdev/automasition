<?php

namespace App\Filament\Resources\LetterResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReferralsRelationManager extends RelationManager
{
    protected static string $relationship = 'referrals';

    protected static ?string $label = 'ارجاع';

    protected static ?string $pluralLabel = 'ارجاع';

    protected static ?string $modelLabel = 'ارجاع';

    protected static ?string $title = 'ارجاع ها';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('rule')
                    ->label('دستور')
                    ->maxLength(255),
                Forms\Components\Select::make('to_user_id')
                    ->label('به')
                    ->relationship('users', 'name')
                    ->searchable()
                    ->required()
                    ->preload(),
            ]);
    }



    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('rule')
            ->columns([
                Tables\Columns\TextColumn::make('rule')->label('دستور'),
                Tables\Columns\TextColumn::make('to_user_id.name')->label('به')
                    ->state(function (Model $record): string {
                        return $record->users()->first('name')->name; /// درست بودن رابطه چک شود
                    })
                ,
                Tables\Columns\TextColumn::make('created_at')->label(' تاریخ ایجاد'),
                Tables\Columns\TextColumn::make('updated_at')->label(' تاریخ آخرین ویرایش'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make('header')
                    ->mutateFormDataUsing(function (array $data): array {

                    $data['by_user_id'] = auth()->id();

                    return $data;
                }),
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
                Tables\Actions\CreateAction::make('empty')->mutateFormDataUsing(function (array $data): array {

                    $data['by_user_id'] = auth()->id();

                    return $data;
                }),
            ]);
    }
}
