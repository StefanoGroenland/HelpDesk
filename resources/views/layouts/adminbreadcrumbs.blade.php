<li>
            <a href="{{URL::to('/admindashboard')}}">
               <i class="fa fa-dashboard"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{URL::to('/bugmuteren')}}">
               <i class="fa fa-bell"></i> Bug melden
            </a>
        </li>
        <li>
            <a href="{{URL::to('/bugoverzicht/'.Auth::user()->id)}}">
               <i class="fa fa-briefcase"></i> Bug overzicht
            </a>
        </li>
        <li>
            <a href="{{URL::to('/projectmuteren')}}">
               <i class="fa fa-pencil"></i> Project aanpassen
            </a>
        </li>
        <li>
            <a href="{{URL::to('/medewerkermuteren')}}">
               <i class="fa fa-pencil"></i> Medewerker aanpassen
            </a>
        </li>
        <li>
            <a href="{{URL::to('/klantmuteren')}}">
               <i class="fa fa-pencil"></i> Klant aanpassen
            </a>
        </li>