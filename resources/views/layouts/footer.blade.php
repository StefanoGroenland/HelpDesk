    <link href="{{URL::asset('../assets/css/bootstrap.css')}}" rel="stylesheet">
     <!-- Custom CSS -->
     <link href="{{URL::asset('../assets/css/sb-admin.css')}}" rel="stylesheet">
     <!-- Morris Charts CSS -->
     <link href="{{URL::asset('../assets/css/plugins/morris.css')}}" rel="stylesheet">
     <!-- Custom Fonts -->
     <link href="{{URL::asset('../assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
             <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
             <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
         <![endif]-->
   <!-- jQuery -->
    <script src="{{URL::asset('../assets/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::asset('../assets/js/bootstrap.min.js')}}"></script>
    <!-- Morris Charts JavaScript -->
    <script src="{{URL::asset('../assets/js/plugins/morris/raphael.min.js')}}"></script>
    <script src="{{URL::asset('../assets/js/plugins/morris/morris.js')}}"></script>
    <script src="{{URL::asset('../assets/js/plugins/morris/morris-data.js')}}"></script>

    @yield('scripts')