<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    //
    public function index(){
        $data = [];
        $data['audits'] = User::find(1)->audits;
        $data['hotels'] = Hotel::find(2)->audits;
        //dd($data['audits']);
        return view('audit.index', $data);
    }
}
