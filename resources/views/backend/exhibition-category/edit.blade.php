@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Category</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit category
                        </div>
                        <div class="panel-body">

                            <form role="form" action="{{ route('category.update', $category->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Participant's Category</label>
                                    <input class="form-control" name="title" id="title" required
                                        value="{!! $category->title !!}">
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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
