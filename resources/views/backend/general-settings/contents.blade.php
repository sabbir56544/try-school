@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Website Contents') }}</h5>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('general-setting.contents') }}">{{ __('Website Contents') }}</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Website Contents Form') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('general-setting.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @include('includes.admin.form-both')
                        @csrf
                        <div class="form-group">
                            <label for="inp-title">{{ __('Use HTTPS') }}</label>
                            <div class="frm-btn btn-group mb-1">
                                <button type="button"
                                    class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_secure == 1 ? 'success' : 'danger' }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $gs->is_secure == 1 ? __('Activated') : __('Deactivated') }}
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1"
                                        data-val="{{ __('Activated') }}"
                                        data-href="{{ route('general-setting.status', ['is_secure', 1]) }}">{{ __('Activate') }}</a>
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0"
                                        data-val="{{ __('Deactivated') }}"
                                        data-href="{{ route('general-setting.status', ['is_secure', 0]) }}">{{ __('Deactivate') }}</a>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inp-title">{{ __('Disqus') }}</label>
                            <div class="frm-btn btn-group mb-1">
                                <button type="button"
                                    class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_disqus == 1 ? 'success' : 'danger' }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $gs->is_disqus == 1 ? __('Activated') : __('Deactivated') }}
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1"
                                        data-val="{{ __('Activated') }}"
                                        data-href="{{ route('general-setting.status', ['is_disqus', 1]) }}">{{ __('Activate') }}</a>
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0"
                                        data-val="{{ __('Deactivated') }}"
                                        data-href="{{ route('general-setting.status', ['is_disqus', 0]) }}">{{ __('Deactivate') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inp-title">{{ __('Captcha') }}</label>
                            <div class="frm-btn btn-group mb-1">
                                <button type="button"
                                    class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_captcha == 1 ? 'success' : 'danger' }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $gs->is_captcha == 1 ? __('Activated') : __('Deactivated') }}
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1"
                                        data-val="{{ __('Activated') }}"
                                        data-href="{{ route('general-setting.status', ['is_captcha', 1]) }}">{{ __('Activate') }}</a>
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0"
                                        data-val="{{ __('Deactivated') }}"
                                        data-href="{{ route('general-setting.status', ['is_captcha', 0]) }}">{{ __('Deactivate') }}</a>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inp-title">{{ __('Login Email Verification') }}</label>
                            <div class="frm-btn btn-group mb-1">
                                <button type="button"
                                    class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_verification_email == 1 ? 'success' : 'danger' }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $gs->is_verification_email == 1 ? __('Activated') : __('Deactivated') }}
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1"
                                        data-val="{{ __('Activated') }}"
                                        data-href="{{ route('general-setting.status', ['is_verification_email', 1]) }}">{{ __('Activate') }}</a>
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0"
                                        data-val="{{ __('Deactivated') }}"
                                        data-href="{{ route('general-setting.status', ['is_verification_email', 0]) }}">{{ __('Deactivate') }}</a>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inp-title">{{ __('Youtube Api') }}</label>
                            <div class="frm-btn btn-group mb-1">
                                <button type="button"
                                    class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_youtube_api == 1 ? 'success' : 'danger' }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $gs->is_youtube_api == 1 ? __('Activated') : __('Deactivated') }}
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1"
                                        data-val="{{ __('Activated') }}"
                                        data-href="{{ route('general-setting.status', ['is_youtube_api', 1]) }}">{{ __('Activate') }}</a>
                                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0"
                                        data-val="{{ __('Deactivated') }}"
                                        data-href="{{ route('general-setting.status', ['is_youtube_api', 0]) }}">{{ __('Deactivate') }}</a>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inp-title">{{ __('Website Title') }}</label>
                            <input type="text" class="form-control" id="inp-title" name="title"
                                placeholder="{{ __('Enter Website Title') }}" value="{{ $gs->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="cp3">{{ __('Website Color') }}</label>
                            <div class="cp-container" id="cp3-container">
                                <div class="input-group" title="Using input value">
                                    <input id="cp3" type="text" name="colors" class="form-control"
                                        value="{{ $gs->colors }}" autocomplete="off" />
                                    <div class="input-group-append">
                                        <button type="button"
                                            class="btn btn-primary colorpicker-input-addon"><i></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="youtube-api">{{ __('Youtube Api Key') }}</label>
                            <textarea name="youtube_api_key" class="form-control" id="youtube-api" cols="30" rows="5">{{ $gs->youtube_api_key }}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="copyright-text">{{ __('Copyright Text') }}</label>
                            <textarea name="copyright" class="summernote" id="copyright-text" cols="30" rows="10">{{ $gs->copyright }}</textarea>
                        </div>


                        <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
