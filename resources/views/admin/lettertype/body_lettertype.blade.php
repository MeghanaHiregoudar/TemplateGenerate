@extends('admin/layout')

@section('container')
<div class="row">
    <div class="col-1"></div>
    <div class="col-5">
        <h1 class="text-primary ">Template</h1>
    </div>
    <div class="col-5">
        <a  href="{{route('admin.letter_types')}}" class="btn btn-primary float-right mb-2 mr-5">
            Back
        </a>
    </div>
    <div class="col-1"></div>
</div>
<hr>
<div class="alert alert-success text-center" role="alert">
                    Template Content is getting AutoSaved
                </div>
<div class="box-content">
    <div class="row small-spacing">                      
        <div class="col-md-12">
            <div class="col-md-10 offset-md-1">
                <div class="card" style="padding:0px 20px;">
                    <div class="card-body">
                        <h3 align="center" style="margin-bottom:10px; margin-top:20px;">Template Content</h3>
                        <hr>
                        <input type="hidden" id="back_url" value="{{route('admin.letter_types')}}">
                        <form  class="form-horizontal" method='POST' enctype="multipart/form-data" action="{{route('admin.letter_types_storebody')}}" id="letterType_body">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" id="letter_type_id" value="{{$letter_types->id}}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <label for="inp-type-1" class="col-sm-3 control-label"> Name <span class=" text-danger">*</span> </label>
                                        <label>{{$letter_types->letter_type}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-4"> </div>
                                <div class="col-md-8">
                                    <div class="form-group"> 
                                        
                                        <?php 
                                            $fields_id_array = array();
                                            $fields_name = "";
                                        
                                            if($letter_types->field_id)
                                            {
                                                $fields_id_array = explode(',',$letter_types->field_id);

                                                for($i = 0; $i < count($fields_id_array); $i++)
                                                {
                                                    $field_count = 0;

                                                    foreach($fields_list as $field_list)  
                                                    {

                                                        if($field_list->id == $fields_id_array[$i])
                                                        {
                                                            if($field_count==0)
                                                            {
                                                                $fields_name= "<strong class='feilds_name' style='margin-right:10px;'>[".$field_list->field_name."]</strong>";    
                                                            }
                                                            else{
                                                                $fields_name=$fields_name."<strong class='feilds_name' style='margin-right:10px;'>[". $field_list->field_name."]</strong>";
                                                            }
                                                            
                                                        }
                                                        $field_count++;
                                                    }                                           
                                                }
                                            }
                                        echo $fields_name;
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inp-type-2" class="col-sm-4 control-label">Job Letter <span class=" text-danger">*</span> </label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control"   name = "letter_content" id="letter_content" >
                                            {{$letter_types->body}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-md-offset-11">
                                <input type ="submit" value="Save" class="btn btn-primary btn-xs waves-effect waves-light" id="save_btn">
                            </div>
                        </form> 
                    </div>    
                </div>                  
            </div>
        </div>
    </div>       
</div> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- jQuery UI (Drag & Drop) -->
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
<!--<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>-->
<!--ckeditor-->
<script src="{{asset('admin_assets/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('letter_content',{
        height: 800,
        filebrowserUploadUrl:"{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
        filebrowserUploadMethod:'form'
    });
 
    
    var timer;
    var timeout = 5000; // Timout duration
    CKEDITOR.instances['letter_content'].on('key', function ()
    {
        if(timer) {
            clearTimeout(timer);
        }
      timer = setTimeout(save_LetterBody(), timeout); 
    });
    
    // CKEDITOR.instances['body_content'].on('key', function (){
    //     autoSave();
    // });
    
    setInterval(function(){ save_LetterBody(); },5000);
   
</script>


@endsection