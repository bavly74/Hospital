<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class GroupServiceController extends Controller
{
    public function create(){
        $services = Service::all();
        return view('dashboard.services.group.create',compact('services'));
    }
}
