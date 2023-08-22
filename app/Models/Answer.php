<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Answer extends Model
{
    use HasFactory;

    public function letter(): BelongsTo
    {
        return $this->belongsTo(letter::class);
    }

    public function Titleholder(): HasOne
    {
        return $this->HasOne(Titleholder::class);
    }
}
