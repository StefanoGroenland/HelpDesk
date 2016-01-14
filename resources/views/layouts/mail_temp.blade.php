<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

{{--begin container--}}
<div class="container">

    <br>
    {{--begin row--}}
    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2"></div>
        <div class="col-sm-8 col-md-8 col-lg-8">
            <img src="http://helpdesk.moodles.nl/assets/images/logo.png" class="text-center center-block img-responsive"
            width="200px" height="200px">

            <h3 class="text-center page-header">
                @yield('onderwerp')
            </h3>
            <br>
                @yield('bericht')
            <br>
                @yield('footer')

        </div>
        <div class="col-sm-2 col-md-2 col-lg-2"></div>
    </div>
    {{--endrow--}}




</div>
{{--end container--}}