<?php

namespace App\Http\Controllers;

use App\Models\Eventlocation;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventlocationController extends Controller
{
    //
    public function index()
    {
        $data = [];
        $data['eventlocations'] = Eventlocation::all(); // Returns all the data from the Roles Table
        return view('admin.eventlocation.index', $data);
    }


    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required']
        ]);

        // Takes the name input and creates the slug input all in lowercase and changes the spaces for -'s
        Eventlocation::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);

        $request->session()->flash('message', $request->name . ' was created...');
        $request->session()->flash('text-class', 'text-success');

        return back();
    }

    public function edit(Eventlocation $el)
    {
        $data = [];
        $data['eventlocation'] = $el;
        $data['hotels'] = Hotel::all();
        return view('admin.eventlocation.edit', $data);
    }

    public function update(Request $request, Eventlocation $el)
    {
        $el->name = Str::ucfirst(\request('name'));
        $el->slug = Str::of(request('name'))->slug('-');

        if ($el->isDirty('name')) { // info If something has changed in the form.
            $request->session()->flash('message', 'Event Location: ' . $el->name . ' was Updated...');
            $request->session()->flash('text-class', 'text-success');
            $el->save();
        } else {
            $request->session()->flash('message', 'Nothing to Update...');
            $request->session()->flash('text-class', 'text-warning');
        }
        return redirect()->route('eventlocation.index');
    }

    public function destroy(Request $request, Eventlocation $el)
    {
        $el->delete();
        $request->session()->flash('message', $el->name . ' was Deleted...');
        $request->session()->flash('text-class', 'text-danger');
        return back();
    }


}
