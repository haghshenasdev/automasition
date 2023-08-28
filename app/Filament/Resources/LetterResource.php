<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerLetterResource\RelationManagers\CustomersRelationManager;
use App\Filament\Resources\CustomerResource\RelationManagers\LettersRelationManager;
use App\Filament\Resources\LetterResource\Pages;
use App\Filament\Resources\LetterResource\RelationManagers;
use App\Models\Letter;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LetterResource extends Resource
{
    protected static ?string $model = Letter::class;

    protected static ?string $label = "نامه";


    protected static ?string $pluralModelLabel = "نامه ها";

    protected static ?string $pluralLabel = "نامه";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject')
                    ->label('موضوع')
                    ->required(),
                Forms\Components\Select::make('titleholder_id')
                    ->label('به')
                    ->relationship('titleholder', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
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
                            ->label('اداره')
                            ->relationship('organ', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('نام')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('address')
                                    ->required()
                                    ->label('آدرس'),
                                Forms\Components\TextInput::make('phone')
                                    ->label('شماره تماس')
                                    ->tel(),
                            ]),
                    ]),

                Select::make('customers')
                    ->multiple()
                    ->relationship(null,'name')
                    ->searchable()
                ,
                Forms\Components\Select::make('type')
                    ->options([
                        null => 'شخصی',
                         0 => 'عمومی',
                         1 => 'شرکت یا کارگاه',
                    ])->label('نوع'),
                FileUpload::make('file')
                    ->disk('local')
                    ->required()
                ,
                Forms\Components\Select::make('peiroow_letter_id')
                    ->label('پیرو')
                    ->relationship('letter', 'subject')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
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
                            ->label('اداره')
                            ->relationship('organ', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('نام')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('address')
                                    ->required()
                                    ->label('آدرس'),
                                Forms\Components\TextInput::make('phone')
                                    ->label('شماره تماس')
                                    ->tel(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject')->label('موضوع'),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLetters::route('/'),
            'create' => Pages\CreateLetter::route('/create'),
            'edit' => Pages\EditLetter::route('/{record}/edit'),
        ];
    }
}
