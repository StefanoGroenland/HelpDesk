
        <li>
            <a href="{{URL::to('/dashboard')}}">
               <i class="fa fa-building"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{URL::to('/bugoverzicht/'.Auth::user()->id)}}">
               <i class="fa fa-briefcase"></i> Overzicht verstuurde feedback
            </a>
        </li>
