@extends('layouts.admin')
@section('title', 'Edit Student')
@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2><strong>Student</strong> Update </h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
                            <div class="form-group form-float">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name" id="first_name"
                                    name="first_name" value="{{$student->first_name}}">
                                @if ($errors->has('first_name'))
                                    <span id="title_error" style="color: red">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group form-float">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" id="last_name"
                                    name="last_name" value="{{$student->last_name}}">
                                @if ($errors->has('last_name'))
                                    <span id="title_error" style="color: red">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group form-float">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" placeholder="Email" id="email"
                                    name="email" value="{{$student->email}}">
                                @if ($errors->has('email'))
                                    <span id="title_error" style="color: red">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            
                           
                            <div class="form-group form-float mt-2">
                                <label>Image</label>
                                <input type="file" name="image" id="image" data-max-file-size="700K"
                                    data-height="200">
                                <small>Image size must be 825px X 366px</small><br>
                                @if ($errors->has('image'))
                                    <span id="image_error" style="color: red">{{ $errors->first('image') }}</span>
                                @endif
								<div>
									<img src="{{$student->image}}" height="4.5rem" width="4.5rem" alt="">
								</div>
                            </div>

						
                            <button type="submit" name="action_button" id="action_button"
                                class="btn btn-primary waves-effect">Save</button>
                        </form>
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
