@extends('admin/layout')

@section('container')
<div class="row">
    <div class="col-6 offset-4">
        <h1 class="text-primary"> Template Report </h1>
    </div>
    <div class="col-md-6 offset-md-3">
        <!-- Data Inserted notification -->
        @if(session('message'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{session('message')}}</strong> 
            </div>
        @endif
    </div>
</div>
<hr>
<div class="col-md-12 grid-margin stretch-card d-block mx-auto" >
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.view_report')}}" id="template_report_form" method="POST" data-refresh_url="{{route('admin.report_type')}}">
                @csrf
                <div class="card-content mt-5">
                    <div class="row small-spacing">
                        <div class="col-md-10 offset-md-2">
                            <div class="row" style="margin-bottom:20px;"> 
                                <div class="col-md-5">
                                    <label>Start Date</label>
                                    <input type="text" name="from_date" id="from_date" class="form-control " placeholder="dd-mm-yyyy" >
                                </div>
                                        
                                <div class="col-md-5">
                                    <label>End Date</label>
                                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                            <span class="text-danger" id="date_error" ></span>
                            <div class="row mt-3" style="margin-bottom:20px;">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6 offset-md-5">
<img src="{{asset('loaderImg/loader.gif')}}" alt="loader" width="50px" class="d-none" id="loader_img">
</div>
<div class="card" id="table_card">
    <div class="card-body">
        <h2 class=" text-primary text-center">Template Field Table</h2>
        <div class="table-responsive pt-3">
            
            <table class="table table-bordered"  id="report_list" data-report_edit="report_edit" data-report_email="{{route('admin.report_email')}}"  data-delete_report="{{route('admin.delete_report')}}">
                <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Field Type</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal  for Edit Email Id-->
<div class="modal fade" id="report_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="EditReportModalBody">
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="SubmitEditForm">Update Changes</button>
      </div>
    </div>
  </div>
</div>


@endsection