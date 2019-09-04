<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Prospect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isActive');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->user_role==='admin'){
            $unassigned_prospects=Prospect::where('assigned', 0)->get();
            return view('admin.index',compact('unassigned_prospects'));
        }elseif(Auth::user()->user_role==='user'){
            $user=Auth::user();
            $assigned_leads=Prospect::where('assigned',Auth::id())->get();
            return view('user.index',compact('user','assigned_leads'));
        }

        return view('home');
    }
}
