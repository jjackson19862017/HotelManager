<?php

namespace App\Http\Controllers;

use App\Libraries\General;
use App\Models\Hotel;
use App\Models\Placement;
use App\Models\Rota;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RotaController extends Controller
{
    //
    public function index(Hotel $hotel, $rota)
    {
        $data = [];
        $data['hotel'] = $hotel;
        $data['Placements'] = Placement::all();
        $data['DaysOfWeek'] = General::ArrayDayNames();
        $data['IsAMonday'] = General::FindMeAMonday(Carbon::parse($rota));
        $data['ThisWeeksRota'] = Rota::whereWeekcommencing($data['IsAMonday'])->whereHotelId($hotel->id)->get();
        $data['ThisWeeksTotalHours'] = $data['ThisWeeksRota']->pluck('totalhours')->sum();

        foreach ($data['DaysOfWeek'] as $day) {
            $data[$day . 'OneRolesFOH'] = array_count_values($data['ThisWeeksRota']->where(strtolower($day) . 'roleone', '=', 'FOH')->pluck(strtolower($day) . 'roleone')->toArray());
            $data[$day . 'TwoRolesFOH'] = array_count_values($data['ThisWeeksRota']->where(strtolower($day) . 'roletwo', '=', 'FOH')->pluck(strtolower($day) . 'roletwo')->toArray());
            $data[$day . 'OneRolesHK'] = array_count_values($data['ThisWeeksRota']->where(strtolower($day) . 'roleone', '=', 'HK')->pluck(strtolower($day) . 'roleone')->toArray());
            $data[$day . 'TwoRolesHK'] = array_count_values($data['ThisWeeksRota']->where(strtolower($day) . 'roletwo', '=', 'HK')->pluck(strtolower($day) . 'roletwo')->toArray());
            $data[$day . 'OneRolesKIT'] = array_count_values($data['ThisWeeksRota']->where(strtolower($day) . 'roleone', '=', 'KIT')->pluck(strtolower($day) . 'roleone')->toArray());
            $data[$day . 'TwoRolesKIT'] = array_count_values($data['ThisWeeksRota']->where(strtolower($day) . 'roletwo', '=', 'KIT')->pluck(strtolower($day) . 'roletwo')->toArray());
        }

        $data['ThisWeeksStaffsId'] = $data['ThisWeeksRota']->pluck('staff_id');

        //dd($data);

        return view('admin.rota.index', $data);
    }

    public function create($staff)
    {
        $data = [];
        $data['staff'] = Staff::find($staff); // Locates the Information on the Staff Member
        $data['hotels'] = Hotel::all(); // Returns the list of Hotels
        $data['DaysOfWeek'] = General::ArrayDayNames(); // Returns an array with Days of the Week
        $data['IsAMonday'] = General::FindMeAMonday(Carbon::now()); // Find a Monday from Last Week

        $data['AvailableDates'] = [];

        // Fills the Array with 5 weeks worth of Mondays
        for ($i = 0; $i <= 4; $i++) {
            $data['AvailableDates'] = Arr::add($data['AvailableDates'], $i, Carbon::parse($data['IsAMonday'])->format('Y-m-d'));
            $data['IsAMonday'] = Carbon::parse($data['IsAMonday'])->addWeek();
        }

        $data['placements'] = Placement::all(); // Returns the list of Placements


        //dd($data);

        return view('admin.rota.create', $data);
    }

    public function store(Request $request)
    {
        $days = General::ArrayDayNames();

        $validator = Validator::make($request->all(), [
            'staffid' => 'required|numeric',
            'hotel' => 'required',
            'WeekCommencing' => Rule::unique('rotas')->where(function ($query) use ($request) {
                return $query->where('staff_id', '=', $request->input('staffid'))->where('hotel_id', '=', $request->input('hotel'));
            }),
            'MondayStartOne' => 'bail|exclude_unless:MondayRoleOne,Off,Sick,Holiday',
            'MondayFinishOne' => 'bail|exclude_unless:MondayRoleOne,Off,Sick,Holiday',
            'MondayRoleOne' => 'required',
            'MondayStartTwo' => 'bail|exclude_unless:MondayRoleTwo,Off,Sick,Holiday',
            'MondayFinishTwo' => 'bail|exclude_unless:MondayRoleTwo,Off,Sick,Holiday',
            'MondayRoleTwo' => 'required',
            'TuesdayStartOne' => 'bail|exclude_unless:TuesdayRoleOne,Off,Sick,Holiday',
            'TuesdayFinishOne' => 'bail|exclude_unless:TuesdayRoleOne,Off,Sick,Holiday',
            'TuesdayRoleOne' => 'required',
            'TuesdayStartTwo' => 'bail|exclude_unless:TuesdayRoleTwo,Off,Sick,Holiday',
            'TuesdayFinishTwo' => 'bail|exclude_unless:TuesdayRoleTwo,Off,Sick,Holiday',
            'TuesdayRoleTwo' => 'required',
            'WednesdayStartOne' => 'bail|exclude_unless:WednesdayRoleOne,Off,Sick,Holiday',
            'WednesdayFinishOne' => 'bail|exclude_unless:WednesdayRoleOne,Off,Sick,Holiday',
            'WednesdayRoleOne' => 'required',
            'WednesdayStartTwo' => 'bail|exclude_unless:WednesdayRoleTwo,Off,Sick,Holiday',
            'WednesdayFinishTwo' => 'bail|exclude_unless:WednesdayRoleTwo,Off,Sick,Holiday',
            'WednesdayRoleTwo' => 'required',
            'ThursdayStartOne' => 'bail|exclude_unless:ThursdayRoleOne,Off,Sick,Holiday',
            'ThursdayFinishOne' => 'bail|exclude_unless:ThursdayRoleOne,Off,Sick,Holiday',
            'ThursdayRoleOne' => 'required',
            'ThursdayStartTwo' => 'bail|exclude_unless:ThursdayRoleTwo,Off,Sick,Holiday',
            'ThursdayFinishTwo' => 'bail|exclude_unless:ThursdayRoleTwo,Off,Sick,Holiday',
            'ThursdayRoleTwo' => 'required',
            'FridayStartOne' => 'bail|exclude_unless:FridayRoleOne,Off,Sick,Holiday',
            'FridayFinishOne' => 'bail|exclude_unless:FridayRoleOne,Off,Sick,Holiday',
            'FridayRoleOne' => 'required',
            'FridayStartTwo' => 'bail|exclude_unless:FridayRoleTwo,Off,Sick,Holiday',
            'FridayFinishTwo' => 'bail|exclude_unless:FridayRoleTwo,Off,Sick,Holiday',
            'FridayRoleTwo' => 'required',
            'SaturdayStartOne' => 'bail|exclude_unless:SaturdayRoleOne,Off,Sick,Holiday',
            'SaturdayFinishOne' => 'bail|exclude_unless:SaturdayRoleOne,Off,Sick,Holiday',
            'SaturdayRoleOne' => 'required',
            'SaturdayStartTwo' => 'bail|exclude_unless:SaturdayRoleTwo,Off,Sick,Holiday',
            'SaturdayFinishTwo' => 'bail|exclude_unless:SaturdayRoleTwo,Off,Sick,Holiday',
            'SaturdayRoleTwo' => 'required',
            'SundayStartOne' => 'bail|exclude_unless:SundayRoleOne,Off,Sick,Holiday',
            'SundayFinishOne' => 'bail|exclude_unless:SundayRoleOne,Off,Sick,Holiday',
            'SundayRoleOne' => 'required',
            'SundayStartTwo' => 'bail|exclude_unless:SundayRoleTwo,Off,Sick,Holiday',
            'SundayFinishTwo' => 'bail|exclude_unless:SundayRoleTwo,Off,Sick,Holiday',
            'SundayRoleTwo' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = [
            'Staff_Id' => $request->input('staffid'),
            'weekcommencing' => $request->input('WeekCommencing'),
            'hotel_id' => $request->input('hotel'),
            'sickdays' => $request->input('sickDays'),
            'holidaydays' => $request->input('holidays'),
        ];
        $th = 0;

        foreach ($days as $day) {
            $input[strtolower($day) . 'roleone'] = $request->input($day . 'RoleOne');
            $input[strtolower($day) . 'roletwo'] = $request->input($day . 'RoleTwo');
            if ($request->input($day . 'RoleOne') == "1" || $request->input($day . 'RoleOne') == "8" || $request->input($day . 'RoleOne') == "9") {
                $input[strtolower($day) . 'startone'] = Null;
                $input[strtolower($day) . 'finishone'] = Null;
                $input[strtolower($day) . 'hoursone'] = 0;
            } else {
                $input[strtolower($day) . 'startone'] = $request->input($day . 'StartOne');
                $input[strtolower($day) . 'finishone'] = $request->input($day . 'FinishOne');
                $input[strtolower($day) . 'hoursone'] = is_null($request->input($day . 'FinishOne')) && is_null($request->input($day . 'StartOne')) ? 0 : Carbon::parse($request->input($day . 'FinishOne'))->floatDiffInHours(Carbon::parse($request->input($day . 'StartOne')));
            }
            if ($request->input($day . 'RoleTwo') == "1" || $request->input($day . 'RoleTwo') == "8" || $request->input($day . 'RoleTwo') == "9") {
                $input[strtolower($day) . 'starttwo'] = Null;
                $input[strtolower($day) . 'finishtwo'] = Null;
                $input[strtolower($day) . 'hourstwo'] = 0;
            } else {
                $input[strtolower($day) . 'starttwo'] = $request->input($day . 'StartTwo');
                $input[strtolower($day) . 'finishtwo'] = $request->input($day . 'FinishTwo');
                $input[strtolower($day) . 'hourstwo'] = is_null($request->input($day . 'FinishTwo')) && is_null($request->input($day . 'StartTwo')) ? 0 : Carbon::parse($request->input($day . 'FinishTwo'))->floatDiffInHours(Carbon::parse($request->input($day . 'StartTwo')));
            }
            $th = $th + (floatval($input[strtolower($day) . 'hoursone']) + floatval($input[strtolower($day) . 'hourstwo']));

        }


        $input['totalhours'] = $th;

        //dd($input);
        $newId = Rota::create($input)->id;
        $request->session()->flash('message', 'Rota was Created... ');
        $request->session()->flash('text-class', 'text-success');
        return redirect()->route('rota.index', $request->input('hotel'));
    }

    public function edit($rota)
    {
        $data = [];
        $data['Thisrota'] = Rota::whereId($rota)->first();

        $data['staffs'] = Staff::find(Rota::whereId($rota)->select('staff_id')->first()); // Locates the Information on the Staff Member
        $data['hotels'] = Hotel::all(); // Returns the list of Hotels
        $data['DaysOfWeek'] = General::ArrayDayNames(); // Returns an array with Days of the Week
        $data['IsAMonday'] = General::FindMeAMonday(Carbon::now()); // Find a Monday from Last Week

        $data['AvailableDates'] = [];

        // Fills the Array with 5 weeks worth of Mondays
        for ($i = 0; $i <= 4; $i++) {
            $data['AvailableDates'] = Arr::add($data['AvailableDates'], $i, Carbon::parse($data['IsAMonday'])->format('Y-m-d'));
            $data['IsAMonday'] = Carbon::parse($data['IsAMonday'])->addWeek();
        }

        $data['placements'] = Placement::all(); // Returns the list of Placements

        //dd($data);

        return view('admin.rota.edit', $data);

    }

    public function update(Request $request, Rota $rota)
    {

        $days = General::ArrayDayNames();

        $validator = Validator::make($request->all(), [
            'staffid' => 'required|numeric',
            'hotel' => 'required',
            'MondayStartOne' => 'bail|exclude_unless:MondayRoleOne,Off,Sick,Holiday',
            'MondayFinishOne' => 'bail|exclude_unless:MondayRoleOne,Off,Sick,Holiday',
            'MondayRoleOne' => 'required',
            'MondayStartTwo' => 'bail|exclude_unless:MondayRoleTwo,Off,Sick,Holiday',
            'MondayFinishTwo' => 'bail|exclude_unless:MondayRoleTwo,Off,Sick,Holiday',
            'MondayRoleTwo' => 'required',
            'TuesdayStartOne' => 'bail|exclude_unless:TuesdayRoleOne,Off,Sick,Holiday',
            'TuesdayFinishOne' => 'bail|exclude_unless:TuesdayRoleOne,Off,Sick,Holiday',
            'TuesdayRoleOne' => 'required',
            'TuesdayStartTwo' => 'bail|exclude_unless:TuesdayRoleTwo,Off,Sick,Holiday',
            'TuesdayFinishTwo' => 'bail|exclude_unless:TuesdayRoleTwo,Off,Sick,Holiday',
            'TuesdayRoleTwo' => 'required',
            'WednesdayStartOne' => 'bail|exclude_unless:WednesdayRoleOne,Off,Sick,Holiday',
            'WednesdayFinishOne' => 'bail|exclude_unless:WednesdayRoleOne,Off,Sick,Holiday',
            'WednesdayRoleOne' => 'required',
            'WednesdayStartTwo' => 'bail|exclude_unless:WednesdayRoleTwo,Off,Sick,Holiday',
            'WednesdayFinishTwo' => 'bail|exclude_unless:WednesdayRoleTwo,Off,Sick,Holiday',
            'WednesdayRoleTwo' => 'required',
            'ThursdayStartOne' => 'bail|exclude_unless:ThursdayRoleOne,Off,Sick,Holiday',
            'ThursdayFinishOne' => 'bail|exclude_unless:ThursdayRoleOne,Off,Sick,Holiday',
            'ThursdayRoleOne' => 'required',
            'ThursdayStartTwo' => 'bail|exclude_unless:ThursdayRoleTwo,Off,Sick,Holiday',
            'ThursdayFinishTwo' => 'bail|exclude_unless:ThursdayRoleTwo,Off,Sick,Holiday',
            'ThursdayRoleTwo' => 'required',
            'FridayStartOne' => 'bail|exclude_unless:FridayRoleOne,Off,Sick,Holiday',
            'FridayFinishOne' => 'bail|exclude_unless:FridayRoleOne,Off,Sick,Holiday',
            'FridayRoleOne' => 'required',
            'FridayStartTwo' => 'bail|exclude_unless:FridayRoleTwo,Off,Sick,Holiday',
            'FridayFinishTwo' => 'bail|exclude_unless:FridayRoleTwo,Off,Sick,Holiday',
            'FridayRoleTwo' => 'required',
            'SaturdayStartOne' => 'bail|exclude_unless:SaturdayRoleOne,Off,Sick,Holiday',
            'SaturdayFinishOne' => 'bail|exclude_unless:SaturdayRoleOne,Off,Sick,Holiday',
            'SaturdayRoleOne' => 'required',
            'SaturdayStartTwo' => 'bail|exclude_unless:SaturdayRoleTwo,Off,Sick,Holiday',
            'SaturdayFinishTwo' => 'bail|exclude_unless:SaturdayRoleTwo,Off,Sick,Holiday',
            'SaturdayRoleTwo' => 'required',
            'SundayStartOne' => 'bail|exclude_unless:SundayRoleOne,Off,Sick,Holiday',
            'SundayFinishOne' => 'bail|exclude_unless:SundayRoleOne,Off,Sick,Holiday',
            'SundayRoleOne' => 'required',
            'SundayStartTwo' => 'bail|exclude_unless:SundayRoleTwo,Off,Sick,Holiday',
            'SundayFinishTwo' => 'bail|exclude_unless:SundayRoleTwo,Off,Sick,Holiday',
            'SundayRoleTwo' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = [
            'Staff_Id' => $request->input('staffid'),
            'weekcommencing' => $request->input('WeekCommencing'),
            'hotel_id' => $request->input('hotel'),
            'sickdays' => $request->input('sickDays'),
            'holidaydays' => $request->input('holidays'),
        ];
        $th = 0;

        foreach ($days as $day) {
            $input[strtolower($day) . 'roleone'] = $request->input($day . 'RoleOne');
            $input[strtolower($day) . 'roletwo'] = $request->input($day . 'RoleTwo');
            if ($request->input($day . 'RoleOne') == "1" || $request->input($day . 'RoleOne') == "8" || $request->input($day . 'RoleOne') == "9") {
                $input[strtolower($day) . 'startone'] = Null;
                $input[strtolower($day) . 'finishone'] = Null;
                $input[strtolower($day) . 'hoursone'] = 0;
            } else {
                $input[strtolower($day) . 'startone'] = $request->input($day . 'StartOne');
                $input[strtolower($day) . 'finishone'] = $request->input($day . 'FinishOne');
                $input[strtolower($day) . 'hoursone'] = is_null($request->input($day . 'FinishOne')) && is_null($request->input($day . 'StartOne')) ? 0 : Carbon::parse($request->input($day . 'FinishOne'))->floatDiffInHours(Carbon::parse($request->input($day . 'StartOne')));
            }
            if ($request->input($day . 'RoleTwo') == "1" || $request->input($day . 'RoleTwo') == "8" || $request->input($day . 'RoleTwo') == "9") {
                $input[strtolower($day) . 'starttwo'] = Null;
                $input[strtolower($day) . 'finishtwo'] = Null;
                $input[strtolower($day) . 'hourstwo'] = 0;
            } else {
                $input[strtolower($day) . 'starttwo'] = $request->input($day . 'StartTwo');
                $input[strtolower($day) . 'finishtwo'] = $request->input($day . 'FinishTwo');
                $input[strtolower($day) . 'hourstwo'] = is_null($request->input($day . 'FinishTwo')) && is_null($request->input($day . 'StartTwo')) ? 0 : Carbon::parse($request->input($day . 'FinishTwo'))->floatDiffInHours(Carbon::parse($request->input($day . 'StartTwo')));
            }
            $th = $th + (floatval($input[strtolower($day) . 'hoursone']) + floatval($input[strtolower($day) . 'hourstwo']));

        }


        $input['totalhours'] = $th;

        $staffname = Staff::whereId($request->input('staffid'))->value('forename');


        $rota->whereId($rota->id)->update($input);
        $request->session()->flash('message', 'Rota for ' . $staffname . ' on ' . $request->input('WeekCommencing') . ' Updated.');
        $request->session()->flash('text-class', 'text-success');
        return redirect()->route('rota.index', $request->input('hotel'));
    }


    public function destroy(Request $request, Rota $rota)
    {
        // Delete Hotel
        $rota->delete();
        $request->session()->flash('message', 'Removed from Rota.');
        $request->session()->flash('text-class', 'text-danger');
        return back();

    }

    public function clone($rota, Request $request)
    {
        $data = [];
        $data['oldRota'] = Rota::find($rota);
        $data['oldweek'] = $data['oldRota']->value('weekcommencing');
        $data['newRota'] = $data['oldRota']->replicate();
        $data['newRota']->weekcommencing = Carbon::parse($data['oldweek'])->addWeek();
        $data['newRota']->save();

        $request->session()->flash('message', 'Cloned Rota for Next Week.');
        $request->session()->flash('text-class', 'text-success');
return back();

    }
}
