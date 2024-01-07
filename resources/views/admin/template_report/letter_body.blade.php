@extends('admin/layout')

@section('container')
<div class="row">
    <div class="col-6 offset-4">
        <h1 class="text-primary"> Print Template</h1>
    </div>
</div>
<hr>

<div class="box-content">
    <div class="row small-spacing">                      
        <div class="col-md-12">
            <div class="col-md-10 offset-md-1">
                <div class="row mb-3">
                  <div class="col-md-10"></div>
                    <div class="col-md-2"><a href="{{route('admin.report_pdf',$template_report->id)}}" target="_blank" class="btn btn-success">Preview</a></div>
                </div>
                <div class="alert alert-success text-center" role="alert">
                    Template Content is getting AutoSaved
                </div>
                <div class="card" style="padding:0px 20px;">
                    
                    <div class="card-body">
                        <h3 align="center" style="margin-bottom:10px; margin-top:20px;">Template Content</h3>
                        <hr>
                        <?php 
                           $body = $letter_type->body;
                           $newBody = $body;
                           for ($i=0;$i<count($array_with_value);$i++)
                            {    
                                $newBody = str_replace('['.$array_with_value[$i][0].']',$array_with_value[$i][1],$newBody);  
                            }
                        ?>
                        <input type="hidden" id="refresh_url" value="{{route('admin.report_type')}}">
                        <form  class="form-horizontal" method='POST' id="template_body_form" enctype="multipart/form-data" action="{{route('admin.store_body')}}" >
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="template_report_id" id="template_report_id" value="{{$template_report->id}}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--<label for="inp-type-2" class="col-sm-2 control-label">Job Letter <span class=" text-danger">*</span> </label>-->
                                    <div class="col-sm-12">
                                        <textarea class="form-control"  id ="body_content"  name = "body_content" >
                                            {!! $newBody !!}
                                        </textarea>    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-md-offset-11">
                                <input type ="submit" name="next" value="Save"  class="btn btn-primary btn-xs waves-effect waves-light">
                            </div>
                        </form> 
                    </div>    
                </div>                  
            </div>
        </div>
    </div>       
</div>   
<!--<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>-->
<script src="{{asset('admin_assets/ckeditor/ckeditor.js')}}"></script>
 
<script>
    
//     CKEDITOR.replace('body_content', {
//       // Define the toolbar groups as it is a more accessible solution.
//       toolbarGroups: [
// 		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
// 		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
// 		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
// 		{ name: 'forms', groups: [ 'forms' ] },
// 		'/',
// 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
// 		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
// 		{ name: 'links', groups: [ 'links' ] },
// 		{ name: 'insert', groups: [ 'insert' ] },
// 		'/',
// 		{ name: 'styles', groups: [ 'styles' ] },
// 		{ name: 'colors', groups: [ 'colors' ] },
// 		{ name: 'tools', groups: [ 'tools' ] },
// 		{ name: 'others', groups: [ 'others' ] },
// 		{ name: 'about', groups: [ 'about' ] },
// 	]
// });
    CKEDITOR.replace('body_content',{
        height: 800,
    });
    
    var timer;
    var timeout = 5000; // Timout duration
    CKEDITOR.instances['body_content'].on('key', function ()
    {
        if(timer) {
            clearTimeout(timer);
        }
      timer = setTimeout(autoSave(), timeout); 
    });
    
    // CKEDITOR.instances['body_content'].on('key', function (){
    //     autoSave();
    // });
    
    setInterval(function(){ autoSave(); },5000);
    
    
</script>
@endsection