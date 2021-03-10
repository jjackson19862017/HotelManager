<?php
namespace App\Libraries;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
class General {
    public static function getEnumValues($table, $column) {
      $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
      preg_match('/^enum\((.*)\)$/', $type, $matches);
      $enum = array();
      foreach( explode(',', $matches[1]) as $value )
      {
        $v = trim( $value, "'" );
        $enum = Arr::add($enum, $v, $v);
      }
      return $enum;
    }

    public static function ArrayDayNames(){
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[$i] = jddayofweek($i,1);
        }
        return $days;
    }

    public static function FindMeAMonday($date){
        $datevar = $date; // Gets current date
        while($datevar != Carbon::parse($datevar)->isDayOfWeek(Carbon::MONDAY)){
            $datevar = $datevar->subDay(); // While the date isnt a Monday subtract a day till it is Monday
        }
        return $datevar->format('Y-m-d');

    }
}
