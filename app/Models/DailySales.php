<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class DailySales extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
     // Allows Mass assignments.
    protected $guarded = [];
    //protected $fillable = ['user_id'];

    public function user()
    {
        // Creates a One to Many relationship with Holidays <-> Staff
        return $this->belongsTo(User::class);
    }

    public function hotels()
    {
        // Creates a One to Many relationship with Holidays <-> Staff
        return $this->belongsToMany(Hotel::class);
    }



}
