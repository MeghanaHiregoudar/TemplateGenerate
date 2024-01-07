@extends('admin/layout')

@section('container')

<div class="row">
<div class="col-6">
<h1 class="text-primary">User List</h1>
</div>
<div class="col-6">
<a  href="manage_user" class="btn btn-primary float-right mb-2">
Add User
</a>
</div>
</div>
<hr>
<!-- {{session('message')}} -->
<div class="card">
      <div class="card-body">
        <h2 class=" text-primary text-center">User Table</h2>
        <div class="table-responsive pt-3">
            <input type="hidden" id="user_list_url" value="{{route('admin.users_list')}}" >
          <table class="table table-bordered" id="user_table" data-delete_url="{{route('admin.user_delete')}}">
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>First name</th>
                <th>Last Name</th>
                <th>Mobile</th>
                <th>Email-Id</th>
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