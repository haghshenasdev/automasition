<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
