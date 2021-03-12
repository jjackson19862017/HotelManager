<?php

namespace App\Libraries;

use App\Models\Placement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class General
{
    public static function getEnumValues($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum = Arr::add($enum, $v, $v);
        }
        return $enum;
    }

    public static function ArrayDayNames()
    {
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[$i] = jddayofweek($i, 1);
        }
        return $days;
    }

    public static function FindMeAMonday($date)
    {
        $datevar = $date; // Gets current date
        while ($datevar != Carbon::parse($datevar)->isDayOfWeek(Carbon::MONDAY)) {
            $datevar = $datevar->subDay(); // While the date isnt a Monday subtract a day till it is Monday
        }
        return $datevar->format('Y-m-d');

    }

    public static function PrettyTime($time)
    {
        // Changes the time from the Database (String) to a Carbon time
        if ($time == Null) {
            return "";
        }
        return Carbon::parse($time)->format('H:i');
    }

    public static function ColourSelection($colour)
    {
        if ($colour == "Blue") {
            $colour = "bg-primary text-white";
        }
        if ($colour == "Yellow") {
            $colour = "bg-warning text-dark";
        }
        if ($colour == "Gray") {
            $colour = "bg-secondary text-white";
        }
        if ($colour == "Green") {
            $colour = "bg-success text-white";
        }
        if ($colour == "Red") {
            $colour = "bg-danger text-white";
        }
        if ($colour == "Cyan") {
            $colour = "bg-info text-white";
        }
        if ($colour == "Light Gray") {
            $colour = "bg-light text-dark";
        }
        if ($colour == "Black") {
            $colour = "bg-dark text-white";
        }
        if ($colour == "White") {
            $colour = "bg-white text-dark";
        }

        return $colour;
    }
}
