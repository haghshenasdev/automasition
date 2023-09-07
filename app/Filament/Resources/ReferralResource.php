<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReferralResource\Pages;
use App\Filament\Resources\ReferralResource\RelationManagers;
use App\Models\Referral;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReferralResource extends Resource
{
    protected static ?string $model = Referral::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = "ارجاع";


    protected static ?string $pluralModelLabel = "ارجاع ها";

    protected static ?string $pluralLabel = "ارجاع";

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
                Tables\Columns\TextColumn::make('rule')->label('دستور'),
                Tables\Columns\TextColumn::make('letter.subject')->label('نامه'),
                TextColumn::make('by_user_id')->label('توسط')
                    ->state(function (Model $record): string {
                        return $record->users()->first('name')->name; /// درست بودن رابطه چک شود
                    }),
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
            'index' => Pages\ListReferrals::route('/'),
            'create' => Pages\CreateReferral::route('/create'),
            'edit' => Pages\EditReferral::route('/{record}/edit'),
        ];
    }
}
