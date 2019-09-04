<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


    }
    public function register(Request $request){
        $input=$request->all();
        $validator=$this->validator($input);

        if($validator->passes()){
            $user=$this->create($input)->toArray(); 
            $user['link']=str_random(30);
            DB::table('users_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);
            Mail::send('mail.activation',$user, function($message) use($user){
                $message->to($user['email']);
                $message->subject('scqq.blogspot.com - Activation code');
            
            }); 

            return redirect()->to('login')->with('success','We  send activation code. Please check your email');
        }
    }

    public function userActivation($token){
        $check=DB::table('users_activations')->where('token',$token)->first();
        if(! is_null($check)){
            $user=User::find($check->id_user);
            if($user->is_activate == 1){
                return redirect()->to('login')->with('success',"User is already actived");

            }
            $user->update(['is_activate'=>1]);
            DB::table('users_activations')->where('token',$token)->delete();
            return redirect()->to('login')->with('success',"user active succcessfully");
        }

        return redirect()->to('login')->with('warning',"your token is invalid");
    } 

}
