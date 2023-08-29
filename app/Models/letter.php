<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'file',
        'type',
        'status',
        'user_id',
        'titleholder_id',
        'peiroow_letter_id',
    ];

    public function letter(): BelongsTo
    {
        return $this->belongsTo(letter::class,'peiroow_letter_id');
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function titleholder(): BelongsTo
    {
        return $this->belongsTo(Titleholder::class);
    }

    public function Answer(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function Appendix(): HasMany
    {
        return $this->hasMany(Appendix::class);
    }
}
