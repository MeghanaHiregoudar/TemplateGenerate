@extends('admin/layout')

@section('container')
<div class="row">
    <div class="col-6 offset-4">
        <h1 class="text-primary"> Template Type</h1>
    </div>
    <div class="col-md-6 offset-md-3">
        <!-- Data Inserted notification -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{session('error')}}</strong> 
            </div>
        @endif
    </div>
</div>
<hr>
<div class="col-md-12 grid-margin stretch-card d-block mx-auto" >
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.store_template_type')}}" method="post" id="letter_template_form">
                @csrf
                <div class="card-content mt-5">
                    <div class="row small-spacing">
                        <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="panel panel-default" style="padding:0px 20px;">
                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-4">
                                            <label>Select Template</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="letter_type_id" id="letter_type_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($letter_types as $letter_type)
                                                    <option value="{{$letter_type->id}}">{{$letter_type->letter_type}}</option>
                                                @endforeach
                                            </select>
                                            @error('letter_type_id')
                                                <span id="error_letter_type" style="color: red;">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-4"><label>Email</label></div>
                                        <div class="col-md-8">
                                            <input type="email" name="email" id="email" class="form-control"  placeholder="Enter Email"/>
                                            @error('email')
                                                <span id="error_email" style="color: red;">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-6">
                                            <button type="submit" id="letter_template_btn" class="btn btn-primary">Submit</button>
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