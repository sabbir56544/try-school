@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Participant's Category</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add new category
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('category.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Participant's Category</label>
                                    <input class="form-control" name="title" id="title" required>
                                    @if ($errors->has('title'))
                                        <span style="color: red">{{ $errors->first('title') }}</span>
                                    @else
                                        <p class="help-block">Enter the participant's category here.</p>
                                    @endif

                                </div>
                                <button type="submit" class="btn btn-default">Save</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Category list
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{!! $count++ !!}</td>
                                                <td>{!! $category->title !!}</td>
                                                <td>
                                                    <form class="delete"
                                                        action="{{ route('category.destroy', $category->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('category.edit', $category->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-danger" type="submit"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
@section('script')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('back/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
    <script>
        $(".delete").on("submit", function() {
            return confirm("Are you sure?");
        });
    </script>
@endsection
