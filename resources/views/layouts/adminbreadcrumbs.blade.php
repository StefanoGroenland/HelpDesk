<li>
            <a href="{{URL::to('/admindashboard')}}">
               <i class="fa fa-dashboard"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{URL::to('/bugoverzicht/'.Auth::user()->id)}}">
               <i class="fa fa-bug"></i> Bug overzicht
            </a>
        </li>
        <li class="pull-right">
            <a href="{{URL::to('/projecten')}}">
               <i class="fa fa-briefcase"></i> Projecten
            </a>
        </li>
        <li class="pull-right">
            <a href="{{URL::to('/medewerkers')}}">
               <i class="fa fa-user"></i> Medewerkers
            </a>
        </li>
        <li class="pull-right">
            <a href="{{URL::to('/klanten')}}">
               <i class="fa fa-users"></i> Klanten
            </a>
        </li>