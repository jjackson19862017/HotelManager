<?php

namespace App\Http\Controllers;

use App\Models\Audit;
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


        //$data['usersCreated'] = Audit::whereEvent('created')->whereAuditableType('App\Models\User')->get();
        //$data['usersUpdated'] = Audit::whereEvent('updated')->whereAuditableType('App\Models\User')->get();
        //$data['usersDeleted'] = Audit::whereEvent('deleted')->whereAuditableType('App\Models\User')->get();




        //dd($data);
        return view('audit.index', $data);
    }
}
