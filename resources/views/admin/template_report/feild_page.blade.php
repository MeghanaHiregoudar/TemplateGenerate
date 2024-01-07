
@extends('admin/layout')

@section('container')
<div class="row">
    <div class="col-6 offset-4">
        <h1 class="text-primary"> Field List</h1>
    </div>
    <div class="col-md-6 offset-md-3">
        <!-- Data Inserted notification -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{session('success')}}</strong> 
            </div>
        @endif
    </div>
</div>
<hr>
<div class="col-md-12 grid-margin stretch-card d-block mx-auto" >
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.feild_data')}}" method="post">
                @csrf
                <div class="card-content mt-5">
                    <div class="row small-spacing">
                        <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="panel panel-default" style="padding:0px 20px;">
                                    <div>
                                        <input type="hidden" name="letter_type_id" id="letter_type_id" value="{{$letter_type->id}}">
                                        <input type="hidden" name="template_report_id" id="template_report_id" value="{{$template_report_id}}">
                                    </div>
                                    <div class="row" style="margin-bottom:20px;"> 
                                        @foreach($feilds_list as $my)
                                        <?php
                                            if($my->field_type == 'date') {
                                                $set_class = "field_class";
                                                $place_holder = "dd-mm-yyyy";
                                            }
                                            else
                                            {
                                                $set_class = '';
                                                $place_holder = '';
                                            }
                                        ?>
                                            <div class="col-md-4">
                                                <label>{{$my->field_name}}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="{{$my->field_type}}" name="{{$my->short_name}}"  class="form-control mb-3 {{$set_class}}" placeholder="Enter {{$my->field_name}} {{$place_holder}}" required/>
                                            </div>
                                        @endforeach 
                                    </div>
                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection