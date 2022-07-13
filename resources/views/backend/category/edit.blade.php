@extends('layouts.admin')
@section('title', 'Edit Category')
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
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
                        <div class="panel-body mt-3">

                            <form role="form" action="{{ route('main-category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="mt-2">Category Name</label>
                                    <input class="form-control" name="name"  id="name"
                                        value="{!! $category->name !!}">
                                    @if ($errors->has('name'))
                                        <span style="color: red">{{ $errors->first('name') }}</span>
                                    @else
                                       
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label class="mt-2">Category Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @if ($errors->has('image'))
                                        <span style="color: red">{{ $errors->first('image') }}</span>
                                    @else
                                       
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="mt-2">Category Icon</label>
                                    <input type="file" name="icon" id="icon" class="form-control">
                                    @if ($errors->has('icon'))
                                        <span style="color: red">{{ $errors->first('icon') }}</span>
                                    @else
                                       
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
