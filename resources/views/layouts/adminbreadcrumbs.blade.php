        <li>
            <a href="{{URL::to('/dashboard')}}">
               <i class="fa fa-building"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{URL::to('/bugoverzicht/'.Auth::user()->id)}}">
               <i class="fa fa-bug"></i> Feedback overzicht
            </a>
        </li>
        <li class="pull-right">
            <a href="{{URL::to('/klanten')}}">
               <i class="fa fa-users"></i> Klanten
            </a>
        </li>
         <li class="pull-right">
             <a href="{{URL::to('/medewerkers')}}">
                <i class="fa fa-user"></i> Medewerkers
             </a>
         </li>
        <li class="pull-right">
            <a href="{{URL::to('/projecten')}}">
               <i class="fa fa-briefcase"></i> Projecten
            </a>
        </li>