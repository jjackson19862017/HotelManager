<?php

namespace App\Models;

use App\Libraries\General;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Placement extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    // Allows Mass assignments.
    protected $guarded = [];

    protected $dates = ['deleted_at'];


    public function rotas(): BelongsToMany
    {
        return $this->belongsToMany(Rota::class);
    }

    public static function getColourAttribute($colour)
    {
        return General::ColourSelection($colour);
    }

}
