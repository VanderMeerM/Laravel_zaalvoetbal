<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class StatisticController extends Controller
{
     public function index()
    {
      

  // return view('statistic.index', compact('userData', 'months'));
      return view('statistic.index');
    }

}
