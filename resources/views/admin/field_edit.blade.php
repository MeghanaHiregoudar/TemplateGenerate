@extends('admin/layout')

@section('container')

<div class="row">
<div class="col-6">
<h1 class="text-primary">Template Field</h1>
</div>
<div class="col-6">
<a  href="{{route('admin.field')}}" class="btn btn-primary float-right mb-2">
Back
</a>
</div>
</div>
<hr>
<div class="card">
      <div class="card-body">
        <h2 class=" text-primary text-center">Edit Template Field</h2>
              
              <form class="pt-4" action="{{route('admin.field_update',$shor->id)}}" method="post" id="edit_template" enctype="multipart/form-data">
              {{method_field('patch')}}
              @csrf
              
              <input type="hidden"  id="hidden_id" name="hidden_id" value="{{$shor->id}}">
                <div class="form-group">
                   <label for="field">Name</label>
                   <input type="text" name="field_name" id="field_name" class="form-control" value="{{ $shor->field_name }} " placeholder="Name">
                   <span id="error_field" style="color: red;"></span>
                </div>
                <div class="form-group">
                   <label for="field_name">Select Type</label>
                   <select name="field_type" id="field_type" class="form-control"  ">
                     <option value="{{ $shor->field_type }}">{{ $shor->field_type }} </option>
                     <option value="text">Text</option>
                     <option value="email">Email</option>
                     <option value="date">Date</option>
                     <option value="number">Number</option>
                     <option value="text-area">Text Area</option>
                     <option value="checkbox">Check Box</option>
                     <option value="radio">Radio</option>
                   </select>
                   <span id="error_field_name" style="color: red;"></span>
                </div>
                <div class="mt-3">
                 <button type="submit" id="tamplate_update_btn" class="btn btn-primary d-block mx-auto">Update</button>
            </div>
              </form>
            </div>
            </div>

@endsection