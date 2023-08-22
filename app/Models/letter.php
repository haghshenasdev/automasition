<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class letter extends Model
{
    use HasFactory;

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
}
