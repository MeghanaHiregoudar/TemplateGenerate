<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>print</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('admin_assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_assets/vendors/base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('admin_assets/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('admin_assets/images/favicon.png')}}" />
  <style>
  
    #printArea {
        margin-left: 0.75in;
        margin-right:0.70in;
    }
    
    @media print { 
         /* All your print styles go here */
        /*#header, #footer, #nav { display: none !important; } */
        #printArea {
           margin-left: 0.75in !important;
        }
    }
    
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3 "></div>
            <div class="col-md-6 ">
                <p class="text-primary text-center mb-0" style="font-size: 30px; font-family: "Times New Roman", Times, serif;"> Print Template </p>
                <button class="btn btn-md float-right mt-0 mr-5"  > <a id="print"  href="javascript:;" ><i class="mdi mdi-printer"> </i> </a> </button>
                <button class="btn btn-md float-left"  > <a  href="{{route('admin.report_type')}}" class="float-left" ><i class="mdi mdi-arrow-left-bold-circle"> </i> </a> </button>
            </div>
            <div class="col-md-3 "></div>
        </div>
        <hr>
        <div id="printArea" class="mt-3" media="print">
            <?php 
                $newBody = $template_report->letter_body;
            ?>  
            {!! $newBody !!}
        </div> 
    </div>
 

  <!-- plugins:js -->
  <script src="{{asset('admin_assets/js/jquery-3.6.0.min.js')}}"></script>
  
  <script src="{{asset('admin_assets/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  
  <script>
     
    $("#print").click(function(e){
        var entirecontents = $("body").html();
        var printcontents  =  $("#printArea").html();
        $("body").html(printcontents);
        window.print();
        $("body").html(entirecontents);
    });
  </script>
</body>

</html>



