<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'brideforename',
        'bridesurname',
        'groomforename',
        'groomsurname',
        'telephone',
        'email',
        'address',
        'towncity',
        'county',
        'postcode',
    ];

    public function getCoupleAttribute()
    {
        return $this->brideforename . ' ' . $this->bridesurname . ' & ' . $this->groomforename . ' ' . $this->groomsurname;
    }

    public function getBrideAttribute()
    {
        return $this->brideforename . ' ' . $this->bridesurname;
    }

    public function getGroomAttribute()
    {
        return $this->groomforename . ' ' . $this->groomsurname;
    }
}
