<?php

namespace App\Http\Controllers\Admin;
use App\Exports\UsersExport;
use App\Exports\KindersExport;
use Chumper\Zipper\Facades\Zipper;
use Excel;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Account;
use App\Kid;
use App\Child;
use App\Kinder;
use Hash;
use Response;
use Redirect;
use App\CsvList;
use \DateTime;
use Carbon\Carbon;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{
    public function index(){
       
        $ziplists=CsvList::paginate(10);
        return view('csv.list',compact('ziplists'));
    }
    public function choose_date(){
        return view('csv.choose_date');
    }
    public function post_choose_date(Request $request){
        $validatedData = $request->validate([
            'FromDate' => 'required|date',
            'ToDate' => 'required|date|after_or_equal:FromDate',
        ]);
        $request->session()->put('csvlist', $validatedData);
        
        return redirect('/choose-kindergarten');
    }
    public function chooseKindergarten(Request $request){
       
        $all = $request->session()->get('csvlist');
        $from_date=Carbon::parse($all['FromDate'])->timestamp;
        $to_date=Carbon::parse($all['ToDate'])->timestamp;
        $kinders = Kinder::whereBetween('created_at', [$from_date,$to_date])->get();

        return view('csv.choose-kindergarten',compact('kinders'));
    }

    public function export(Request $request) 
    {
       //remove all files in storage/app folder
        $files = glob(public_path('csv\*'));
            foreach($files as $file){
                \File::delete($file);
            }
        //end remove csv file
        $all = $request->session()->get('csvlist');
        $from_date=$all['FromDate'];
        $to_date=$all['ToDate'];
        $kinders=[];
        $rows = [];
        $files=[];
        $kinder_ids=$request->kinder_ids;
        foreach($kinder_ids as $kinderid){
            $kindergarten=Kinder::find($kinderid);
            $kids = Child::where("kinder_id",$kinderid)->get(['name','gender','birthday','account_id','updated_at'])->toArray();
            if(isset($kids) && !empty($kids)){
                foreach($kids as $kid){
                    $kidarray=[]; 
                    $kid_name=$kid['name'];
                    //test male & female
                    if($kid['gender']==1){
                        $kid_gender="Male";
                    }else{
                            $kid_gender="Female";
                        }
                    //end
                    $kid_birthday=$kid['birthday'];
                    $school_linked_date=$kid['updated_at'];
                    $parent_account_id=$kid['account_id'];
                    $parent=Account::where("id",$kid['account_id'])->first();
                    array_push ($kidarray,$parent_account_id,$parent->name,$parent->email,$parent->prefecture,$parent->created_at,$kid_name,$kid_gender,$kid_birthday,$school_linked_date);
                    $rows[] = array_values($kidarray); 
                                
                }
                            
                    $file_data = new KindersExport($rows);
            
            }else{
                    $file_data = new KindersExport($rows);

                }
                    
                array_unshift($rows,array());
                    
                $filename=$kindergarten->name."_".$from_date. "_" .$to_date .".csv";
                $dest=public_path('csv/'.$filename);
                Excel::store($file_data, $filename);

            //copy to public folder
                $filepath = storage_path('app/'.$filename);
                if(File::exists($filepath)){
                copy($filepath,$dest); 
                \File::delete($filepath);
                }
            //end
        }
        
        //Zip create and store in database
        $files = glob(public_path('csv/*'));
        $zipfile_path=public_path('zip/園連携履歴_'.$from_date.'_'.$to_date.'.zip');
        if(File::exists($zipfile_path)){
            Zipper::make('zip/園連携履歴_'.$from_date.'_'.$to_date.'.zip')->add($files);
            //store in DB
            $zip=new CsvList();
            $zip_id=CsvList::where('filename','園連携履歴_2018-03-08_2019-01-04.zip')->pluck('id');
            $update_data=CsvList::find($zip_id[0]);
            $update_data->update();
            //end store in DB 
        }else{
            Zipper::make(public_path('zip/園連携履歴_'.$from_date.'_'.$to_date.'.zip'))->add($files);
            //store in DB
            $zip=new CsvList();
            $zip->filename='園連携履歴_'.$from_date.'_'.$to_date.'.zip';
            $zip->save();
            //end store in DB 
        }
         
        return redirect("/zipfilelist");
        
    }

  public function downloadZip($filename){
    $zipfile_path=public_path('zip/'.$filename);
    if (File::exists($zipfile_path)) {
        return Response::download(public_path('zip/'.$filename));
    } else {
        return ['status'=>'zip file does not exist'];
    }
   
  }

  public function removeFile($id,$filename){
     
    if(\File::exists(public_path('download/'.$filename))){
       
        $id=CsvList::find($id);
        $id->delete();
        \File::delete(public_path('download/'.$filename));
       
    
      }else{
    
        dd('File does not exists.');
    
      }
      return Redirect::back()->with('success',"You delete successfully");
  }


    public function store(Request $request){
       $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users',
            'role'=>'required',
            'password'=>'required|same:confirm-password',
            'confirm-password'=>'required'
       ]);

       $user=new User();
       $user->name=$request->name;
       $user->email=$request->email;
       $user->user_role=$request->role;
       $user->password=Hash::make($request->password);
       $user->save();
       Mail::to($user->email)->send(
        new SendMailable($user)
        );

       
    }

    public function getUser($id){
        $user=User::find($id);

        return view('admin.user',compact('user'));
    }
    public function updateUser(Request $request,$id){
        $request->validate([
            //  'name'=>'required|min:3',
             'email'=>'required|email|unique:users,email,' . $id
            //  'role'=>'required',
        ]);
 
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->user_role=$request->role;
        $user->isActive=$request->isActive;
        $user->password=Hash::make($request->password);
        $user->save();
        
     }
    
}
