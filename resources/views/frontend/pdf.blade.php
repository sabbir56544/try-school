@extends('layouts.front')
@section('content')
<div class="card" id="printarea">
    <div class="card-header" style="background: #fff; padding: 0; text-align: center;">
        @php
        $pdf = "uploads/images/".$setting->pad_head;
        @endphp
        @if($setting->pad_head != null)
        <img src="{{ url('uploads/images', $setting->pad_head) }}" style="width: 100%">
        <!--<img src="{{ $pdf }}" style="width: 80%">-->
        @endif

    </div>
    <hr>

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
        <table style="border-collapse: collapse; width: 100%">
            <tr>
                <td style="width: 25%">

                    @php
                    $image = "uploads/images/".$exhibitor->image;
                    @endphp
                    <!--<img src="{{ $image }}" style="max-height: 190px">-->
                    <img src="{{ url('uploads/images', $exhibitor->image) }}" style="height: 150px">
                </td>
                <td>
                    <table style="border: 1px; width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="border: 1px solid black; padding: 5px">Name</td>
                                <td colspan="3" style="border: 1px solid black; padding: 5px">{!! $exhibitor->name !!}</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black; padding: 5px">Email</td>
                                <td colspan="3" style="border: 1px solid black; padding: 5px">{!! $exhibitor->email !!}</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black; padding: 5px">Phone</td>
                                <td colspan="3" style="border: 1px solid black; padding: 5px">{!! $exhibitor->phone !!}</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black; padding: 5px">Country</td>
                                <td style="border: 1px solid black; padding: 5px">{!! $exhibitor->country['name'] !!}</td>

                                <td style="border: 1px solid black; padding: 5px">Date of Birth</td>
                                <td style="border: 1px solid black; padding: 5px">{!! $exhibitor->b_date !!}-{!! $exhibitor->b_month !!}-{!! $exhibitor->b_year !!}</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black; padding: 5px">Institution</td>
                                <td colspan="3" style="border: 1px solid black; padding: 5px">{{ $exhibitor->school }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            <center><h4>Artwork Details</h4></center>
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="width: 10%; border: 1px solid black; padding: 5px">Name</td>
                        <td colspan="3" style="width: 90%; border: 1px solid black; padding: 5px">{!! $exhibitor->art_name !!}</td>
                    </tr>
                    <tr>
                        <td style="width: 10%; border: 1px solid black; padding: 5px">Media</td>
                        <td colspan="3" style="width: 95%; border: 1px solid black; padding: 5px">{!! $exhibitor->media !!}</td>
                    </tr>
                    <tr>
                        <td style="width: 10%; border: 1px solid black; padding: 5px">Size</td>
                        <td style="width: 40%; border: 1px solid black; padding: 5px">{!! $exhibitor->size !!}</td>
                        <td style="width: 10%; border: 1px solid black; padding: 5px">Year</td>
                        <td style="width: 40%; border: 1px solid black; padding: 5px">{!! $exhibitor->year !!}</td>
                    </tr>
                    @if($exhibitor->link != null)
                    <tr>
                        <td style="width: 10%; border: 1px solid black; padding: 5px">Link</td>
                        <td colspan="3" style="width: 95%; border: 1px solid black; padding: 5px"><a href="{!! $exhibitor->link !!}" target="_blank">{!! $exhibitor->link !!}</a></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            @if($exhibitor->artwork != null)
            <div style="text-align: center; padding: 30px">
                @php
                $link = "uploads/images/".$exhibitor->artwork;
                @endphp
                <!--<img src="{{ $link }}" style="max-height: 200px; max-width:60%; border: 10px solid black; padding: 20px">-->
                <img src="{{ url('uploads/images', $exhibitor->artwork) }}" style="max-height: 250px; max-width:60%; border: 10px solid black; padding: 20px">
            </div>
            @endif
        </div>
    </div>
    <table style="width: 100%; border-collapse: collapse; border-top: 1px solid black">
        <tr>
            <td><img src="{{ url('assets/img/footer.jpg') }}" style="width:100%"></td>
        </tr>
    </table>
</div>
</div>
@endsection
