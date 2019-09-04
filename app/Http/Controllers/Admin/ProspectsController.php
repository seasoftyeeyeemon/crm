<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prospect;
use App\User;

class ProspectsController extends Controller
{
    public function index(){
        // $users=User::all();
        // $prospects=Prospect::paginate(10);
        // return view('admin.prospects',compact('prospects','users'));

       
        $db_ext = \DB::connection('mysql_external');
        $posts = $db_ext->table('posts')->get();
        
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users',
            'phone1'=>'required|min:11|max:11',
            'phone2'=>'required|min:11|max:11',
            'address'=>'required',
            'note'=>'required'

        ]);

        $prospect=new Prospect();
        $prospect->name=$request->name;
        $prospect->email=$request->email;
        $prospect->phone1=$request->phone1;
        $prospect->phone2=$request->phone2;
        $prospect->address=$request->address;
        $prospect->city=$request->city;
        $prospect->note=$request->note;
        $prospect->prospect_message=$request->prospect_message;
        $prospect->assigned=$request->assigned;
        
        $prospect->save();

        return redirect()->route('admin.prospects',$prospect->id);
    }
}
