<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Replication extends Model
{
    use HasFactory;

    protected $fillable = [
        'titleholder_id',
        'letter_id',
    ];

    public function letter(): BelongsTo
    {
        return $this->belongsTo(letter::class);
    }

    public function titleholder(): BelongsTo
    {
        return $this->belongsTo(Titleholder::class);
    }
}
