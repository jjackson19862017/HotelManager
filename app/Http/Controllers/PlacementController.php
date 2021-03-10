<?php

namespace App\Http\Controllers;

use App\Models\Placement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlacementController extends Controller
{
    //
    public function index() {
        $data = [];
        $data['placements'] = Placement::all();
        return view('admin.placement.index', $data);
    }

    public function create() {
        return view('admin.placement.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' =>['required']
        ]);
        // Takes the name input and creates the slug input all in lowercase and changes the spaces for -'s
        Placement::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug('-')
        ]);
        $request->session()->flash('message', 'Placement Created: ' . $request->name);
        $request->session()->flash('text-class', 'text-success');

        return redirect()->route('placement.index');
    }

    public function edit(Placement $placement)
    {
        $data = [];
        $data['placement'] = $placement;
        return view('admin.placement.edit', $data);
    }

    public function update(Request $request, Placement $placement)
    {
        $placement->name = Str::ucfirst(request('name'));
        $placement->slug = Str::of(request('name'))->slug('-');

        if($placement->isDirty('name')){ // info If something has changed in the form.
            $request->session()->flash('message', 'Placement Updated: ' . $placement->name);
            $request->session()->flash('text-class', 'text-success');
            $placement->save();
        } else {
            $request->session()->flash('message', 'Nothing to Update...');
            $request->session()->flash('text-class', 'text-warning');
        }

        return redirect()->route('placement.index');
    }

    public function destroy(Request $request, Placement $placement){
        // Delete Position
        $placement->delete();
        $request->session()->flash('message', 'Placement was Deleted...');
        $request->session()->flash('text-class', 'text-danger');
        return redirect()->route('placement.index');
    }
}
