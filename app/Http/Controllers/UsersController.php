<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        
        return view('admin/user');
    }

    public function user_list()
    {
        DB::statement(DB::raw('set @rownum=0')); //For serial num
        
        $data = Users::where('status','1')->get(['users.*',
             DB::raw('@rownum  := @rownum  + 1 AS rownum')]); //for autoincrement sl no
        
        return DataTables::of($data)
            ->addcolumn('Action',function($data){                                           
                return '<button class="btn btn-xs " > <a style="margin-right:10px;" id="user_edit" data-toggle="tooltip" title="Edit" class=" float-left" href="'.$data->id.'/user_edit" ><i class="mdi mdi-table-edit"> </i> </a> </button>
                        <button class="btn btn-xs  "> <a style="margin-right:10px;" id="user_delete" data-toggle="tooltip" title="Delete" class=" float-left text-danger" data-id="'.$data->id.'" href="javascript:;"><i class="mdi mdi-delete-forever"> </i> </a> </button>';
                })
            ->removeColumn('id')
            ->rawColumns(['Action'])
            ->make(true);
    }
    

    public function manage_user()
    {
        return view('admin/manage_user');
    }
     
    public function user_store(Request $request)
    {
   
        $short=new Users();
        $short->first_name = $request->input('first_name');
        $short->last_name = $request->input('last_name');
        $short->mobile = $request->input('mobile');
        $short->email = $request->input('email');
        $short->password = Hash::make($request->input('password'));
        $short->creator = $request->input('first_name');
        $short->roles = $request->input('roles');
      
        if($short->save())
        {
            
      	    $array = array('code'=>1,'msg'=>'Data Insertion Successfull','status'=>'success');
      	   
      	    }
      	    else
      	    {
      	    	
               
      	    	$array = array('code'=>0,'msg'=>'Problem In Insertion Please Contact To Administator','status'=>'danger');
      	    	
      	    }

      	   
            
                echo json_encode($array);
    }

    public function user_edit($id)
    {
        
        $shor =users::find($id);
        $role=Roles ::find($id);
        return view('admin/user_edit',compact('shor','role'));
        
    }

    public function user_update(Request $request)
    {

             //$user_id = Crypt::decrypt($request->input('id'));
             
            $user_id = $request->input('id');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $mobile = $request->input('mobile');
            $email = $request->input('email');
            $password = $request->input('password');
            $roles = $request->input('roles');
            
            $query = DB::table('users')->where('id',$user_id)->update(['first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email, 'mobile'=>$mobile,'roles'=>$roles ]);
            if($query)
            
            {
                $array = array('code'=>1,'edit_msg'=>'Data Updated Successfull','status'=>'success','redirect'=> route('admin.users'));
                }
             else
                  {
                  		$array = array('code'=>0,'edit_msg'=>'Problem In Insertion Please Contact To Administator','status'=>'danger');
                  	    	
                }
                            echo json_encode($array);
    }

    public function user_delete(Request $request)
    {
        $id = $request->id;
        $user = Users::find($id);
        $user->status = 0;
        $query = $user->save();
        
        if($query)
        {
            return response()->json(['msg'=>'User Deleted Successfull','status'=>'success','redirect'=> route('admin.users')]);
        }
        else
        {
            return response()->json(['msg'=>'Problem In Insertion Please Contact To Administator','status'=>'danger']);
        }
            
    }
    
}


