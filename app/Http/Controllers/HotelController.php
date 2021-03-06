<?php

namespace App\Http\Controllers;

use App\Models\Eventlocation;
use App\Models\Holidays;
use App\Models\Hotel;
use App\Models\Position;
use App\Models\Role;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    public function index()
    {
        $data = [];
        $data['hotels'] = Hotel::all(); // Returns all the data from the Hotels Table
        return view('admin.hotel.index', $data);
    }

    public function staff(Hotel $hotel)
    {
        $data = [];
        $data['staffs'] = Staff::whereHotelId($hotel->id)->orderBy('employmenttype', 'asc')->orderBy('surname', 'asc')->get(); // Returns all the information back from the Staff Table
        $data['positions'] = Position::all(); // Returns all the information back from the Staff Table
        return view('admin.staff.index', $data);
    }

    public function trashedIndex()
    {
        $data = [];
        $data['hotels'] = Hotel::onlyTrashed()->get(); // Returns all the information back from the Users Table
        return view('admin.hotel.trashed', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'name'=> ['required','string'],
            'telephone'=> ['required','string'],
            'address'=> ['required','string'],
            'town'=> ['required','string'],
            'county'=> ['required','string'],
            'postcode'=> ['required','string'],
            'website'=> ['required','string'],
            'email'=> ['required','string'],
            'numberOfRooms'=> ['required','integer'],
        ]);

        // Takes the name input and creates the slug input all in lowercase and changes the spaces for -'s
        Hotel::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug('-'),
            'telephone'=> request('telephone'),
            'address'=> request('address'),
            'town'=> request('town'),
            'county'=> request('county'),
            'postcode'=> request('postcode'),
            'website'=> request('website'),
            'email'=> request('email'),
            'numberOfRooms'=> request('numberOfRooms'),
            'created_by'=> Auth::user()->id,
        ]);

        Role::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        $manager = request('name') . " Manager";

        Role::create([
            'name'=> Str::ucfirst($manager),
            'slug'=> Str::of(Str::lower($manager))->slug('-'),
        ]);
        $request->session()->flash('message', 'Hotel Created');
        $request->session()->flash('text-class', 'text-success');

        return back();
    }


    public function edit(Hotel $hotel)
    {

        $data = [];
        $data['hotel'] = $hotel;
        $data['els'] = Eventlocation::all();
        return view('admin.hotel.edit', $data);
    }

    public function update(Request $request, Hotel $hotel)
    {
        //$role->id = request('id');
        // Takes the name input and creates the slug input all in lowercase and changes the spaces for -'s
        $inputs = request()->validate([
            'name'=> ['required','string'],
            'telephone'=> ['required','string'],
            'address'=> ['required','string'],
            'town'=> ['required','string'],
            'county'=> ['required','string'],
            'postcode'=> ['required','string'],
            'website'=> ['required','string'],
            'email'=> ['required','string'],
            'numberOfRooms'=> ['required','integer'],
        ]);


        $hotel->update($inputs);
        $request->session()->flash('message', 'Updated: ' . $request->name);
        $request->session()->flash('text-class', 'text-success');

        return redirect()->route('hotel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Hotel $hotel)
    {
        // Delete Hotel
        $hotel->deleted_by = Auth::user()->id;
        $hotel->save();
        $hotel->delete();

        $request->session()->flash('message', 'Deleted: ' . $hotel->name);
        $request->session()->flash('text-class', 'text-danger');
        return redirect()->route('hotel.index');

    }

    public function restoreHotel(Request $request, $hotel)
    {
        // Restore User
        $hotel = Hotel::withTrashed()->find($hotel);
        $hotel->restore();

        $request->session()->flash('message', 'Restored: ' . $hotel->name);
        $request->session()->flash('text-class', 'text-success');
        return redirect()->route('trashed.hotel.index');
    }

    public function eraseHotel(Request $request, $hotel)
    {
        $hotel = Hotel::withTrashed()->find($hotel);
        $hotel->forceDelete();
        $request->session()->flash('message', 'ERASED: ' . $hotel->name);
        $request->session()->flash('text-class', 'text-warning');
        return redirect()->route('trashed.hotel.index');
    }

    public function eventlocation_attach(Hotel $hotel)
    {
        $hotel->eventlocations()->attach(request('el'));
        return back();
    }

    public function eventlocation_detach(Hotel $hotel)
    {
        $hotel->eventlocations()->detach(request('el'));
        return back();
    }

}
