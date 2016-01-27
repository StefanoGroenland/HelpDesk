<head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body style="background-color:#f2f2f2;!important;" >
   {{--begin container--}}
   <div class="container">
      <div class="panel panel-default" style="margin-top:40px;!important;" >
         <div class="panel-body">
            {{--begin row--}}
            <div class="row">
               <div class="col-sm-2 col-md-2 col-lg-2"></div>
               <div class="col-sm-8 col-md-8 col-lg-8">
                  <br>
                  <img src="http://helpdesk.moodles.nl/assets/images/logo.png" class="text-center center-block img-responsive"
                     width="200px" height="200px">
                  <h3 class="text-center page-header" style="border-bottom: none;!important;" >
                     @yield('onderwerp')
                  </h3>
                  @yield('bericht')
                  @yield('footer')
               </div>
               <div class="col-sm-2 col-md-2 col-lg-2"></div>
            </div>
            {{--endrow--}}
         </div>
      </div>
   </div>
   {{--end container--}}
</body>
