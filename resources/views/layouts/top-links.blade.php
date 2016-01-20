
@if (\Auth::guest())
<body>
@else
<style>
.glyphicon-spin {
    -webkit-animation: spin 6500ms infinite linear;
    animation: spin 6500ms infinite linear;
}
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
    }
}
@keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
    }
}
</style>
<body>
        <!-- Navigation -->
        <div class="row" style="margin-bottom: 20px;">
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                     <!-- Brand and toggle get grouped for better mobile display -->
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
           {{--<div class="navbar-header">--}}
                {{--<a class="navbar-brand" href="{{URL::to('/admindashboard')}}">Moodles Helpdesk--}}
                {{--</a>--}}
           {{--</div>--}}
           <a href="/dashboard">
           <img class="img-responsive pull-left " alt="profile_img" src="../assets/images/logo.png" style="margin-left:10px;margin-bottom: 5px; min-height: 50px;!important;max-height: 50px;!important min-width: 200px;!important; max-width: 200px;!important;"/>
           </a>
           <h1 class="navbar-brand" style="color:#ffffff; vertical-align: text-bottom;!important;font-size:35px;" >
               Dashboard <small>Overzicht</small>
           </h1>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 center-block text-center hidden-xs" style="color:#ffffff;line-height: normal!important;">
        <small class="">
                        <ul class="list-inline list-unstyled">
                          <li class="pull-right">
                             <a href="{{URL::to('/medewerkers')}}">
                                <button type="submit" class="btn btn-default"><i class="fa fa-users"></i> Medewerkers</button>
                             </a>
                          </li>
                          <li class="pull-right">
                              <a href="{{URL::to('/klanten')}}">
                                 <button type="submit" class="btn btn-default"><i class="fa fa-user"></i> Klanten</button>
                              </a>
                          </li>
                          <li class="pull-right">
                            <a href="{{URL::to('/projecten')}}">
                               <button type="submit" class="btn btn-default"><i class="fa fa-briefcase"></i> Projecten</button>
                            </a>
                          </li>
                          <li class="pull-right">
                            <a href="{{URL::to('/bugoverzicht/'.Auth::user()->id)}}">
                               <button type="submit" class="btn btn-default "><i class="fa fa-bug"></i> Feedback overzicht</button>
                            </a>
                        </li>
                        <li class="pull-right">
                                      <a href="{{URL::to('/dashboard')}}">
                                         <button type="submit" class="btn btn-default "><i class="fa fa-building"></i> Dashboard</button>
                                      </a>
                                  </li>
                        </ul>



              </small>
            {{--@if(Auth::user()->bedrijf == 'moodles')--}}
                      {{--<button class="btn btn-default btn-xs disabled">--}}
                        {{--<i class="glyphicon glyphicon-time glyphicon-spin"></i>--}}
                        {{--{{date('d-m-y - H:i')}}--}}
                      {{--</button>--}}
                      {{--<button class="btn btn-default btn-xs disabled">--}}
                         {{--<i class="fa fa-bug"></i>--}}
                         {{--Bugs :--}}
                         {{--{{count(\App\Bug::all())}}--}}
                      {{--</button>--}}
                        {{--<button class="btn btn-default btn-xs disabled">--}}
                           {{--<i class="fa fa-briefcase"></i>--}}
                           {{--Projecten :--}}
                           {{--{{count(\App\Project::all())}}--}}
                        {{--</button>--}}
                          {{--<button class="btn btn-default btn-xs disabled">--}}
                             {{--<i class="fa fa-user"></i>--}}
                             {{--Gebruikers :--}}
                             {{--{{count(\App\User::all())}}--}}
                             {{--Waarvan :--}}
                             {{--{{count(\App\User::where('bedrijf','!=', 'moodles')->get())}}--}}
                             {{--Klanten.--}}
                          {{--</button>--}}
                {{--@endif--}}

        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
        <ul class="nav navbar-right top-nav">
            <li class="dropdown clearfix">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="img-responsive img-circle pull-left " alt="profile_img" src="
                        @if(Auth::user()->profielfoto)
                        {{'../'.Auth::user()->profielfoto}}
                        @else
                        {{"../assets/images/avatar.png"}}
                        @endif
                        " style="margin-right:3px; height: 26px;!important; width: 26px;!important;"/>
                        {{ucfirst(Auth::user()->voornaam) .' '. ucfirst(Auth::user()->achternaam)}}
                        <b class="caret"></b>
                    </a>

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
