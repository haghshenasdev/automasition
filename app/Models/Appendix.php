<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Appendix extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'title',
    ];

    protected $table = 'appendices';

    public function letter(): BelongsTo
    {
        return $this->belongsTo(letter::class);
    }

//    public function getFilePath(int $letterId) : string|null
//    {
//        return (is_null($this->file)) ? null : $letterId.'/'.$this->id.'.'.$this->file;
//    }
//
//    public static function getFilePathByArray(Array $record) : string|null
//    {
//        return (is_null($record['file'])) ? null : $record['id'].'/'.$record['id'].'.'.$record['file'];
//    }

    protected static function booted(): void
    {
        static::created(function (Appendix $model) {
            $path = config('filesystems.disks.private.root')
                . DIRECTORY_SEPARATOR
//                . $model->letter()->id
//                . DIRECTORY_SEPARATOR
//                .'apds'
//                .DIRECTORY_SEPARATOR
            ;
            $letterId = $model->letter()->get('id')->first()->id;
            $fileFormat = explode('.',$model->file)[1];
            $newPath = $path . $letterId."/apds/apd-".$letterId.'-'.$model->id."." . $fileFormat;
            if (File::move($path . $model->file,$newPath)){
                $model->file = $fileFormat;
                $model->save();
            }
        });
        static::deleted(function (Appendix $model) {
            $letterId = $model->letter()->get('id')->first()->id;
            File::delete(
                config('filesystems.disks.private.root')
                . DIRECTORY_SEPARATOR
                . $letterId
                . DIRECTORY_SEPARATOR
                . 'apds'
                . DIRECTORY_SEPARATOR
                . 'apd-' . $letterId . '-' . $model->id . '.' . $model->file
            );
        });
//
//        static::updating(function (Appendix $letter) {
//            if (!is_null($letter->getOriginal('file')) && $letter->file != $letter->getOriginal('file')) {
//                File::delete(
//                    config('filesystems.disks.private.root')
//                    . DIRECTORY_SEPARATOR .
//                    self::getFilePathByArray($letter->getOriginal())
//                );
//            }
//        });
    }
}
