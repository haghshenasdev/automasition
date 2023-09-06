<?php

namespace App\Filament\Resources\LetterResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AppendixRelationManager extends RelationManager
{
    protected static string $relationship = 'Appendix';

    protected static ?string $label = 'ضمیمه ها';

    protected static ?string $pluralLabel = 'ضمیمه';

    protected static ?string $modelLabel = 'ضمیمه';

    protected static ?string $title = 'ضمیمه ها';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('عنوان')
                    ->maxLength(255)
                ,
                FileUpload::make('file')
                    ->label('فایل')
                    ->disk('private')
                    ->downloadable()
                    ->visibility('private')
                    ->preserveFilenames()
                    ->imageEditor()
                    ->required()
                    ->getUploadedFileNameForStorageUsing( fn (TemporaryUploadedFile $file,?Model $record) => $this->getFileNamePath($file,$record))
                ,
            ]);
    }


    private function getFileNamePath(TemporaryUploadedFile $file,?Model $record) : string
    {
        $ownerId = $this->ownerRecord->id;
        $path = "{$ownerId}/apds";
//        $FPath= config('filesystems.disks.private.root'). $path;
//        File::ensureDirectoryExists($FPath);
//        (($record == null) ? count(scandir($FPath)) -2 : $record->id )
        return "{$path}/apd-{$ownerId}-".
            Date::now()->format('Y-m-d_H-i-s') .
            "." . explode('/',$file->getMimeType())[1];
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('عنوان'),
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
