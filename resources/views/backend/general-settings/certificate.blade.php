@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Certificate') }}</h5>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('general-setting.certificate') }}">{{ __('Certificate') }}</a></li>
            </ol>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Certificate Section') }} <a
                            href="{{ route('general-setting.certificate-show') }}" class="btn btn-primary btn-small btn-rounded"
                            target="_blank">{{ __('View Design') }}</a></h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('general-setting.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @include('includes.admin.form-both')
                        @csrf
                        <div class="form-group">
                            <label class="d-flex justify-content-center">{{ __('Certificate Background') }}</label>
                            <div class="wrapper-image-preview">
                                <div class="box full-width">
                                    <div class="back-preview-image-certificate"
                                        style="background-image: url({{ asset('assets/images/certificate.jpg') }});">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center" id="set-picture">
                            <label>{{ __('Set Signature') }} <small
                                    class="small-font">({{ __('Preferred Size 176 X 42') }})</small></label>
                            <div class="wrapper-image-preview d-flex justify-content-center">
                                <div class="box">
                                    <div class="back-preview-image"
                                        style="background-image: url({{ $gs->cert_sign ? asset('assets/images/' . $gs->cert_sign) : asset('assets/images/placeholder.jpg') }});">
                                    </div>
                                    <div class="upload-options">
                                        <label class="img-upload-label" for="img-upload"> <i class="fas fa-camera"></i>
                                            {{ __('Upload Picture') }} </label>
                                        <input id="img-upload" type="file" class="image-upload" name="cert_sign"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p class="text-center">
                                {{ __('Use the BB codes, it show the data dynamically in your certificate.') }}</p>
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Meaning') }}</th>
                                        <th>{{ __('BB Code') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ __('Student Name') }}</td>
                                        <td>{student_name}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Admin Name') }}</td>
                                        <td>{admin_name}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Course Title') }}</td>
                                        <td>{course_title}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Website Title') }}</td>
                                        <td>{website_title}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group text-center">
                            <label for="cert_text">{{ __('Certificate Text') }}</label>
                            <textarea name="cert_text" class="form-control" id="cert_text" cols="30" rows="5">{{ $gs->cert_text }}</textarea>
                        </div>

                        <button type="submit" id="submit-btn"
                            class="btn btn-primary btn-block">{{ __('Submit') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
