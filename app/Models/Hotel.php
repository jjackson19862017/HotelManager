<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;


class Hotel extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;


    protected $dates = ['deleted_at'];

    use HasFactory;
    protected $guarded = []; // Allows Mass assignments.

    public function staff(){
        return $this->hasMany('App\Models\Staff');
    }

    public function rotas(){
        return $this->hasMany('App\Models\Rota');
    }

    public function dailysales()
    {
        // Creates a One to Many relationship with DailySales <-> Hotel
        return $this->belongsTo(DailySales::class);
    }

    public function eventlocations()
    {
        return $this->belongsToMany(Eventlocation::class);
    }

    public function getFullAddressAttribute()
    {
        $myAddress = $this->address . ',';
        $myTown = $this->town . ',';
        $myCounty = $this->county . ',';
        $myPostcode = $this->address . ',';
        return $myAddress . $myTown . $myCounty . $myPostcode;
    }

    public function getDeletedByAttribute($id)
    {
        // Grabs the name of the User who deleted the User.
        return User::withTrashed()->whereId($id)->value('name');
    }

    public function getCreatedByAttribute($id)
    {
        // Grabs the name of the User who deleted the User.
        return User::withTrashed()->whereId($id)->value('name');
    }
}
