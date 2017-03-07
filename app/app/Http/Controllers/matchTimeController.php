<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\matchTraits;
use App\Http\Traits\weekTraits;


class matchTimeController extends Controller
{
	use matchTraits;
	use weekTraits;


    public function create()
    {
        $userSchedule = Auth::user()->schedule->freetime;	//get authenticated user
        $instructor = User::find(request('instructor'));
		$instrSchedule = $instructor->schedule->freetime;
        // $instrSchedule =  User::where('name', '=', request('instructor'))->first()->schedule->freetime; //getting the instructors free time
        $week = $this->week();
        $availMatch = $this->match($userSchedule, $instrSchedule);
        return view('instructors/choosetime', compact('availMatch', 'week', 'instructor'));
    }
}
