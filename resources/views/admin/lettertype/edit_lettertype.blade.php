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
            <h2 class=" text-center text-primary">Edit Template</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.letter_types_update')}}" method="PUT" id="letter_type_update">
                @csrf
                @method('PUT')
                <div class="card-content mt-5">
                    <div class="row small-spacing">
                        <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="panel panel-default" style="padding:0px 20px;">
                                    <input type="hidden" name="id" value="{{$letter_types->id}}">
                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-4"><label>Template Name</label></div>
                                        <div class="col-md-8">
                                            <input type="text" name="letter_type" id="letter_type" class="form-control" value="{{$letter_types->letter_type}}">
                                            <span id="error_letter_type" style="color: red;"></span>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-4">
                                            <label>Select Fields</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="checkbok ml-3">
                                            <?php
                                                $fields = $letter_types->field_id;
                                                $fieldsArray = explode(',',$fields);
                                            ?>
                                                @foreach($fields_list as $field_list)
                                                <div>
                                                    <label style="margin-bottom:10px;">
                                                        <input type="checkbox" name="field_id[]" id="field_id" value="{{ $field_list->id}}"
                                                            @foreach($fieldsArray as $field)
                                                                @if($field == $field_list->id ) checked @endif
                                                            @endforeach
                                                        > {{$field_list->field_name }}
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
                                            <button type="submit" id="letter_type_update_btn" class="btn btn-primary">Update</button>
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