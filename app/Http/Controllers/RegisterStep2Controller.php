<?php

namespace App\Http\Controllers;
use App\Country;
use Illuminate\Http\Request;

class RegisterStep2Controller extends Controller
{
    public function construct(){
        $this->middleware('auth');
    }
    public function showForm(){
        $countries=Country::all();
        return view('auth.register_step2',compact('countries'));
    }

    public function postForm(Request $request){
        dd(auth()->user);
        // auth()->user()->update($request->only(['country_id','biography']));
    }
}
