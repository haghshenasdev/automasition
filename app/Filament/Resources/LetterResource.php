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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
                Forms\Components\Select::make('type')
                    ->options([
                        null => 'شخصی',
                        0 => 'عمومی',
                        1 => 'شرکت یا کارگاه',
                    ])->label('نوع')->default(null)
                ,
                Select::make('customers')
                    ->label('صاحب')
                    ->multiple()
                    ->required()
                    ->relationship(null,'name')
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('نام و نام خانوادگی')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code_melli')
                            ->required()
                            ->unique()
                            ->numeric()
                            ->label('کد ملی'),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('تاریخ تولد')
                        ,
                        Forms\Components\TextInput::make('phone')
                            ->label('شماره تماس')
                            ->required()
                            ->tel(),
                        Forms\Components\Select::make('city_id')
                            ->label('شهر')
                            ->relationship('city', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('نام شهر')
                                ,
                            ])
                        ,
                    ])
                ,
                Forms\Components\TextInput::make('subject')
                    ->label('موضوع')
                    ->required(),
                Forms\Components\Select::make('titleholder_id')
                    ->label('گیرنده نامه')
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
                Forms\Components\Select::make('peiroow_letter_id')
                    ->label('پیرو')
                    ->relationship('letter', 'subject')
                    ->searchable()
                    ->preload()
                ,
                FileUpload::make('file')
                    ->label('فایل')
                    ->disk('private')
                    ->downloadable()
                    ->getUploadedFileNameForStorageUsing(static fn (TemporaryUploadedFile $file,?Model $record) => "{$record->id}/{$record->id}." . explode('/',$file->getMimeType())[1])
                    ->directory('letters')
                    ->visibility('private')
                    ->preserveFilenames()
                    ->imageEditor()
                    ->hiddenOn('create'),
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
            RelationManagers\AppendixRelationManager::class,
            RelationManagers\AnswerRelationManager::class,
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
