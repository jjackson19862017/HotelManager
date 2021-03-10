<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $fillable = [
        'id',
        'user_id',
        'date',
        'hotel_id',
        'totalrooms',
        'iou',
        'bacs',
        'cheque',
        'notefifty',
        'notetwenty',
        'noteten',
        'notefive',
        'coinonepound',
        'coinfifty',
        'cointwenty',
        'cointen',
        'coinfive',
        'cointwo',
        'coinone',
        'totalnotefifty',
        'totalnotetwenty',
        'totalnoteten',
        'totalnotefive',
        'totalcoinonepound',
        'totalcoinfifty',
        'totalcointwenty',
        'totalcointen',
        'totalcoinfive',
        'totalcointwo',
        'totalcoinone',
        'cashtotal',
        'float',
        'pdqreception',
        'pdqbar',
        'pdqrestaurant',
        'cardtotal',
        'gpostotal',
        'cashsafe',
        'total',
        'roomssold',
        'roomsoccupied',
        'residents',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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
