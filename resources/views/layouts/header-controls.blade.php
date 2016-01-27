@if(Auth::user()->rol == 'medewerker')
      <small class="pull-right">
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
      @else

      @endif