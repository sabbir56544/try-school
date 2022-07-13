@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h2><strong>Art Work</strong> Category List </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="category_table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="10%">Image</th>
                                    <th style="text-align: left;" width="30%">Category</th>
                                    <th width="30%">Slug</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach($categories as $category)
                                
                                <tr>
                                    <td>{!! $count++ !!}</td>
                                    <td>
                                        @if($category->image != null)
                                        <img src="{{ url('uploads/images', $category->image)}}" class="w-100">
                                        @endif
                                    </td>
                                    <td style="text-align: left;">{!! $category->name !!}</td>
                                    <td>{!! $category->slug !!}</td>
                                    <td>
                                        <a href="{{ route('art-categories.edit', $category->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <button type="button" id="{!! $category->id !!}" class="delete btn btn-danger waves-effect waves-float btn-xl waves-red"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="confirm_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="loader-popup" style="display: none;">
                <img src="{{ url('backend/images/loader.gif') }}">
            </div>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('backend.partials.datatable.js')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#category_table').DataTable();

    var medium_id;

    $(document).on('click', '.delete', function() {
        medium_id = $(this).attr('id');
        $('#confirm_modal').modal('show');
    });

</script>
@endsection