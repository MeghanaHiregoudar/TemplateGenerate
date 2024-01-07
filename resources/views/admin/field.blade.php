@extends('admin/layout')

@section('container')

<div class="row">
<div class="col-6">
<h1 class="text-primary">Template Field List</h1>
</div>
<div class="col-6">
<a  href="manage_field" class="btn btn-primary float-right mb-2">
Add Template Field
</a>
</div>
</div>
<hr>
<div class="card">
      <div class="card-body">
        <h2 class=" text-primary text-center">Template Field Table</h2>
        <div class="table-responsive pt-3">
          <input type="hidden" value="{{route('admin.field_list')}}" id="field_list_url">
          <table class="table table-bordered" id="field_list" data-delete_url="{{route('admin.field_delete')}}">
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>Field name</th>
                <th>Field Type</th>
                <th>Short Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
           
            </tbody>
            
          </table>
        </div>
      </div>
    </div>

      
@endsection