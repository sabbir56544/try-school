<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ $seo->meta_keys }}">
    <meta name="author" content="AcademyZPresso">

    <title>{{ $gs->title }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/print/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/print/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/print/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/print/css/style.css') }}">
    <link href="{{ asset('assets/print/css/print.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/' . $gs->favicon) }}">
    <!------ Include the above in your HEAD tag ---------->
    <style>
        @page {
            size: auto;
            margin: 0mm;
        }

        @page {
            size: A4;
            margin: 0;
        }

        html,
        body {
            width: 250mm;
            height: 250mm;
        }

        ::-webkit-scrollbar {
            width: 0px;
            /* remove scrollbar space */
            background: transparent;
            /* optional: just make scrollbar invisible */
        }

        body {
            background: #fff;
        }

        .sheet {
            margin: 0;
            box-shadow: none;

        }

        .A4.landscape {
            /* using certificate background image from code.org as an example */
            background-size: contain !important;
            height: 100% !important;
            background-repeat: no-repeat !important;
        }

        #cert {}

        #name {
            text-align: center;
            font-size: 10mm;
            color: #4FC3F7;
            font-family: 'Dancing Script';
            font-weight: bold;
        }

        #details {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
            color: #4FC3F7;
            padding: 0px 90px 0px 90px;
            height: 70px;
        }

        #sign {
            text-align: center;
            width: 50%;
        }

        #logo {

            text-align: center;

        }

        #logo img {

            text-align: center;
            max-width: 0%;

        }

        #date {
            text-align: right;

        }


        @media print {

            body:before {
                content: url({{ asset('assets/images/certificate.jpg') }});
                position: fixed;
                z-index: -1;
            }

            html,
            body {
                width: 210mm;
            }

        }
    </style>

</head>
<!--

    This snippet shows an example of how you can generate a certificate
    on your website that is readily printable. Paper CSS makes sure of
    the correct paper size, while the rest is just some css.

    -->
<body onload="window.print();" class="A4 landscape"
    style="background-image:url({{ asset('assets/images/certificate.jpg') }}); margin-top: 120px;">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet">
        <div id="cert" class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="margin-top: 200px;">
                    <h4 id="name">{{ __('Student Name') }}</h4>
                </div>
                <div class="col-md-12">
                    <div id="details">{{ $gs->cert_text }}</div>
                </div>
            </div>
            <div class="row" style="margin-top: 100px">
                <div class="col-lg-4" style="display:inline-block; width: 33%">
                    <h2 id="date" style="font-size:22px; font-weight:600;">{{ date('d/m/y') }}</h2>
                </div>
                <div class="col-lg-4" style="display:inline-block;  width: 33%">
                    <h2 id="logo"><img style="width: 80%;" src="{{ asset('assets/images/' . $gs->logo) }}"></h2>
                </div>
                <div class="col-lg-4" style="display:inline-block; padding-left:5px;  width: 33%">
                    <img id="sign" style="margin-bottom: 10px;"
                        src="{{ asset('assets/images/' . $gs->cert_sign) }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        setTimeout(function() {
            window.close();
        }, 500);
    </script>
</body>
</html>
