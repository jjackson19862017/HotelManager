<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    //
    public function index()
    {
        $data = [];
        $data['customers'] = Customer::select('id','brideforename',
            'bridesurname',
            'groomforename',
            'groomsurname',
            'telephone',
            'email')->get();
        return view('admin.customer.index', $data);
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(Customer $customer, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brideforename' => 'max:255',
            'bridesurname' => 'max:255',
            'groomforename' => 'max:255',
            'groomsurname' => 'max:255',
            'telephone' => 'max:15',
            'email' => 'max:255',
            'address' => 'max:255',
            'towncity' => 'max:255',
            'county' => 'max:255',
            'postcode' => 'max:10',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = [
            'brideforename' => $request->input('brideforename'),
            'bridesurname' => $request->input('bridesurname'),
            'groomforename' => $request->input('groomforename'),
            'groomsurname' => $request->input('groomsurname'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'towncity' => $request->input('towncity'),
            'county' => $request->input('county'),
            'postcode' => $request->input('postcode'),
        ];
//dd($input);
        Customer::create($input);

        $request->session()->flash('message', 'Created new couple.');
        $request->session()->flash('text-class', 'text-success');

        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer)
    {
        $data = [];
        $data['customer'] = $customer;
        //dd($data);
        return view('admin.customer.edit', $data);
    }

    public function update(Customer $customer, Request $request)
    {
        $customer->fill(\request()->all());
        if ($customer->isDirty()) {
            $validator = Validator::make($request->all(), [
                'brideforename' => 'max:255',
                'bridesurname' => 'max:255',
                'groomforename' => 'max:255',
                'groomsurname' => 'max:255',
                'telephone' => 'max:15',
                'email' => 'max:255',
                'address' => 'max:255',
                'towncity' => 'max:255',
                'county' => 'max:255',
                'postcode' => 'max:10',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $input = [
                'brideforename' => $request->input('brideforename'),
                'bridesurname' => $request->input('bridesurname'),
                'groomforename' => $request->input('groomforename'),
                'groomsurname' => $request->input('groomsurname'),
                'telephone' => $request->input('telephone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'towncity' => $request->input('towncity'),
                'county' => $request->input('county'),
                'postcode' => $request->input('postcode'),
            ];


            $customer->update($input);
            $request->session()->flash('message', 'Updated: ' . $customer->couple);
            $request->session()->flash('text-class', 'text-success');
        } else {
            $request->session()->flash('message', 'Nothing to Update...');
            $request->session()->flash('text-class', 'text-warning');
        }

        return redirect()->route('customers.index');
    }
    public function destroy(Request $request, customer $customer){
        // Delete Customer
        $customer->delete();
        $request->session()->flash('message', 'Customer was Deleted...');
        $request->session()->flash('text-class', 'text-danger');
        return redirect()->route('customers.index');

    }
}
