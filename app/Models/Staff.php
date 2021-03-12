<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class Staff extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    use HasFactory;
    // Allows Mass assignments.
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function hotel(){
        // Creates a One to Many Relationship
        return $this->belongsTo('App\Models\Hotel');
    }

    public function positions(){
        // Creates a Many to Many relationship with Staff <-> Position
        return $this->belongsToMany('App\Models\Position');
    }

    public function holidays(){
        // Creates a One to Many relationship with Staff <-> Holidays
        return $this->hasMany('App\Models\Holidays');
    }

    public function dailysales(){
        // Creates a One to Many relationship with Staff <-> Holidays
        return $this->hasMany('App\Models\DailySales');
    }

    public function getFullNameAttribute(){
        return $this->forename . " " . $this->surname;
    }

    public function getNOKAttribute(){
        return $this->who . " " . $this->contactnumber;
    }

    public function getPersonallicenseAttribute($value)
    {
        // Changes the output from the database, to icons for the staff index page.
        if($value == "Yes") {
            $value = "check";
        } else {
            $value = "times";
        }
        return $value;
    }

}
