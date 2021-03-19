<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Eventlocation extends Model
{
    use HasFactory;

    protected $guarded = []; // Allows Mass assignments.


    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class);
    }
}
