<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    public function city(): HasOne
    {
        return $this->HasOne(City::class);
    }

    public function letters(): BelongsToMany
    {
        return $this->belongsToMany(letter::class);
    }
}
