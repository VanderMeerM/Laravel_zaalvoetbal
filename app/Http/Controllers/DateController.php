<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Date;

use Illuminate\Http\Request;

class DateController extends Controller
{

     public function index()
    {

        $dates= Date::all();

        return view('dates.index', [
       'dates' => $dates
        ]);
    }

 public function create()
    {     
    return to_route('create_date');
    }

}
