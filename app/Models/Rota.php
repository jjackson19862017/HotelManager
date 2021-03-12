<?php

namespace App\Models;

use App\Libraries\General;
use Carbon\Carbon;
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


    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class);
    }

    public function getStaffIdAttribute($id)
    {
        $forename = Staff::find($id)->forename;
        $surname = Staff::find($id)->surname;
        return $forename . " " . $surname;
    }

    public function getMondayroleoneAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getMondayroletwoAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getMondaystartoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getMondayfinishoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getMondaystarttwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getMondayfinishtwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getTuesdayroleoneAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getTuesdayroletwoAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getTuesdaystartoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getTuesdayfinishoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getTuesdaystarttwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getTuesdayfinishtwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getWednesdayroleoneAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getWednesdayroletwoAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getWednesdaystartoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getWednesdayfinishoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getWednesdaystarttwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getWednesdayfinishtwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getThursdayroleoneAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getThursdayroletwoAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getThursdaystartoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getThursdayfinishoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getThursdaystarttwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getThursdayfinishtwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getFridayroleoneAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getFridayroletwoAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getFridaystartoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getFridayfinishoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getFridaystarttwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getFridayfinishtwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getSaturdayroleoneAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getSaturdayroletwoAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getSaturdaystartoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getSaturdayfinishoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getSaturdaystarttwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getSaturdayfinishtwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getSundayroleoneAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getSundayroletwoAttribute($id)
    {
        return Placement::find($id)->short;
    }

    public function getSundaystartoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getSundayfinishoneAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getSundaystarttwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public function getSundayfinishtwoAttribute($time)
    {
        return General::PrettyTime($time);
    }

    public static function getColourAttribute($colour)
    {
        return General::ColourSelection($colour);
    }
}
