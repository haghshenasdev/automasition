<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Titleholder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'official',
        'organ_id',
    ];

    public function organ(): BelongsTo
    {
        return $this->belongsTo(Organ::class);
    }
}
