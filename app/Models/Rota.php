<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rota extends Model
{
    use HasFactory;

    // Allows Mass assignments.
    protected $guarded = [];

    public function placements(): HasMany
    {
        return $this->hasMany(Rota::class);
    }

    public function staffs(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class);
    }

    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class);
    }
}
