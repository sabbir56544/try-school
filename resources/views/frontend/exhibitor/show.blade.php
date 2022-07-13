@extends('layouts.front')
@section('title', $title)
@section('content')
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-md-9">


                <div style="padding: 2px">
                    <div class="row">
                        <div class="col-md-12">
                            <!--<button class="btn btn-primary" style="margin-right: 10px" onclick="PrintDoc()">Print <i class="fa fa-print"></i></button>-->
                            <a class="btn btn-primary" href="{{ route('exhibitor.pdf', $exhibitor->id) }}">Download <i class="fa fa-file-pdf-o"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card" id="printarea">

                    <div class="card-header" style="background: #fff; padding: 30px">
                        <div class="pdf">
                            <div class="pdf-logo" style="display: flex; justify-content: center;">
                                <img src="{{ url('uploads/images', $setting->logo)}}" alt="{{ $setting->website_name }}" style="margin: auto; width: 80%;">
                            </div>
                            <div class="pdf-text">
                                <h3 class="text-center" style="font-size: 18px">{!! $setting->banner_text_1 !!}</h3>
                                <h1 class="text-center" style="line-height: 1.5; font-size: 26px">{{ $setting->banner_text_2 }}</h1>
                                <h2 class="text-center" style="font-size: 18px">{{ $setting->banner_text_3 }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <center><h4 style="font-weight: bold; color: green;">
                                    @if($exhibitor->group == 1)
                                    Group-A
                                    @elseif($exhibitor->group == 2)
                                    Group-B
                                    @endif
                                    &nbsp;&nbsp;Serial : #{!! $exhibitor->id !!}
                                    &nbsp;&nbsp; Code : {{ $exhibitor->regi_code }}
                                </h4></center>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">

                                <img src="{{ url('uploads/images', $exhibitor->image) }}" class="w-100">

                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td colspan="3">{!! $exhibitor->name !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td colspan="3">{!! $exhibitor->email !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td colspan="3">{!! $exhibitor->phone !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>{!! $exhibitor->country['name'] !!}</td>

                                            <td>Date of Birth</td>
                                            <td>{!! $exhibitor->b_date !!}-{!! $exhibitor->b_month !!}-{!! $exhibitor->b_year !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Institution</td>
                                            <td colspan="3">{{ $exhibitor->school }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <center><h4>Artwork Details</h4></center>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="width: 10%">Name</td>
                                            <td colspan="3" style="width: 90%">{!! $exhibitor->art_name !!}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%">Media</td>
                                            <td colspan="3" style="width: 95%">{!! $exhibitor->media !!}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%">Size</td>
                                            <td style="width: 40%">{!! $exhibitor->size !!}</td>
                                            <td style="width: 10%">Year</td>
                                            <td style="width: 40%">{!! $exhibitor->year !!}</td>
                                        </tr>
                                        @if($exhibitor->link != null)
                                        <tr>
                                            <td style="width: 10%">Link</td>
                                            <td colspan="3" style="width: 95%"><a href="{!! $exhibitor->link !!}" target="_blank">{!! $exhibitor->link !!}</a></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                @if($exhibitor->artwork != null)
                                <div style="text-align: center; padding: 50px">
                                    <img src="{{ url('uploads/images', $exhibitor->artwork) }}" style="max-height: 400px; max-width:60%; border: 10px solid black; padding: 20px">
                                </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="margin-bottom:0;">
                            <div class="col-md-12">
                                <img src="{{ url('assets/frontend/img/footer.jpg') }}" class="w-100">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">



    function PrintDoc() {

        //Get the HTML of div
        var divElements = document.getElementById('printarea').innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
        "<html><head><title></title></head><body>" +
        divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;
    }
</script>
@endsection
