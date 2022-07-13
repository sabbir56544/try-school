@extends('layouts.admin')
@section('title', 'Main Categories')
@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2><strong>Category</strong> Create </h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('main-category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" placeholder="Category Name" id="name"
                                    name="name" name="Please enter exhibition title">
                                @if ($errors->has('name'))
                                    <span id="title_error" style="color: red">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            
                           
                            <div class="form-group form-float">
                                <label>Image</label>
                                <input type="file" name="image" id="image" data-max-file-size="700K"
                                    data-height="200">
                                <small>Image size must be 825px X 366px</small><br>
                                @if ($errors->has('image'))
                                    <span id="image_error" style="color: red">{{ $errors->first('image') }}</span>
                                @endif
                            </div>

							<div class="form-group form-float">
                                <label>Icon</label>
                                <input type="file" name="icon" id="icon" data-max-file-size="700K"
                                    data-height="200">
                                <small>Image size must be 825px X 366px</small><br>
                                @if ($errors->has('icon'))
                                    <span id="image_error" style="color: red">{{ $errors->first('icon') }}</span>
                                @endif
                            </div>
                            <button type="submit" name="action_button" id="action_button"
                                class="btn btn-primary waves-effect">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2><strong>Category</strong> List </h2>
                    </div>
                    <div class="card-body">
                        <div class="body">
                            <div class="table-responsive">
                                <table id="exhibition_table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th style="text-align: left;" width="20%">Category</th>
                                            <th width="15%">Slug</th>
                                            <th width="15%">Image</th>
                                            
											<th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach($category as $c)
										<tr>
											<td>{{ $c->id }}</td>
											<td>{{ $c->name }}</td>
											<td>{{ $c->slug }}</td>
											<td>
												<img src="{{ url('uploads/images/category', $c->image)}}" style="width: 60px" height="50px">
											</td>
											
											<td>
												<a href="{{ route('main-category.edit', $c->id) }}" class="btn btn-primary btn-sm">Edit</a>
												<form action="{{ route('main-category.destroy', $c->id) }}" method="POST" style="display: inline-block;">
													@csrf
													@method('DELETE')
													<button class="btn btn-danger btn-sm" type="submit">Delete</button>
												</form>
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

    <!-- Dropify -->
    <script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#image').dropify();

        $('#exhibition_table').DataTable();

        $("#name").on('keyup blur', function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $("#slug").val(Text);
        });

        $('#name').keyup(function(e) {
            if ($(this).val() != '') {
                $('#title_error').html('');
                $('#slug_error').html('');
            }
        });

        $('#slug').keyup(function(e) {
            if ($(this).val() != '') {
                $('#slug_error').html('');
            }
        });

        var medium_id;

        $(document).on('click', '.delete', function() {
            medium_id = $(this).attr('id');
            $('#confirm_modal').modal('show');
        });
    </script>
@endsection
