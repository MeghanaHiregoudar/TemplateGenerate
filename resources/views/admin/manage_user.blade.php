@extends('admin/layout')

@section('container')

<div class="row">
<div class="col-6">
<h1 class="text-primary">User</h1>
</div>
<div class="col-6">
<a  href="{{route('admin.users')}}" class="btn btn-primary float-right mb-2">
Back
</a>
</div>
</div>
<hr>

            <div class="col-md-12 grid-margin stretch-card d-block mx-auto" >
              <div class="card">
                <div class="card-body">
                  <h2 class=" text-center text-primary">Add User</h2>
                 
                  <form action="{{route('admin.user_store')}}" method="post" id="create_user_form" class="forms-sample ">
                  @csrf 
                  
                  <div class="row mt-3">
                  <div class="col-md-6">
                  <div class="form-group">
                  <label for="field">First Name</label>
                  <input type="text" name="first_name" class="form-control form-control-lg alphabets" id="first_name" placeholder="First Name" >
                  <span id="error_first_name" style="color: red;"></span>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="field">Last Name</label>
                  <input type="text" name="last_name" class="form-control form-control-lg alphabets" id="last_name" placeholder="Last Name" >
                  <span id="error_last_name" style="color: red;"></span>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="field">Mobile</label>
                  <input type="text" name="mobile" class="form-control form-control-lg only_number" id="mobile" placeholder="Mobile Number" maxlength="10" >
                  <span id="error_mobile" style="color: red;"></span>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                <label for="field">Email</label>
                  <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email-id" >
                  <span id="error_email" style="color: red;"></span>
                </div>
               </div>

               <div class="col-md-6">
                <div class="form-group">
                <label for="field">Password</label>
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password" >
                  <span id="error_password" style="color: red;"></span>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="field">Confirm Password</label>
                  <input type="password" name="re_password" class="form-control form-control-lg" id="re_password" placeholder="Confirm Password" >
                  <span id="error_re_password" style="color: red;"></span>
                  <span id="error_match_password" style="color: red;"></span>
                </div> 
                </div>

                <div class="col-md-12">
                <div class="form-group">
                <label for="field">Select Roles</label>
                <select name="roles" id="roles" class="form-control" value=""  > 
                    <option value="">Select Roles</option> 
                    <option value="1">admin</option>
                   <option value="2">user</option>     
              </select>
              <span id="error_roles" style="color: red;"></span>
                </div>   
                 </div>

                 <div class="col-md-6">
                   <input type="submit" class="btn btn-primary mr-2" id="user_submit_btn" value="Add User">
                   </div>
                   <div class="col-md-6">
                    <button type="reset" class="btn btn-danger float-right">Reset</button>
                    </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

           
            @endsection

          

           