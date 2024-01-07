<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  

  
 
  <link rel="stylesheet" href="{{asset('admin_assets/css/style.css')}}">
  
  <link rel="shortcut icon" href="{{asset('admin_assets/images/favicon.png')}}" />
  
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{asset('admin_assets/images/logo.svg')}}" alt="logo">
              </div>
              <h4>Let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form action="{{route('admin.auth')}}" id="login_form" method="post" class="pt-3">
              @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="login_email" name="email" placeholder="Email-Id">
                  <span id="error_login_email" style = "color:red;"></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="login_password" name="password" placeholder="Password" >
                  <span id="error_login_password" style = "color:red;"></span>
                </div>
                <div class="mt-3">
                  <button type="submit" id="login_btn" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                </div>
                </form>
                
              <div class="text-danger text-center mt-3 ">
                 <h3 class="error"></h3>
              </div> 
                
                
            
            </div>
          </div>
        </div>
      </div>
       <!--content-wrapper ends -->
    </div>
     <!--page-body-wrapper ends -->
  </div>
  
 
   
    <script src="{{asset('admin_assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/notify.js')}}"></script>
    <script src="{{asset('admin_assets/js/validation.js')}}"></script>

  
  
</body>

</html>
