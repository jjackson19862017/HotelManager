<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\Position;
use Illuminate\Support\Str;

class PositionController extends Controller
{
    //
    public function index()
    {
        $data = [];
        $data['positions'] = position::all(); // Returns all the data from the Position Table
        return view('admin.position.index', $data);
    }

    public function create()
    {
        return view('admin.position.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name'=> ['required']
        ]);

        // Takes the name input and creates the slug input all in lowercase and changes the spaces for -'s
        position::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug('-'),
            'icon'=> request('icon')
        ]);

        $request->session()->flash('message', 'Created: ' . request('name'));
        return back();
    }

    public function edit(position $position)
    {
        $data = [];
        $data['position'] = $position;
        $data['staffs'] = Staff::all();
        return view('admin.position.edit', $data);
    }

    public function update(Request $request, position $position)
    {
        // Takes the name input and creates the slug input all in lowercase and changes the spaces for -'s
        $position->name = Str::ucfirst(request('name'));
        $position->slug = Str::of(request('name'))->slug('-');
        $position->icon = request('icon');

        // If the name input has been changed then the name will be updated else do nothing.
        if($position->isDirty('name')){ // info If something has changed in the form.
            $request->session()->flash('message', 'Updated: ' . $position->name);
            $request->session()->flash('text-class', 'text-success');

            $position->save();
        } else {
            $request->session()->flash('message', 'Nothing to Update...');
            $request->session()->flash('text-class', 'text-warning');
        }

        return redirect()->route('position.index');
    }

    public function staff_attach(position $position)
    {
        $position->staffs()->attach(request('staff'));
        return back();
    }

    public function staff_detach(position $position)
    {
        $position->staffs()->detach(request('staff'));
        return back();
    }

    public function destroy(Request $request, position $position){
        // Delete Position
        $position->delete();
        $request->session()->flash('message', 'Position was Deleted...');
        $request->session()->flash('text-class', 'text-danger');
        return back();
    }
}
