<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Users;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }

    
    public function auth(Request $request)
    {
       $email=$request->post('email');
       $password=$request->post('password');
        
      $result=Users::where(['email'=>$email])->first();
     
        if($result)
        {
            if(Hash::check($password,$result->password))
            {
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                $request->session()->put('ADMIN_CREATOR',$result->creator);
                $request->session()->put('ADMIN_NAME',$result->first_name.' '. $result->last_name);
                $request->session()->put('ADMIN_ROLES',$result->roles);
                $array = array('code'=>1,'msg'=>'Login Successfull','status'=>'success' ,'redirect'=> route('admin.dashboard'));
            }
            else
            {
                $array = array('code'=>0,'msg'=>'Please Enter Valid Password!!','status'=>'danger' ,'redirect'=> route('login'));
            }
        }
        else
        {  
      
            $array = array('code'=>0,'msg'=>'Please Enter Valid Credentials','status'=>'danger','redirect'=> route('login'));
        }
        echo json_encode($array);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
