<?php

namespace App\Http\Controllers;

use App\Models\Eventlocation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function RoomList()
    {
        $RoomList = Eventlocation::select('name');
        return $RoomList;
    }
}
