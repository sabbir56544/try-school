@extends('layouts.admin')
@section('title')
    {!! $exhibitor->name !!}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{!! $exhibitor->name !!}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($exhibitor->group == 1)
                        Group-A
                        @elseif($exhibitor->group == 2)
                        Group-B
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{ url('uploads/images', $exhibitor->image) }}" style="width: 100%">
                            </div>
                            <div class="col-lg-8">
                                <h2>{!! $exhibitor->name !!}</h2>
                                <p>Phone: {!! $exhibitor->phone !!}</p>
                                <p>Email: {!! $exhibitor->email !!}</p>
                                <p>Country: {!! $exhibitor->country['name'] !!}</p>
                                <p>Date of Birth: {!! $exhibitor->b_date !!}-{!! $exhibitor->b_month !!}-{!! $exhibitor->b_year !!}</p>
                                <p>Age: {{ (\Carbon\Carbon::now()->year) -  $exhibitor->b_year}} years</p>
                                <hr>
                                <p>Institution: {!! $exhibitor->school !!}</p>
                                <p>Artwork name: {!! $exhibitor->art_name !!}</p>
                                <p>Media: {!! $exhibitor->media !!}</p>
                                <p>Size: {!! $exhibitor->size !!}</p>
                                <p>Year: {!! $exhibitor->year !!}</p>
                                <p>Download pdf: <a href="{{ route('exhibition.pdf', $exhibitor->id )}}" target="_blank"> Download</a></p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.col-lg-1 -->
            @if($exhibitor->artwork != null)
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Artwork
                    </div>
                    <div class="panel-body text-center">
                        <img src="{{ url('uploads/images', $exhibitor->artwork) }}" style="max-height: 350px; border: 10px solid black; padding: 10px"></center>
                    </div>
                </div>
            </div>
            @endif
            @if($exhibitor->link != null)
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Link
                    </div>
                    <div class="panel-body">
                        <a href="{!! $exhibitor->link!!}" target="_blank">{!! $exhibitor->link !!}</a>
                    </div>
                </div>
            </div>
            @endif
            <!-- /.col-lg-1 -->

        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@section('script')

@endsection

@endsection
