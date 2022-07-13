@extends('layouts.front')
@section('title', $title)
@section('content')
    <main class="auctions-page mt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="left-content">
                    <h3 class="heading border-bottom mb-30 font-bold">Current Exhibitions</h3>

                    @if(count($exhibitions)>0)
                    @foreach($exhibitions as $exhibition)
                    <div class="auction-item pb-30 border-bottom mb-15">
                        <a href="#">
                            <div class="img">
                                <img class="img-fluid w-100" src="{{ url('upload/images', $exhibition->image) }}" alt="auction img">
                                <div class="img-overlay flex center-center">
                                    <div class="overlay-content">
                                        <h6>{{ $exhibition->title }}</h6>
                                        <div class="countdown show" data-Date='{{ $exhibition->end }}'>

                                            <div class="running">
                                                <timer>
                                                    <span class="days"></span>:<span class="hours"></span>:<span class="minutes"></span>:<span
                                                    class="seconds"></span>
                                                </timer>
                                                <div class="break"></div>
                                                <div class="labels"><span>Days</span><span>Hours</span><span>Minutes</span><span>Seconds</span>
                                                </div>

                                            </div>

                                            <div class="ended">
                                                <div class="text">Registration is ended</div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="text-area flex left-center mt-15">
                            <div class="text">
                                <h6 class="mb-0 text-uppercase">{{ $exhibition->title }}</h6>
                                <span>Exhibition will be publish on <strong>{{ date('d F, Y', strtotime($exhibition->end)) }}</strong></span>
                            </div>
                            <a href="{{ route('exhibition.apply', $exhibition->id)}}" class="black-btn ml-auto">Apply now</a>
                        </div>
                    </div>

                    @endforeach
                    @else
                    <div class="auction-item pb-30 border-bottom mb-15">
                        Currently No exhibition is running
                    </div>
                    @endif




                </div>
                <div class="past-auction mt-30 pb-30">
                    <h4 class="border-bottom mb-30 pb-15">Past Exhibitions</h4>
                    <ul>
                        @foreach($end_exhibitions as $end)
                        <li>
                            <a href="{{ route('exhibitor.index', $end->slug)}}" class="flex left-center">
                                <span>{{ $end->title }}</span>
                                <span class="ml-auto">{{ date('d F, Y', strtotime($end->end)) }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</main>


@endsection

@section('script')
<script src="{{ asset('frontend/js/multi-countdown.js') }}"></script>

@endsection
@endsection
