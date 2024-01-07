<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LetterType;
use App\Models\Field;

use PDF;
use Mail;


class LetterTypeController extends Controller
{
    public function index()
    {
        $data['fields_list'] = Field::where('status','1')->get();
        $data['letter_types'] = LetterType::where('status','1')->get();
        return view('admin.lettertype.letter_type',$data);
    }


    public function manage_letter_types()
    {
        $data['fields_list'] = Field::where('status','1')->get();
        return view('admin.lettertype.create_lettertype',$data);
    }

    public function letter_types_store(Request $request)
    {
        
        $letter_type=new LetterType();
        $letter_type->letter_type = $request->input('letter_type');
        $fields_id = implode(',', $request->input('field_id'));
        $letter_type->field_id =  $fields_id;
        if($letter_type->save())
        {
            return response()->json(['msg_field'=>'Data Insertion Successfull','status'=>'success','redirect'=> route('admin.letter_types')]);
        }
        else
        {
            return response()->json(['msg_field'=>'Problem In Insertion Please Contact To Administator','status'=>'danger']);
        }
    }

    public function letter_types_edit($id)
    {
        $data['fields_list'] = Field::where('status','1')->get();
        $data['letter_types'] = LetterType::find($id);
        return view('admin.lettertype.edit_lettertype',$data);
    }

    public function letter_types_update(Request $request)
    {
        $id = $request->id;
        $letter_type = LetterType::find($id);
        $letter_type->letter_type = $request->input('letter_type');
        $fields_id = implode(',', $request->input('field_id'));
        $letter_type->field_id =  $fields_id;
        if($letter_type->save())
        {
            return response()->json(['msg_field'=>'Data Upadted Successfull','status'=>'success','redirect'=> route('admin.letter_types')]);
        }
        else
        {
            return response()->json(['msg_field'=>'Problem In Insertion Please Contact To Administator','status'=>'danger']);
        }        
    }

    public function letter_types_delete(Request $request)
    {
        $id = $request->input('id');
        $letter_type = LetterType::find($id);
        $letter_type->status = 0;
        if($letter_type->save())
        {
            return response()->json(['msg_field'=>'Data Deleted Successfull','status'=>'success','redirect'=> route('admin.letter_types')]);
        }
        else
        {
            return response()->json(['msg_field'=>'Problem In Insertion Please Contact To Administator','status'=>'danger']);
        }
    }

    public function letter_types_createbody($id)
    {
        $data['fields_list'] = Field::where('status','1')->get();
        $data['letter_types'] = LetterType::find($id);
        return view('admin.lettertype.body_lettertype',$data);
    }

    public function letter_types_storebody(Request $request)
    {
         
        $id = $request->input('id');
        $letter_type = LetterType::find($id);                             
        $letter_type->body = $request->input('letter_content');                            
        $query = $letter_type->save();
        // if($query)
        // {
        //     return response()->json(['msg_field'=>'Template saved Successfull','status'=>'success','redirect'=> route('admin.letter_types')]);
        // }
        // else
        // {
        //     return response()->json(['msg_field'=>'Problem In Insertion Please Contact To Administator','status'=>'danger']);
        // }
        //return redirect()->route('admin.letter_types');
        
    }

    
    public function upload(Request $request)
    {
        if($request->hasFile('upload'))
        {
            $originalName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            
            $request->file('upload')->move(public_path('images'),$fileName);
            
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/images/'.$fileName);
            $msg = "Image Uploaded Successfully";
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url','$msg')</script>";
            
            @header('content-type:text/html; charset=utf-8');
            echo $response;
        }
    }

    

}
