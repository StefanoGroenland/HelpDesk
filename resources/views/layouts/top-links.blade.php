
</head>
@if (\Auth::guest())
<body>
@else
<body>
        <!-- Navigation -->
        <div class="row">
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                     <!-- Brand and toggle get grouped for better mobile display -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
           <div class="navbar-header">
                <a class="navbar-brand" href="{{URL::to('/admindashboard')}}">Moodles Helpdesk</a>
           </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 center-block text-center" style="color:#ffffff">
            <br>
            @if(Auth::user()->bedrijf == 'moodles')
                      <button type="submit" class="btn btn-default btn-xs disabled">
                         <i class="fa fa-clock-o"></i>
                         {{date('d-m-y - H:i')}}
                      </button>
                      <button type="submit" class="btn btn-default btn-xs disabled">
                         <i class="fa fa-bug"></i>
                         Bugs :
                         {{count(\App\Bug::all())}}
                      </button>


                        <button type="submit" class="btn btn-default btn-xs disabled">
                           <i class="fa fa-briefcase"></i>
                           Projecten :
                           {{count(\App\Project::all())}}
                        </button>


                          <button type="submit" class="btn btn-default btn-xs disabled">
                             <i class="fa fa-user"></i>
                             Gebruikers :
                             {{count(\App\User::all())}}
                             Waarvan :
                             {{count(\App\User::where('bedrijf','!=', 'moodles')->get())}}
                             Klanten.
                          </button>
                @endif
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <ul class="nav navbar-right top-nav">
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
        </div>
       </nav>
     </div>



@endif
