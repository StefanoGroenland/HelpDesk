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


</head>
@if (\Auth::guest())
<body>
@else

    <!--<div id="wrapper">-->
        <div id="page-wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                 <a class="navbar-brand" href="{{URL::to('/admindashboard')}}">Moodles Helpdesk</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ucfirst(Auth::user()->username) .' '. Auth::user()->achternaam}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{URL::to('/profiel')}}"><i class="fa fa-fw fa-user"></i> Profiel</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{URL::to('/logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
@endif