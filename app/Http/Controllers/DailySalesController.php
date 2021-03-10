<?php

namespace App\Http\Controllers;

use App\Libraries\General;
use App\Models\DailySales;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\Foreach_;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class DailySalesController extends Controller
{
    //
    public function create()
    {
        $data = [];
        return view('admin.dailysales.createDailySales', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'hotel_id' => 'required|numeric',
            'totalrooms' => 'required|numeric',
            'date' => Rule::unique('daily_sales')->where(function ($query) use ($request) {
                return $query->where('hotel_id', '=', $request->input('hotel_id'));
            }),
            'iou' => 'numeric',
            'bacs' => 'numeric',
            'cheque' => 'numeric',
            'pdqreception' => 'numeric',
            'pdqbar' => 'numeric',
            'pdqrestaurant' => 'numeric',
            'notefifty' => 'numeric',
            'notetwenty' => 'numeric',
            'noteten' => 'numeric',
            'notefive' => 'numeric',
            'coinonepound' => 'numeric',
            'coinfifty' => 'numeric',
            'cointwenty' => 'numeric',
            'cointen' => 'numeric',
            'coinfive' => 'numeric',
            'cointwo' => 'numeric',
            'coinone' => 'numeric',
            'gpostotal' => 'required|numeric',
            'roomssold' => 'numeric',
            'roomsoccupied' => 'numeric',
            'residents' => 'numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //dd($validator);
        $tillcount = [
            'user_id' => $request->input('user_id'),
            'hotel_id' => $request->input('hotel_id'),
            'totalrooms' => $request->input('totalrooms'),
            'date' => $request->input('date'),
            'iou' => $request->input('iou'),
            'bacs' => $request->input('bacs'),
            'cheque' => $request->input('cheque'),
            'pdqreception' => $request->input('pdqreception'),
            'pdqbar' => $request->input('pdqbar'),
            'pdqrestaurant' => $request->input('pdqrestaurant'),
            'notefifty' => $request->input('notefifty'),
            'notetwenty' => $request->input('notetwenty'),
            'noteten' => $request->input('noteten'),
            'notefive' => $request->input('noteten'),
            'coinonepound' => $request->input('coinonepound'),
            'coinfifty' => $request->input('coinfifty'),
            'cointwenty' => $request->input('cointwenty'),
            'cointen' => $request->input('cointen'),
            'coinfive' => $request->input('coinfive'),
            'cointwo' => $request->input('cointwo'),
            'coinone' => $request->input('coinone'),
            'gpostotal' => $request->input('gpostotal'),
            'roomssold' => $request->input('roomssold'),
            'roomsoccupied' => $request->input('roomsoccupied'),
            'residents' => $request->input('residents'),

            // Card Total
            'cardtotal' => $request->pdqreception + $request->pdqbar + $request->pdqrestaurant,

            // Till Maths
            'totalnotefifty' => $request->notefifty * 50,
            'totalnotetwenty' => $request->notetwenty * 20,
            'totalnoteten' => $request->noteten * 10,
            'totalnotefive' => $request->notefive * 5,
            'totalcoinonepound' => $request->coinonepound * 1,
            'totalcoinfifty' => $request->coinfifty * .5,
            'totalcointwenty' => $request->cointwenty * .2,
            'totalcointen' => $request->cointen * .1,
            'totalcoinfive' => $request->coinfive * .05,
            'totalcointwo' => $request->cointwo * .02,
            'totalcoinone' => $request->coinone * .01,

            // Till Total
            'cashtotal' => ($request->notefifty * 50) + ($request->notetwenty * 20) + ($request->noteten * 10) + ($request->notefive * 5) + ($request->coinonepound * 1) + ($request->coinfifty * .5) + ($request->cointwenty * .2) + ($request->cointen * .1) + ($request->coinfive * .05) + ($request->cointwo * .02) + ($request->coinone * .01),

            // Every Total
            'total' => $request->pdqreception + $request->pdqbar + $request->pdqrestaurant + $request->bacs + $request->iou + $request->cheque + ($request->notefifty * 50) + ($request->notetwenty * 20) + ($request->noteten * 10) + ($request->notefive * 5) + ($request->coinonepound * 1) + ($request->coinfifty * .5) + ($request->cointwenty * .2) + ($request->cointen * .1) + ($request->coinfive * .05) + ($request->cointwo * .02) + ($request->coinone * .01),

            // Float
            'float' => $request->pdqreception + $request->pdqbar + $request->pdqrestaurant + $request->bacs + $request->iou + $request->cheque + ($request->notefifty * 50) + ($request->notetwenty * 20) + ($request->noteten * 10) + ($request->notefive * 5) + ($request->coinonepound * 1) + ($request->coinfifty * .5) + ($request->cointwenty * .2) + ($request->cointen * .1) + ($request->coinfive * .05) + ($request->cointwo * .02) + ($request->coinone * .01) - $request->gpostotal,

            // Cash for the safe
            'cashsafe' => $request->gpostotal - ($request->pdqreception + $request->pdqbar + $request->pdqrestaurant + $request->bacs)
        ];

        //dd($tillcount);

        $newId = DailySales::create($tillcount)->id; // Stores the New Records Id in $newId
        $request->session()->flash('message', 'Event was Created... ');
        $request->session()->flash('text-class', 'text-success');

        //dd($newId);

        return redirect()->route('admin.index');
    }

    public function allmoneysales()
    {
        $data = [];
        $data['sales'] = DailySales::where('hotel', '=', 'Shard')->orderBy('date', 'desc')->paginate(15);
        //dd($data['sales']);
        return view('admin.hotels.sales.allmoneysales', $data);
    }

    public function yearlysetup()
    {
        $currentYear = Carbon::createFromDate(null)->format('Y');
        $startDate = Carbon::createFromDate($currentYear, 1, 1);
        $endDate = Carbon::createFromDate($currentYear, 12, 31);
        while ($startDate <= $endDate) {
            $insert = DailySales::insert(['date' => $startDate->format('Y-m-d'), 'user_id' => 0, 'hotel' => 'The Mill']);
            //array_push($arrayYear,$startDate->format('Y-m-d'));
            $startDate->addDay();
        }

        return redirect()->route('admin.hotels.sales.allmoneysales');
    }


    public function edit(DailySales $id)
    {
        $data = [];
        $data['sales'] = DailySales::find($id)->last();
        $data['OtherPaymentTotals'] = number_format($data['sales']->iou + $data['sales']->bacs + $data['sales']->cheque, 2);
        $data['CCPT'] = number_format($data['sales']->cashtotal + $data['sales']->cardtotal, 2);
        //dd($data['CCPT']);
        return view('admin.dailysales.edit', $data);
    }

    public function update(DailySales $dailySales, Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = [];
        $validator = Validator::make($request->all(), [
            'user_id' => 'numeric',
            'hotel_id' => 'numeric',
            'totalrooms' => 'numeric',
            //'date' => 'unique:daily_sales,date,'.$request->id,
            'iou' => 'numeric',
            'bacs' => 'numeric',
            'cheque' => 'numeric',
            'pdqreception' => 'numeric',
            'pdqbar' => 'numeric',
            'pdqrestaurant' => 'numeric',
            'notefifty' => 'numeric',
            'notetwenty' => 'numeric',
            'noteten' => 'numeric',
            'notefive' => 'numeric',
            'coinonepound' => 'numeric',
            'coinfifty' => 'numeric',
            'cointwenty' => 'numeric',
            'cointen' => 'numeric',
            'coinfive' => 'numeric',
            'cointwo' => 'numeric',
            'coinone' => 'numeric',
            'gpostotal' => 'required|numeric',
            'roomssold' => 'numeric',
            'roomsoccupied' => 'numeric',
            'residents' => 'numeric'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //dd($validator);
        $tillcount = [
            'user_id' => $request->input('user_id'),
            'hotel_id' => $request->input('hotel_id'),
            'totalrooms' => $request->input('totalrooms'),
            'date' => $request->input('date'),
            'iou' => $request->input('iou'),
            'bacs' => $request->input('bacs'),
            'cheque' => $request->input('cheque'),
            'pdqreception' => $request->input('pdqreception'),
            'pdqbar' => $request->input('pdqbar'),
            'pdqrestaurant' => $request->input('pdqrestaurant'),
            'notefifty' => $request->input('notefifty'),
            'notetwenty' => $request->input('notetwenty'),
            'noteten' => $request->input('noteten'),
            'notefive' => $request->input('noteten'),
            'coinonepound' => $request->input('coinonepound'),
            'coinfifty' => $request->input('coinfifty'),
            'cointwenty' => $request->input('cointwenty'),
            'cointen' => $request->input('cointen'),
            'coinfive' => $request->input('coinfive'),
            'cointwo' => $request->input('cointwo'),
            'coinone' => $request->input('coinone'),
            'gpostotal' => $request->input('gpostotal'),
            'roomssold' => $request->input('roomssold'),
            'roomsoccupied' => $request->input('roomsoccupied'),
            'residents' => $request->input('residents'),

            // Card Total
            'cardtotal' => $request->pdqreception + $request->pdqbar + $request->pdqrestaurant,

            // Till Maths
            'totalnotefifty' => $request->notefifty * 50,
            'totalnotetwenty' => $request->notetwenty * 20,
            'totalnoteten' => $request->noteten * 10,
            'totalnotefive' => $request->notefive * 5,
            'totalcoinonepound' => $request->coinonepound * 1,
            'totalcoinfifty' => $request->coinfifty * .5,
            'totalcointwenty' => $request->cointwenty * .2,
            'totalcointen' => $request->cointen * .1,
            'totalcoinfive' => $request->coinfive * .05,
            'totalcointwo' => $request->cointwo * .02,
            'totalcoinone' => $request->coinone * .01,

            // Till Total
            'cashtotal' => ($request->notefifty * 50) + ($request->notetwenty * 20) + ($request->noteten * 10) + ($request->notefive * 5) + ($request->coinonepound * 1) + ($request->coinfifty * .5) + ($request->cointwenty * .2) + ($request->cointen * .1) + ($request->coinfive * .05) + ($request->cointwo * .02) + ($request->coinone * .01),

            // Every Total
            'total' => $request->pdqreception + $request->pdqbar + $request->pdqrestaurant + $request->bacs + $request->iou + $request->cheque + ($request->notefifty * 50) + ($request->notetwenty * 20) + ($request->noteten * 10) + ($request->notefive * 5) + ($request->coinonepound * 1) + ($request->coinfifty * .5) + ($request->cointwenty * .2) + ($request->cointen * .1) + ($request->coinfive * .05) + ($request->cointwo * .02) + ($request->coinone * .01),

            // Float
            'float' => $request->pdqreception + $request->pdqbar + $request->pdqrestaurant + $request->bacs + $request->iou + $request->cheque + ($request->notefifty * 50) + ($request->notetwenty * 20) + ($request->noteten * 10) + ($request->notefive * 5) + ($request->coinonepound * 1) + ($request->coinfifty * .5) + ($request->cointwenty * .2) + ($request->cointen * .1) + ($request->coinfive * .05) + ($request->cointwo * .02) + ($request->coinone * .01) - $request->gpostotal,

            // Cash for the safe
            'cashsafe' => $request->gpostotal - ($request->pdqreception + $request->pdqbar + $request->pdqrestaurant + $request->bacs)
        ];

        //dd($tillcount);
        //dd($dailySales);
        $dailySales->whereId($request->input('id'))->update($tillcount);
        $request->session()->flash('message', 'Updated: End of Day');
        $request->session()->flash('text-class', 'text-success');
        return redirect()->route('hotel.dailysales.index', $request->input('hotel_id'));
    }


    public function occreport(Hotel $hotel)
    {
        $data = [];
        $data['hotel'] = Hotel::find($hotel->id);
        $data['months'] = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];
        $data['CurrentYearArray'] = []; // Will be used to track number of days in that month
        $data['CurrentYearDaysArray'] = []; // Will be used to calculate the number of days in that month
        $data['BackOneYearArray'] = []; // Will be used to track number of days in that month
        $data['BackOneYearDaysArray'] = [];// Will be used to calculate the number of days in that month
        $data['BackTwoYearArray'] = []; // Will be used to track number of days in that month
        $data['BackTwoYearDaysArray'] = [];// Will be used to calculate the number of days in that month
        $data['CurrentYearRoomsSold'] = []; // Random Number array that will be replaced my data in the future.
        $data['BackOneYearRoomsSold'] = []; // Random Number array that will be replaced my data in the future.
        $data['BackTwoYearRoomsSold'] = []; // Random Number array that will be replaced my data in the future.
        $data['CurrentYearOcc'] = []; // Random Number array that will be replaced my data in the future.
        $data['BackOneYearOcc'] = []; // Random Number array that will be replaced my data in the future.
        $data['BackTwoYearOcc'] = []; // Random Number array that will be replaced my data in the future.

        // Formula for Occ Report
        // Occ Rate = (Rooms Sold / (days of the month x 23)) * 100
        $data['currentYear'] = Carbon::createFromDate(null)->format('Y');
        $data['backOneYear'] = $data['currentYear'] - 1;
        $data['backTwoYear'] = $data['currentYear'] - 2;

        // Works out Days in each Month for Current Year and going back two.
        $i = 1; // Counter
        $currentStart = []; // Array for Having all the Starting Months Dates
        $currentEnd = [];// Array for Having all the Ending Months Dates
        $currentRooms = [];// Array for Counting how many rooms the hotel had available to sell

        $backOneYearStart = [];
        $backOneYearEnd = [];
        $backOneYearRooms = [];// Array for Counting how many rooms the hotel had available to sell

        $backTwoYearStart = [];
        $backTwoYearEnd = [];
        $backTwoYearRooms = [];// Array for Counting how many rooms the hotel had available to sell


        $data['CurrentYearArraySold'] = []; // Number of Rooms Sold for the Current Year
        $data['BackOneYearArraySold'] = []; // Number of Rooms Sold for the Last Year
        $data['BackTwoYearArraySold'] = []; // Number of Rooms Sold for the 2 Years Ago
        while ($i <= 12) {
            array_push($data['CurrentYearArray'], Carbon::createFromDate(null, $i)->daysInMonth); // Counts days in each month and puts it into an array
            array_push($data['BackOneYearArray'], Carbon::createFromDate($data['backOneYear'], $i)->daysInMonth); // Counts days in each month and puts it into an array
            array_push($data['BackTwoYearArray'], Carbon::createFromDate($data['backTwoYear'], $i)->daysInMonth); // Counts days in each month and puts it into an array

            $currentStart[] = Carbon::create($data['currentYear'], $i)->startOfMonth(); // Returns the Start of Each Month
            $currentEnd[] = Carbon::create($data['currentYear'], $i)->endOfMonth(); // Returns the End of Each Month

            $backOneYearStart[] = Carbon::create($data['backOneYear'], $i)->startOfMonth(); // Returns the Start of Each Month
            $backOneYearEnd[] = Carbon::create($data['backOneYear'], $i)->endOfMonth(); // Returns the End of Each Month

            $backTwoYearStart[] = Carbon::create($data['backTwoYear'], $i)->startOfMonth(); // Returns the Start of Each Month
            $backTwoYearEnd[] = Carbon::create($data['backTwoYear'], $i)->endOfMonth(); // Returns the End of Each Month

            $i++;
        }

        $i = 0;
        while ($i < 12) {
            $currentRooms[] = DailySales::whereHotelId($hotel->id)->whereBetween('date', [$currentStart[$i], $currentEnd[$i]])->avg('totalrooms'); // Gets all the results for the current year of the rooms Occupied;
            $backOneYearRooms[] = DailySales::whereHotelId($hotel->id)->whereBetween('date', [$backOneYearStart[$i], $backOneYearEnd[$i]])->avg('totalrooms'); // Gets all the results for the current year of the rooms Occupied;
            $backTwoYearRooms[] = DailySales::whereHotelId($hotel->id)->whereBetween('date', [$backTwoYearStart[$i], $backTwoYearEnd[$i]])->avg('totalrooms'); // Gets all the results for the current year of the rooms Occupied;

            $data['CurrentYearArraySold'][] = DailySales::whereHotelId($hotel->id)->whereBetween('date', [$currentStart[$i], $currentEnd[$i]])->sum('roomsoccupied'); // Gets all the results for the current year of the rooms Sold
            $data['BackOneYearArraySold'][] = DailySales::whereHotelId($hotel->id)->whereBetween('date', [$backOneYearStart[$i], $backOneYearEnd[$i]])->sum('roomsoccupied'); // Gets all the results for the current year of the rooms Sold
            $data['BackTwoYearArraySold'][] = DailySales::whereHotelId($hotel->id)->whereBetween('date', [$backTwoYearStart[$i], $backTwoYearEnd[$i]])->sum('roomsoccupied'); // Gets all the results for the current year of the rooms Sold

            $i++;
        }


        // Finds All Room Sales This Year for the Hotel

        // Calculates the number of rooms that could be sold each month
        foreach ($data['CurrentYearArray'] as $i => $DaysInEachMonth) {
            array_push($data['CurrentYearDaysArray'], $DaysInEachMonth * $currentRooms[$i]);
        }

        // Calculates the number of rooms that could be sold each month
        foreach ($data['BackOneYearArray'] as $i => $DaysInEachMonth) {
            array_push($data['BackOneYearDaysArray'], $DaysInEachMonth * $backOneYearRooms[$i]);
        }

        // Calculates the number of rooms that could be sold each month
        foreach ($data['BackTwoYearArray'] as $i => $DaysInEachMonth) {
            array_push($data['BackTwoYearDaysArray'], $DaysInEachMonth * $backTwoYearRooms[$i]);
        }

        $c = 0;
        while ($c < 12) {
            if ($data['CurrentYearArraySold'][$c] != 0) {
                array_push($data['CurrentYearOcc'], number_format(($data['CurrentYearArraySold'][$c] / $data['CurrentYearDaysArray'][$c]) * 100, 1));
            } else {
                array_push($data['CurrentYearOcc'], 0);
            }

            if ($data['BackOneYearArraySold'][$c] != 0) {
                array_push($data['BackOneYearOcc'], number_format(($data['BackOneYearArraySold'][$c] / $data['BackOneYearDaysArray'][$c]) * 100, 1));
                //    echo $data['BackOneYearArray'][$c] . "/" .  $data['BackOneYearDaysArray'][$c] . "=" . (($data['BackOneYearArray'][$c] / $data['BackOneYearDaysArray'][$c])*100) . "<br>";
            } else {
                array_push($data['BackOneYearOcc'], 0);
            }

            if ($data['BackTwoYearArraySold'][$c] != 0) {
                array_push($data['BackTwoYearOcc'], number_format(($data['BackTwoYearArraySold'][$c] / $data['BackTwoYearDaysArray'][$c]) * 100, 1));
            } else {
                array_push($data['BackTwoYearOcc'], 0);
            }
            $c++;
        }


        $data['CurrentYearTotal'] = DailySales::whereHotelId($hotel->id)->whereYear('date', '=', date('Y'))->sum('roomsoccupied'); // Replace with totals from the table
        $data['BackOneYearTotal'] = DailySales::whereHotelId($hotel->id)->whereYear('date', '=', $data['backOneYear'])->sum('roomsoccupied'); // Replace with totals from the table
        $data['BackTwoYearTotal'] = DailySales::whereHotelId($hotel->id)->whereYear('date', '=', $data['backTwoYear'])->sum('roomsoccupied'); // Replace with totals from the table
        $data['CurrentYearAvg'] = number_format($data['CurrentYearTotal'] / (array_sum($data['CurrentYearArray']) * (array_sum($currentRooms) / count($currentRooms))) * 100, 1);
        $data['BackOneYearAvg'] = number_format($data['BackOneYearTotal'] / (array_sum($data['BackOneYearArray']) * (array_sum($backOneYearRooms) / count($backOneYearRooms))) * 100, 1);
        $data['BackTwoYearAvg'] = number_format($data['BackTwoYearTotal'] / (array_sum($data['BackTwoYearArray']) * (array_sum($backTwoYearRooms) / count($backTwoYearRooms))) * 100, 1);

        return view('admin.reports.occupancy', $data);
    }

    public function mondays()
    {
        $arrayMondays = [];
        $i = 1;
        $recordCount = DailySales::all()->count(); // Returns number of records in Table
        $n = 0;
        while ($i <= $recordCount) {
            if (is_null($item = DailySales::find($n))) { // Checks to see if the record exists
                $n++; // if it doesnt add one and try again.
            } else {
                $item = DailySales::find($n)->where('id', '=', $n)->value('Date'); // Returns the date value.
                $n++;
                $isMonday = Carbon::parse($item)->isDayOfWeek(Carbon::MONDAY); // Checks the Date to see it equals Monday
                if ($isMonday) {
                    array_push($arrayMondays, $item); // Add to array table
                };
                $i++;
            };
        };
        $RoomsSoldondaySelection = array_reverse($arrayMondays);
        return $RoomsSoldondaySelection;
    }


    public function dailysales(Hotel $hotel)
    {
        $data = [];
        $data['hotel'] = Hotel::find($hotel->id);

        // Configure the Date Find Drop Box
        $testDate = Carbon::now();
        while ($testDate != Carbon::parse($testDate)->isDayOfWeek(Carbon::MONDAY)) {
            $testDate = $testDate->subDay();
        }
        $startOfWeek = $testDate;

        $testDate = $testDate->format('Y-m-d'); // returns Today
        $startOfWeek = $startOfWeek->subDay(); // Goes back a Week.

        $data['daysOfWeek'] = General::ArrayDayNames(); // Creates An Array of Day Names

        $data['weeklySales'] = DailySales::orderBy('date', 'asc')->where('hotel_id', '=', $hotel->id)->where('date', '>=', $startOfWeek)->limit(7)->get();
        $data['weeklyCount'] = $data['weeklySales']->count();

        $data['tableSize'] = [];
        // Only displays the days that exist for the week
        for ($r = 0; $r < $data['weeklyCount']; $r++) {
            array_push($data['tableSize'], $data['daysOfWeek'][$r]);
        }
        //dd($data['weeklySales']);
        //dd($data['tableSize']);

        return view('admin.dailysales.index', $data);
    }

    public function prevsales(DailySales $sales, Hotel $hotel)
    {
        $data = [];
        //$data['all'] = DailySales::whereHotelId($hotel->id)->orderBy('date','desc')->get();

        // Finds the Earliest Date
        $data['earliestDate'] = DailySales::whereHotelId($hotel->id)->select('date')->orderBy('date', 'asc')->value('date');

        // Finds the Latest Date
        $data['latestDate'] = DailySales::whereHotelId($hotel->id)->select('date')->orderBy('date', 'desc')->value('date');

        //Finds the Hotel to give information to tell the end user what hotel is being viewed
        $data['hotel'] = Hotel::find($hotel->id);

        $data['earliestYear'] = Carbon::parse($data['earliestDate'])->format('Y'); // Finds Earliest Record and Extracts the Year
        $data['latestYear'] = Carbon::parse($data['latestDate'])->format('Y'); // Finds Latest Record and Extracts the Year

        $data['yearsPast'] = $data['latestYear'] - $data['earliestYear']; // Calculates the Difference Between the Years

        // Creates Array and then fills up each row with the Earliest Year to the Latest Year.
        $data['years'] = [];
        for ($i = $data['yearsPast']; $i >= 0; $i--) {
            $data['years'][$data['latestYear'] - $i] = $data['latestYear'] - $i;

        };

        // Fills up each array with information categorised into each year
        foreach ($data['years'] as $i => $year) {
            $from = Carbon::createFromDate($data['years'][$i], 1, 1)->subDay();
            $to = Carbon::createFromDate($data['years'][$i], 12, 31);
            $data['years'][$i] = DailySales::whereHotelId($hotel->id)->select('date', DB::raw('sum(cashtotal) as cashtotal'), DB::raw('sum(cardtotal) as cardtotal'), DB::raw('sum(gpostotal) as gpostotal'), DB::raw('sum(cashsafe) as cashsafe'), DB::raw('sum(total) as total'), DB::raw('sum(roomssold) as roomssold'), DB::raw('sum(roomsoccupied) as roomsoccupied'),DB::raw('sum(residents) as residents'))->whereBetween('date', [$from, $to])->groupBy(DB::raw("YEAR(`date`)"), DB::raw("MONTH(`date`)"))->get();
            //var_dump($data['years'][$i]);

        }
        //dd($data);

        //dd($data);
//dd($data['years']);

        return view('admin.prevsales.index', $data);
    }

    public function weeklysales(DailySales $sales, Hotel $hotel)
    {
        $data = [];
        //$data['all'] = DailySales::whereHotelId($hotel->id)->orderBy('date','desc')->get();

        // Finds the Earliest Date
        $data['earliestDate'] = DailySales::whereHotelId($hotel->id)->select('date')->orderBy('date', 'asc')->value('date');

        // Finds the Latest Date
        $data['latestDate'] = DailySales::whereHotelId($hotel->id)->select('date')->orderBy('date', 'desc')->value('date');

        //Finds the Hotel to give information to tell the end user what hotel is being viewed
        $data['hotel'] = Hotel::find($hotel->id);

        $data['earliestYear'] = Carbon::parse($data['earliestDate'])->format('Y'); // Finds Earliest Record and Extracts the Year
        $data['latestYear'] = Carbon::parse($data['latestDate'])->format('Y'); // Finds Latest Record and Extracts the Year

        $data['yearsPast'] = $data['latestYear'] - $data['earliestYear']; // Calculates the Difference Between the Years

        // Creates Array and then fills up each row with the Earliest Year to the Latest Year.
        $data['years'] = [];
        for ($i = $data['yearsPast']; $i >= 0; $i--) {
            $data['years'][$data['latestYear'] - $i] = $data['latestYear'] - $i;

        };

        // Fills up each array with information categorised into each year
        foreach ($data['years'] as $i => $year) {
            $from = Carbon::createFromDate($data['years'][$i], 1, 1)->subDay();
            $to = Carbon::createFromDate($data['years'][$i], 12, 31);
            $data['years'][$i] = DailySales::whereHotelId($hotel->id)->select('date', DB::raw('sum(cashtotal) as cashtotal'), DB::raw('sum(cardtotal) as cardtotal'), DB::raw('sum(gpostotal) as gpostotal'), DB::raw('sum(cashsafe) as cashsafe'), DB::raw('sum(total) as total'), DB::raw('sum(roomssold) as roomssold'), DB::raw('sum(roomsoccupied) as roomsoccupied'),DB::raw('sum(residents) as residents'))->whereBetween('date', [$from, $to])->groupBy(DB::raw("YEAR(`date`)"), DB::raw("WEEK(`date`)"))->get();
        }
        return view('admin.prevsales.weekly', $data);
    }



    public function salessheet()
    {
        // Configure the Date Find Drop Box
        $testDate = Carbon::now();
        while ($testDate != Carbon::parse($testDate)->isDayOfWeek(Carbon::MONDAY)) {
            $testDate = $testDate->subDay();
            //echo $testDate;
        }
        $startOfWeek = $testDate;
        $testDate = $testDate->format('Y-m-d'); // returns Today

        $startOfWeek = $startOfWeek->subDay();
        $data = [];
        $data['days'] = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];

        $data['shardweeklysales'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->get();
        $data['shardweeklycount'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->get()->count();
        //dd($data['days']);
        $data['tablesize'] = [];

        // Only displays the days that exist for the week
        for ($r = 0; $r < $data['shardweeklycount']; $r++) {
            array_push($data['tablesize'], $data['days'][$r]);
        }

        $data['shardweeklytotalbacs'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('bacs')->sum();
        //$data['themillweeklysales'] = DailySales::orderBy('date','asc')->where('hotel','=','The Mill')->where('date','>=',$startOfWeek)->limit(7)->get();

        $data['shardweeklytotalcards'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('cardtotal')->sum();

        $data['shardweeklytotalcash'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('cashtotal')->sum();
        $data['shardweeklytotalgpos'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('gpostotal')->sum();
        $data['shardweeklytotalsafe'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('cashsafe')->sum();
        $data['shardweeklytotalrooms'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('roomssold')->sum();

        $arrayMondays = [];
        $i = 1;
        $recordCount = DailySales::all()->count(); // Returns number of records in Table
        $n = 0;
        while ($i <= $recordCount) {
            if (is_null($item = DailySales::find($n))) { // Checks to see if the record exists
                $n++; // if it doesnt add one and try again.
            } else {

                $item = DailySales::find($n)->where('hotel', '=', 'Shard')->where('id', '=', $n)->value('Date'); // Returns the date value.

                $n++;
                $isMonday = Carbon::parse($item)->isDayOfWeek(Carbon::MONDAY); // Checks the Date to see it equals Monday
                if ($isMonday) {
                    array_push($arrayMondays, $item); // Add to array table
                };
                $i++;
            };
        };
        //dd($arrayMondays);
        $data['mondaySelection'] = $arrayMondays;  // Orders it so the latest date is at the top of the list.

//dd($data['arrayMondays']);

        return view('admin.hotels.salessheet', $data);
    }

    public function salessheetfind(Request $request)
    {
        // Configure the Date Find Drop Box

        $testDate = $request->input('mondayselector');
        $testDate = Carbon::parse($testDate);

        while ($testDate != Carbon::parse($testDate)->isDayOfWeek(Carbon::MONDAY)) {
            $testDate = $testDate->subDay();
            //echo $testDate;
        }
        $startOfWeek = $testDate;
        $testDate = $testDate->format('Y-m-d'); // returns Today

        //$startOfWeek = $startOfWeek->subDay();
        $data = [];
        $data['days'] = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];

        $data['shardweeklysales'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->get();

        $data['shardweeklytotalbacs'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('bacs')->sum();
        //$data['themillweeklysales'] = DailySales::orderBy('date','asc')->where('hotel','=','The Mill')->where('date','>=',$startOfWeek)->limit(7)->get();
        $data['shardweeklycount'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->get()->count();
        //dd($data['shardweeklycount']);
        $data['tablesize'] = [];

        // Only displays the days that exist for the week
        for ($r = 0; $r < $data['shardweeklycount']; $r++) {
            array_push($data['tablesize'], $data['days'][$r]);
            echo $data['tablesize'][$r];
        }


        $data['shardweeklytotalcards'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('cardtotal')->sum();

        $data['shardweeklytotalcash'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('cashtotal')->sum();
        $data['shardweeklytotalgpos'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('gpostotal')->sum();
        $data['shardweeklytotalsafe'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('cashsafe')->sum();
        $data['shardweeklytotalrooms'] = DailySales::orderBy('date', 'asc')->where('hotel', '=', 'Shard')->where('date', '>=', $startOfWeek)->limit(7)->pluck('roomssold')->sum();


        $arrayMondays = [];
        $i = 1;
        $recordCount = DailySales::all()->count(); // Returns number of records in Table
        $n = 0;
        while ($i <= $recordCount) {
            if (is_null($item = DailySales::find($n))) { // Checks to see if the record exists
                $n++; // if it doesnt add one and try again.
            } else {

                $item = DailySales::find($n)->where('hotel', '=', 'Shard')->where('id', '=', $n)->orderBy('date', 'desc')->value('Date'); // Returns the date value.

                $n++;
                $isMonday = Carbon::parse($item)->isDayOfWeek(Carbon::MONDAY); // Checks the Date to see it equals Monday
                if ($isMonday) {
                    array_push($arrayMondays, $item); // Add to array table
                };
                $i++;
            };
        };
        $data['mondaySelection'] = $arrayMondays;  // Orders it so the latest date is at the top of the list.

        //dd($data['mondaySelection']);

        return view('admin.hotels.salessheet', $data);
    }
}
