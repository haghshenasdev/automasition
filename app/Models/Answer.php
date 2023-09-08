<?php

namespace App\Models;

use App\Models\Traits\FileEventHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\File;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_id',
        'result',
        'summary',
        'file',
        'titleholder_id',
    ];

    public function letter(): BelongsTo
    {
        return $this->belongsTo(letter::class);
    }

    public function Titleholder(): BelongsTo
    {
        return $this->BelongsTo(Titleholder::class);
    }

    // file event manager

    use FileEventHandler;

    public static string $FolderName = 'awrs';
    public static string $FilePrefix  = 'awr-';

    protected static function booted(): void
    {
        static::created(function (Answer $model) {
            self::renameFile($model);
        });
        static::deleted(function (Answer $model) {
            self::BootFileDeleteEvent($model);
        });

        static::updating(function (Answer $model) {
            self::BootFileUpdateEvent($model);
        });
    }
}
