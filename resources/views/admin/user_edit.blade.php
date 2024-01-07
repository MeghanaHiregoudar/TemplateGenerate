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
                  <h2 class=" text-center text-primary">Edit User</h2>
                 
                  <form action="{{route('admin.user_update')}}" method="post"  id="update_user_form" class="forms-sample ">
                  {{method_field('patch')}}
                  @csrf 
                  <input type="hidden" name="id" value="{{$shor->id}}">
                  <!--<input type="hidden" name="id" value="{{--\Crypt::encrypt($shor->id)--}}">-->
                  <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                  <label for="field">First Name</label>
                  <input type="text" name="first_name" class="form-control form-control-lg alphabets" id="first_name" placeholder="First Name" value="{{$shor->first_name}}" >
                  <span id="error_first_name" style="color: red;"></span>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="field">Last Name</label>
                  <input type="text" name="last_name" class="form-control form-control-lg alphabets" id="last_name" placeholder="Last Name" value="{{$shor->last_name}}" >
                  <span id="error_last_name" style="color: red;"></span>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="field">Mobile </label>
                  <input type="text" name="mobile" class="form-control form-control-lg only_number" id="mobile" placeholder="Mobile Number" maxlength="10" value="{{$shor->mobile}}" >
                  <span id="error_mobile" style="color: red;"></span>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="field">Email </label>
                  <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email-id" value="{{$shor->email}}" >
                  <span id="error_email" style="color: red;"></span>
                </div>
                </div>

               <!-- <div class="col-md-6">
                <div class="form-group">
                <label for="field">Password </label>
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password" value="{{$shor->password}}" >
                  <span id="error_password" style="color: red;"></span>
                </div>
                </div>-->

                <!--<div class="col-md-6">-->
                <!--<div class="form-group">-->
                <!--<label for="field">Re_Password</label>-->
                <!--  <input type="password" name="re_password" class="form-control form-control-lg" id="re_password" placeholder="Re-enter Password" value="{{$shor->re_password}}" >-->
                <!--  <span id="error_re_password" style="color: red;"></span>-->
                <!--  <span id="error_match_password" style="color: red;"></span>-->
                <!--</div> -->
                <!--</div>-->



                <div class="col-md-12">
                   <div class="form-group">
                <label for="field">Select Roles</label>
                <select name="roles" id="roles" class="form-control"  > 
                    
                    <option value="1">admin</option>
                   <option value="2">user</option>     
              </select>
              
                </div>   
                </div>
                
                 <div class="col-md-12 text-center">
                   <input type="submit" class="btn btn-primary mr-2" id="user_update_btn" value="Update User">
                   </div>
                   
                    </div>
                  </form>
                </div>
              </div>
            </div>

           
            @endsection

          

           