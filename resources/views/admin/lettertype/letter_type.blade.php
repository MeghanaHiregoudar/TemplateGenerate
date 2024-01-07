@extends('admin/layout')

@section('container')
<div class="row">
    <div class="col-6">
        <h1 class="text-primary">Template</h1>
    </div>
    <div class="col-6">
        <a  href="{{route('admin.manage_letter_types')}}" class="btn btn-primary float-right mb-2">
            Add Template
        </a>
    </div>
</div>
<hr>
<div class="card">
    <div class="card-header">
        <h2 class=" text-primary text-center">Template Table</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive pt-3">
            <table class="table table-bordered" id="letter_type_list" data-delete_url="{{route('admin.letter_types_delete')}}">
                <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Template Name</th>
                        <th>Available Fields</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count=0; ?>          
                    @foreach($letter_types as $letter_type)
                        <?php $count++; ?>
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{ $letter_type->letter_type }}</td>
                            <td>
                                <?php 
                                    $fields_id_array = array();
                                    $fields_name = "";
                                
                                    if($letter_type->field_id)
                                    {
                                        $fields_id_array = explode(',',$letter_type->field_id);

                                        for($i = 0; $i < count($fields_id_array); $i++)
                                        {
                                            $field_count = 0;
                                            foreach($fields_list as $field_list)
                                            {
                                                if($field_list->id == $fields_id_array[$i] )
                                                { 
                                                    if($field_count == 0)
                                                    {
                                                        $fields_name = $field_list->field_name;
                                                    }
                                                    else
                                                    {
                                                        $fields_name = $fields_name.', '. $field_list->field_name;
                                                    }
                                                }
                                                $field_count++;
                                            }
                                        }
                                    }
                                ?>
                                {{$fields_name}}
                            </td>
                            <td>
                                <button class="btn btn-xs "> <a style="margin-right:10px;" data-toggle="tooltip" title="Edit" class=" float-left" href="{{route('admin.letter_types_edit', $letter_type->id)}}" ><i class="mdi mdi-table-edit"> </i> </a> </button>
                                <button class="btn btn-xs "> <a style="margin-right:10px;" class=" float-left" data-toggle="tooltip" title="Template Content" href="{{route('admin.letter_types_createbody', $letter_type->id)}}" ><i class="mdi mdi-account-card-details"> </i> </a> </button>
                                <button class="btn btn-xs  "> <a style="margin-right:10px;" data-toggle="tooltip" title="Delete" class=" float-left text-danger" href="javascript:void(0)" id="letter_type_delete" data-delete_id="{{$letter_type->id}}" ><i class="mdi mdi-delete-forever"> </i> </a> </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- End of card-->

@endsection