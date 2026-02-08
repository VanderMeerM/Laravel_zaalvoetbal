<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
     public function index()
    {

        $users = User::all()->toArray(); // [0=> 'Piet', 1 => 'Jan', 2=> 'Klaas'];
        
        /*select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->pluck('count')
            ->toArray();*/

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $userData = array_fill(0, 12, 0); // Initialize with zeros
       foreach ($users as $user => $count) {
            $userData[$user] = $count; // Fill with actual counts
        }
            

        return view('statistic.index', compact('userData', 'months'));
      //return view('statistic.index');
    }

}
