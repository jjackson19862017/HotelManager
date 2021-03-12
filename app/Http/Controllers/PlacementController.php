<?php

namespace App\Http\Controllers;

use App\Libraries\General;
use App\Models\Placement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlacementController extends Controller
{
    //
    public function index()
    {
        $data = [];
        $data['placements'] = Placement::all();
        return view('admin.placement.index', $data);
    }

    public function create()
    {
        $data = [];
        $data['Colours'] = General::getEnumValues('placements','colour');
        return view('admin.placement.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required']
        ]);
        // Takes the name input and creates the slug input all in lowercase and changes the spaces for -'s
        Placement::create([
            'name' => Str::ucfirst(request('name')),
            'short' => Str::upper(request('short')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
            'colour' => request('colour'),
        ]);
        $request->session()->flash('message', 'Placement Created: ' . $request->name);
        $request->session()->flash('text-class', 'text-success');

        return redirect()->route('placement.index');
    }

    public function edit(Placement $placement)
    {
        $data = [];
        $data['placement'] = $placement;
        $data['Colours'] = General::getEnumValues('placements','colour');

        return view('admin.placement.edit', $data);
    }

    public function update(Request $request, Placement $placement)
    {
        $placement->name = Str::ucfirst(request('name'));
        $placement->short = Str::upper(request('short'));
        $placement->slug = Str::of(request('name'))->slug('-');
        $placement->colour = request('colour');


        if ($placement->isDirty()) { // info If something has changed in the form.
            $request->session()->flash('message', 'Placement Updated: ' . $placement->name);
            $request->session()->flash('text-class', 'text-success');
            $placement->save();
        } else {
            $request->session()->flash('message', 'Nothing to Update...');
            $request->session()->flash('text-class', 'text-warning');
        }

        return redirect()->route('placement.index');
    }

    public function destroy(Request $request, Placement $placement)
    {
        // Delete Position
        $placement->delete();
        $request->session()->flash('message', 'Placement was Deleted...');
        $request->session()->flash('text-class', 'text-danger');
        return redirect()->route('placement.index');
    }
}
