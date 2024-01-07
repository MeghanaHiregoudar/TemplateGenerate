@extends('admin/layout')

@section('container')

<div class="row">
    <div class="col-6">
        <h1 class="text-primary">Template</h1>
    </div>
    <div class="col-6">
        <a  href="{{route('admin.letter_types')}}" class="btn btn-primary float-right mb-2">
            Back
        </a>
    </div>
</div>
<hr>
<div class="col-md-12 grid-margin stretch-card d-block mx-auto" >
    <div class="card">
        <div class="card-header">
            <h2 class=" text-center text-primary">Create New Template</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.letter_types_store')}}" method="post" id="letter_type_add">
                @csrf
                <div class="card-content mt-5">
                    <div class="row small-spacing">
                        <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="panel panel-default" style="padding:0px 20px;">

                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-4"><label>Template Name</label></div>
                                        <div class="col-md-8">
                                            <input type="text" name="letter_type" id="letter_type" class="form-control" placeholder="Enter Template Name"/>
                                            <span id="error_letter_type" style="color: red;"></span>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-4">
                                            <label>Select Fields</label>
                                        </div>
                                        <div class="col-xs-8">
                                            <div class="checkbok ml-3">
                                                <input type="checkbox" class="mb-3" id="select_all" > Select All
                                                @foreach($fields_list as $field_list)
                                                <div>
                                                    <label style="margin-bottom:10px;">
                                                        <input type="checkbox" name="field_id[]" class="field_ckeckbox" id="field_id" value="{{ $field_list->id}}"> {{$field_list->field_name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                                <span id="error_field_id" style="color: red;"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-6">
                                            <button type="submit" id="letter_type_btn" class="btn btn-primary">Submit</button>
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