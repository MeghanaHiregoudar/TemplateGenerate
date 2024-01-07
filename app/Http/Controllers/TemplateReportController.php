<?php

namespace App\Http\Controllers;

use App\Models\TemplateReport;
use App\Models\LetterType;
use App\Models\Field;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
use Mail;

class TemplateReportController extends Controller
{
    public function index()
    {
        $data['letter_types'] = LetterType::where('status','1')->get();
        return view('admin.template_report.index',$data);
    }

    public function store_template_type(Request $request)
    {
        $request->validate([
            'letter_type_id' => 'required',
            'email' => 'required|email'
        ]);

        $template_report = new TemplateReport();
        $template_report->letter_type_id = $request->letter_type_id;
        $template_report->email = $request->email;
        $template_report->report_date = date("Y-m-d H:i:s");
        $query = $template_report->save();
        if($query)
        {
            $template_report_id = $template_report->id;

            $letter_type = LetterType::findorfail($request->letter_type_id);
            $fields_ids = $letter_type->field_id;
            $field_array = explode(',',$fields_ids);
    
            $collection = (new Field)->newCollection();
            $fields_list = Field::all();
    
            foreach($fields_list as $feild_list)
            {
                foreach($field_array as $feild)
                {
                    if($feild == $feild_list->id)
                    {
                        $collection->push($feild_list);
                    }
                }
            }

            $data['feilds_list'] = $collection;
            $data['letter_type'] = $letter_type;
            $data['template_report_id'] = $template_report_id;
            return view('admin.template_report.feild_page' ,$data)->with('success','Template Saved Successfull');
            //return view('admin.template_report.feild_page' ,['feilds_list'=>$collection],['letter_type'=>$letter_type],['template_report_id'=>$template_report_id])->with('success','Template Saved Successfull');
        }
        else
        {
            return redirect()->route('admin.report_type')->with('error','Problem In Insertion Please Contact To Administator');  
        }
    }

    public function feild_data(Request $request)
    {
        $letter_type_id = $request->letter_type_id;
        $template_report_id = $request->template_report_id;
        $template_report = TemplateReport::findorfail($template_report_id);
        $letter_type = LetterType::findorfail($letter_type_id);
        $feild_ids = $letter_type->field_id;
        $feild_ids_array = explode(',',$feild_ids);

        $feild_lists = Field::all();
        $array_with_value = array();

        foreach($feild_ids_array as $feild_id_single)
        {
            foreach($feild_lists as $key => $value)
            {
                if($feild_id_single == $value->id )
                {
                    $array_with_value[] = array($value->field_name,$request->input($value->short_name));
                }
            }
        }

        $data['letter_type'] = $letter_type;
        $data['array_with_value'] = $array_with_value;
        $data['template_report'] = $template_report;
        return view('admin.template_report.letter_body',$data);
    }

    public function store_body(Request $request)
    {
        
        $template_report_id = $request->template_report_id;
        $template_report = TemplateReport::find($template_report_id);
        $template_report->letter_body = $request->body_content;
        $query = $template_report->save();
    }
    
    public function preview_print($id)
    {   
        $query = TemplateReport::find($id);
        $data['template_report']=$query; 
        return view('admin.template_report.print_body',$data);
    }
    

    public function report_edit($id)
    {
        $data = TemplateReport:: find($id);

        $html = '<div class="form-group">
                    <input type="hidden" name="id" id="edit_id" value="'.$data->id.'">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="edit_email" value="'.$data->email.'">
                </div>
                <span id="error_edit_email" style="color: red;"></span>';

        return response()->json(['html'=>$html]);

    }

    public function report_update(Request $request)
    {
        $id = $request->id;
        $template_report = TemplateReport::find($id);
        $template_report->email = $request->email;
        $template_report->mail_sent = 0;
        $query = $template_report->save();
        if($query)
        {
            return response()->json(['field_msg'=>'Email Updated Successfull','status'=>'success','redirect'=>route('admin.template_report')]);
        }
        else
        {
            return response()->json(['field_msg'=>'Problem In Insertion Please Contact To Administator','status'=>'danger']);
        }
    }


    //Report Part
    public function template_report()
    {
        return view('admin.template_report.template_report');
    }

    public function view_report(Request $request)
    {
        //echo $request->from_date . "----" . $request->to_date;
        $from_date = date("Y-m-d", strtotime($request->from_date)); //Carbon::parse($request->from_date)->toDateTimeString();
        $to_date = date("Y-m-d", strtotime($request->to_date)); //Carbon::parse($request->to_date)->toDateTimeString();
      
        $query = DB::select("select template_reports.id,template_reports.email,letter_types.letter_type from template_reports JOIN letter_types ON letter_types.id = template_reports.letter_type_id where DATE(report_date) between '$from_date' and '$to_date' ");
        
        $data =array();
			if($query)
			{
				foreach ($query as  $list)
				{
					$data[] = array(
					    "id" => $list->id,
		    	        "email" => $list->email,
		    	        "letter_type" => $list->letter_type,
		    	    );
				}
			}
        echo json_encode($data); 
    }

    public function report_pdf($id)
    {
        $data = TemplateReport::find($id);
        view()->share('report',$data);
        //$pdf = PDF::loadView('admin.template_report.report', $data);
        $pdf = PDF::loadView('admin.template_report.report_pdf');
        $pdf->setPaper('A4');
        return $pdf->stream();
    }

    public function report_email(Request $request)
    {
        $id = $request->id;

        $data['report'] = TemplateReport::find($id);
        $data['letter_type'] = LetterType::find($data['report']->letter_type_id);
        if($data['report']->mail_sent == 0)
        {
            $pdf = PDF::loadView('admin.template_report.report_pdf',$data);

            $candidate['email'] = $data['report']->email;
            $candidate["subject"] = $data['letter_type']->letter_type." From Solutions";
            $candidate["file_name"] = $data['letter_type']->letter_type;
            $data["body"] = "This is Template Generater Mail from Solutions";

            Mail::send('admin.template_report.emailbody', $data, function($message)use($candidate,$pdf) {
                $message->to($candidate['email'])
                ->subject($candidate["subject"])
                ->attachData($pdf->output(), $candidate["file_name"].".pdf");
            });

            if (Mail::failures()) {
                return response()->json(['field_msg'=>'Sorry! Please try again latter','status'=>'danger']);
            }else{
                $data['report']->mail_sent = 1;
                $data['report']->save();
                return response()->json(['field_msg'=>'Great! Successfully sent in your mail','status'=>'success']);
            }
        }
        else
        {
            return response()->json(['field_msg'=>'Alredy Mail Has Been Sent!! Please Contact To Administator To Send Again.','status'=>'danger']);
        }

    }

    public function delete_report(Request $request)
    {
        $id = $request->id;
        $query = TemplateReport::find($id);
        $query->status = 0;
        if($query->save())
        {
            return response()->json(['field_msg'=>'Data Updated Successfull','status'=>'success','redirect'=>route('admin.template_report')]);
        }
        else
        {
            return response()->json(['field_msg'=>'Problem In Insertion Please Contact To Administator','status'=>'danger']);
        }
    }

  

}
