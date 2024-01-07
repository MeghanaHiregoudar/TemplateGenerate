<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $short = Field::all()->where('status','1');

        return view('admin/field');
    }

    public function field_list()
    {
        DB::statement(DB::raw('set @rownum=0')); //For serial num
        
        $data = Field::where('status','1')->get(['fields.*',
            DB::raw('@rownum  := @rownum  + 1 AS rownum')]);    //for autoincrement sl no    
            
        return DataTables::of($data)
            ->addcolumn('Action',function($data){
                return '<button class="btn btn-xs "> <a style="margin-right:10px;" data-toggle="tooltip" title="Edit" class=" float-left" id="field_edit" href="'.$data->id.'/field_edit" ><i class="mdi mdi-table-edit"> </i> </a> </button>
                <button class="btn btn-xs  "> <a style="margin-right:10px;" data-toggle="tooltip" title="Delete" class=" float-left text-danger" id="field_delete" data-id="'.$data->id.'" href="javascript:;" ><i class="mdi mdi-delete-forever"> </i> </a> </button>';
            })
            ->removeColumn('id')
            ->rawColumns(['Action'])
            ->make(true);
    }

    public function manage_field()
    {
        return view('admin/manage_field');
    }
    
    public function field_store(Request $request)
    {
   
        $short=new Field();
        $short->field_name = $request->input('field_name');
        $short->field_type = $request->input('field_type');
        $smallname = strtolower($request->input('field_name'));
        $short->creator = $request->input('field_name');
        $smallname =str_replace(' ', '_', $smallname);
        $short->short_name = $smallname;
        
        
        if($short->save())
        {

       $array = array('code'=>1,'msg_field'=>'Data Insertion Successfull','status'=>'success');
      	   
        	    }
 	    else
   {
               
     $array = array('code'=>0,'msg_field'=>'Problem In Insertion Please Contact To Administator','status'=>'danger');
      	    }

      	   echo json_encode($array);
    }
    
    public function field_edit($id)
    {
        
        $shor = field::findOrFail($id);
        return view('admin/field_edit',compact('shor'));
        
    }

    public function field_update(Request $request)
    {   
        $id = $request->input('hidden_id');
        $field_name = $request->input('field_name');
        $field_type = $request->input('field_type');
       
        
        $query = DB::table('fields')->where('status', '1')->where('id',$id)->update(['field_name'=>$field_name,'field_type'=>$field_type,'short_name'=>$field_name,]);
        if($query)
        {
            $array = array('code'=>1,'edit_field_msg'=>'Data Updated Successfull','status'=>'success', 'redirect'=> route('admin.field'));
    }
 else
      {
      		$array = array('code'=>0,'edit_field_msg'=>'Problem In Insertion Please Contact To Administator','status'=>'danger');
      	    	
    }
                echo json_encode($array);
    
    }

    public function field_delete(Request $request)
    
         {
             
             
        //  $query = DB::table('fields')->where('id',$id)->update(['status'=>0]);
        $id = $request->id;
        $user = Field::find($id);
        $user->status = 0;
        $query = $user->save();
        
        if($query)
        {
            return response()->json(['msg'=>'User Deleted Successfull','status'=>'success','redirect'=> route('admin.field')]);
        }
        else
        {
            return response()->json(['msg'=>'Problem In Insertion Please Contact To Administator','status'=>'danger']);
        }
      
             
          }

   
}
