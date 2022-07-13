@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Breadcumb Banner') }}</h5>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('general-setting.breadcrumb') }}">{{ __('Breadcumb Banner') }}</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-lg-6">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Hero Section') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('general-setting.update') }}" method="POST" enctype="multipart/form-data">
                        @include('includes.admin.form-both')
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Set Background Image') }} <small
                                    class="small-font">({{ __('Preferred Size 600 X 600') }})</small></label>
                            <div class="wrapper-image-preview">
                                <div class="box full-width">
                                    <div class="back-preview-image"
                                        style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/' . $gs->breadcrumb_banner) : asset('assets/images/placeholder.jpg') }});">
                                    </div>
                                    <div class="upload-options">
                                        <label class="img-upload-label full-width" for="img-upload"> <i
                                                class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                                        <input id="img-upload" type="file" class="image-upload" name="breadcumb_banner"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="submit-btn"
                            class="btn btn-primary btn-block">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
            <!-- Form Sizing -->
            <!-- Horizontal Form -->
        </div>
    </div>
    <!--Row-->
@endsection
