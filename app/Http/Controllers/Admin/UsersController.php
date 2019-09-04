<?php

namespace App\Http\Controllers\Admin;
use App\Exports\UsersExport;
use App\Exports\KindersExport;
use Zipper;
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
    public function create_step1(){
        return view('csv.show');
    }
    public function post_step1(Request $request){
        $validatedData = $request->validate([
            'FromDate' => 'required',
            'ToDate' => 'required',
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
        $all = $request->session()->get('csvlist');
        $from_date=$all['FromDate'];
        $to_date=$all['ToDate'];
        //remove all files in storage/app folder
        $files = glob(storage_path('app/*'));
            foreach($files as $file){
                \File::delete($file);
            }
        //
        $kinders=[];
        $rows = [];
        $files=[];
        $kinder_ids=$request->kinder_ids;
        //When selected kindergarten is one
        if(count($kinder_ids)==1){
               $kinderid=$kinder_ids[0];
               $kindergarten=Kinder::find($kinderid);
                $kids = Child::where("kinder_id",$kinderid)->get(['name','gender','birthday','account_id'])->toArray();
                dd($kids);
                    
                    if(isset($kids) && !empty($kids)){
                        
                        foreach($kids as $kid){
                            $parent=Account::where("id",$kid['account_id'])->first();
                            array_push ($kid,$parent->name,$parent->prefecture,$parent->email);
                            $rows[] = array_values($kid); 
                                
                        }
                            
                        $file_data = new KindersExport($rows);
                        
                    }
                    else{
                            $file_data = new KindersExport($rows);
                    }
                    array_unshift($rows,array('Name','Gender','Birthday','Account_id','Parent Name','Parent Prefecture','Parent Email'));
                    $filename=$kindergarten->name."_".$from_date. "_" .$to_date .".csv";
                    Excel::store($file_data, $filename);
                    
            
        
               
        }//end
        //When selected kindergarten is multiple
        else{
            foreach($kinder_ids as $kinderid){
                $kindergarten=Kinder::find($kinderid);
                $kids = Child::where("kinder_id",$kinderid)->get(['name','gender','birthday','account_id'])->toArray();
                    
                    if(isset($kids) && !empty($kids)){
                        
                        foreach($kids as $kid){
                            $parent=Account::where("id",$kid['account_id'])->first();
                            array_push ($kid,$parent->name,$parent->email,$parent->prefecture,$parent->created_at);
                            $rows[] = array_values($kid); 
                                
                        }
                            
                        $file_data = new KindersExport($rows);
                        
                    }
                    else{
                            $file_data = new KindersExport($rows);
                    }
                    array_unshift($rows,array('Child Name','Child Gender','Child Birthday','Parent Account_id','Parent Name','Parent Email','Parent Prefecture','Parent Registered Date'));
                    $filename=$kindergarten->name."_".$from_date. "_" .$to_date .".csv";
                    Excel::store($file_data, $filename);
                    
            }
        }
        //Zip create and store in database
        $zip=new CsvList();
        $kinders=Kinder::all();
        $files = glob(storage_path('app/*'));
        Zipper::make('download/園連携履歴_'.$from_date.'_'.$to_date.'.zip')->add($files);
        $zipfiles = glob('download/園連携履歴_'.$from_date.'_'.$to_date.'.zip');
        $zip->filename='download/園連携履歴_'.$from_date.'_'.$to_date.'.zip';
        $zip->save();
        //end  Zip create and store in database  
         return redirect("/zipfilelist");
        
    }

    public function zipAttachment(Request $request){
       
       
        $files = glob(storage_path('app/*'));
      
       
      Zipper::make('download/園連携履歴_1272019_1282019.zip')->add($files);
      $zipfiles = glob('download/園連携履歴_1272019_1282019.zip');
      $zip->kinder_id=$kinder_id;
      $zip->filename=$zipfiles[0];
      $zip->save();
      
    //  return view('csv.show',compact('zipfiles','kinders'));
  }

  public function downloadZip($filename){
        Zipper::download(public_path($filename));
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
