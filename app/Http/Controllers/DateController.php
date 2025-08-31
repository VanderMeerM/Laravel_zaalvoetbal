<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\Matchround;


use Illuminate\Http\Request;

class DateController extends Controller
{

     public function index()
    {

        $dates= Date::all();

        return view('dates.index', compact('dates'));
    }

 public function create()
    {     
    return to_route('create_date');
    }


  public function show($id)
    {

        //$player = Player::select()->where('id', '=', $id)->get();
        $match = Matchround::where('date_id', '=', $id)->get();
       
              return view('/dates.show', ['match' => $match]);
    }
};
       