<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

trait FileEventHandler
{
//    public static string $FolderName;
//    public static string $FilePrefix;

    public static function getRootPath(): string
    {
        return config('filesystems.disks.private.root'). DIRECTORY_SEPARATOR;
    }
    protected static function getPathPattern($modelId,$file,$letterId): ?string
    {
        return (is_null($file)) ? null : $letterId
            . DIRECTORY_SEPARATOR
            . self::$FolderName
            . DIRECTORY_SEPARATOR
            . self::$FilePrefix . $letterId . '-' . $modelId . '.' . $file;
    }

    public function getFilePath(int $letterId) : string|null
    {
        return self::getPathPattern($this->id,$this->file,$letterId);
    }

    public static function getFilePathByArray(int $letterId,Array $record) : string|null
    {
        return self::getPathPattern($record['id'],$record['file'],$letterId);
    }

    private static function renameFile(Model $model): bool
    {
        if (!is_null($model->file)){
            $path = self::getRootPath();
            $letterId = $model->letter()->get('id')->first()->id;
            $modeArray = $model->toArray();
            $modeArray['file'] = explode('.',$modeArray['file'])[1];
            $newPath = self::getFilePathByArray($letterId,$modeArray);
            $oldPath = $path . $model->file;

            if (File::move($oldPath,$path . $newPath)){
                $model->file = $modeArray['file'];
                return $model->save();
            }
        }
        return false;
    }

    protected static function BootFileUpdateEvent(Model $model)
    {
        if (!is_null($model->getOriginal('file')) && $model->file != $model->getOriginal('file')) {
            $letterId = $model->letter()->get('id')->first()->id;
            File::delete(
                self::getRootPath() .
                self::getFilePathByArray($letterId,$model->getOriginal())
            );
            if (str_contains($model->file,'.')) self::renameFile($model);
        }
    }

    protected static function BootFileDeleteEvent(Model $model)
    {
        $letterId = $model->letter()->get('id')->first()->id;
        File::delete(
            self::getRootPath()
            . $model->getFilePath($letterId)
        );
    }
}
