<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moodles - Helpdesk</title>

    @extends('layouts.top-links')

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Feedback <small>feedback pagina waar bugs worden verdeeld/getoond</small>
                        </h1>
                        <ol class="breadcrumb">
                           @include(Auth::user()->bedrijf == 'moodles' ? 'layouts.adminbreadcrumbs' : 'layouts.breadcrumbs')
                        </ol>
                             </div>
                         </div>
                          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                              <div class="row">
                                  <div class="col-lg-12">
                                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                  </div>
                              </div>
                            @endif
                          @endforeach

                
                <!-- /.row -->
                
                <div class="row">
                @if(Auth::user()->bedrijf == 'moodles')
                    <div class="col-lg-12">
                    <h3 class="page-header">
                        Gekoppelde bugs <small>aan mij gekoppelde bugs</small>
                    </h3>
                    <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                        <th>Bug nummer</th>
                        <th>Bug titel</th>
                        <th>Status</th>
                        <th>Soort</th>
                        <th>Prioriteit</th>
                        <th>Deadline</th>
                        <th>Klant <small>(nummer + naam)</small></th>
                        <th>Project <small>(nummer + naam)</small></th>
                        <th>Medewerker <small>(nummer + naam)</small></th>
                        <th></th>
                        </thead>
                        <tbody>

                        {{-- */$i=0;/* --}}
                           @foreach($bugs_related as $bug)
                           {{-- */$x=$bug->klant_id - 2;/* --}}
                           {{-- */$y=$bug->medewerker_id - 2;/* --}}
                                <tr>
                                    <td># {{$bug->id}}</td>
                                    <td>{{substr($bug->titel,0,15)}}</td>
                                    <td>{{$bug->status}}</td>
                                    <td>{{$bug->soort}}</td>
                                    <td>
                                    @if($bug->prioriteit == 'laag')
                                    <span class="label label-success">Laag</span>
                                    @elseif($bug->prioriteit == 'gemiddeld')
                                    <span class="label label-warning">Gemmideld</span>
                                    @elseif($bug->prioriteit == 'hoog')
                                    <span class="label label-danger">Hoog</span>
                                    @elseif($bug->prioriteit == 'kritisch')
                                    <span class="label label-purple">Kritisch</span>
                                    @else
                                    <span class="label label-info">Geen prioriteit</span>
                                    @endif
                                    </td>
                                    <td>{{$bug->eind_datum}}</td>
                                    <td>#{{$klanten[$x]->id.' '.$klanten[$x]->voornaam.' '.$klanten[$x]->tussenvoegsel.' '.$klanten[$x]->achternaam}}</td>
                                    <td>#{{$projects_all[$i]->id.' '.$projects_all[$i]->projectnaam}}</td>
                                    <td>#{{$klanten[$y]->id .' '. $klanten[$y]->voornaam.' '. $klanten[$y]->tussenvoegsel.' '. $klanten[$y]->achternaam}}</td>
                                    <td>
                                        <a href="/bugchat/{{$bug->id}}" class="">
                                            <button type="submit" class="btn btn-success btn-xs">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </a>
                                        @if(Auth::user()->bedrijf == 'moodles')
                                        <a href="/verwijderBug/{{$bug->id}}" class="">
                                            <button class="btn btn-danger btn-xs">
                                                    <i class="fa fa-remove"></i>
                                            </button>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                {{-- */$i++;/* --}}
                            @endforeach

                        </tbody>
                      </table>
                    </div>
                    </div>
                    

                @endif
                </div>
                @foreach($projects as $project)
                {{-- */$i=0;/* --}}
                                <div class="row">
                                   <div class="col-lg-12">
                                   <h3 class="page-header">
                                       {{$project->projectnaam}} <small>alle bugs voor {{$project->projectnaam}}</small>
                                   </h3>
                                   <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                        <th>Bug nummer</th>
                                        <th>Bug titel</th>
                                        <th>Status</th>
                                        <th>Soort</th>
                                        <th>Prioriteit</th>
                                        <th>Deadline</th>
                                        <th>Klant <small>(nummer + naam)</small></th>
                                        <th>Project <small>(nummer + naam)</small></th>
                                        <th>Medewerker <small>(nummer + naam)</small></th>
                                        <th></th>
                                        </thead>
                                        <tbody>
                                           @foreach($bugs_all as $bug)
                                                 {{-- */$x=$bug->klant_id - 2;/* --}}
                                                 {{-- */$y=$bug->medewerker_id - 2;/* --}}
                                           @if($bug->project_id == $project->id)
                                                <tr>
                                                    <td>#{{$bug->id}}</td>
                                                    <td>{{substr($bug->titel,0,15)}}...</td>
                                                    <td>{{$bug->status}}</td>
                                                    <td>{{$bug->soort}}</td>
                                                    <td>
                                                    @if($bug->prioriteit == 'laag')
                                                    <span class="label label-success">Laag</span>
                                                    @elseif($bug->prioriteit == 'gemiddeld')
                                                    <span class="label label-warning">Gemmideld</span>
                                                    @elseif($bug->prioriteit == 'hoog')
                                                    <span class="label label-danger">Hoog</span>
                                                    @elseif($bug->prioriteit == 'kritisch')
                                                    <span class="label label-purple">Kritisch</span>
                                                    @else
                                                    <span class="label label-info">Geen prioriteit</span>
                                                    @endif
                                                    </td>
                                                    <td>{{$bug->eind_datum}}</td>
                                                    <td>#{{ $klanten[$x]->id .' '.$klanten[$x]->voornaam .' '.$klanten[$x]->tussenvoegsel.' '. $klanten[$x]->achternaam}}</td>
                                                    <td>#{{ $project->id.' '.$project->projectnaam}}</td>
                                                    <td>#{{$klanten[$y]->id .' '.$klanten[$y]->voornaam .' '.$klanten[$y]->tussenvoegsel.' '. $klanten[$y]->achternaam}}</td>

                                                    <td>
                                                        <a href="/bugchat/{{$bug->id}}" class="">
                                                            <button type="submit" class="btn btn-success btn-xs">
                                                                <i class="glyphicon glyphicon-search"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                      </table>
                                   </div>
                                  </div>
                                 </div>
                                @endforeach
                @if(Auth::user()->bedrijf == 'moodles')
                {{-- */$i=0;/* --}}
                <div class="row">
                    <div class="col-lg-12">
                    <h3 class="page-header">
                        Alle bugs <small>een lijst van alle bugs</small>
                    </h3>
                    <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                        <th>Bug nummer</th>
                        <th>Bug titel</th>
                        <th>Status</th>
                        <th>Soort</th>
                        <th>Prioriteit</th>
                        <th>Deadline</th>
                        <th>Klant <small>(nummer + naam)</small></th>
                        <th>Project <small>(nummer + naam)</small></th>
                        <th>Medewerker <small>(nummer + naam)</small></th>
                        <th></th>
                        </thead>
                        <tbody>
                           @foreach($projects_all as $project)
                           @if($bugs_all[$i]->project_id == $project->id)
                           {{-- */$x=$bugs_all[$i]->klant_id - 2;/* --}}
                           {{-- */$y=$bugs_all[$i]->medewerker_id - 2;/* --}}
                                <tr>
                                    <td>#{{$bugs_all[$i]->id}}</td>
                                    <td>{{substr($bugs_all[$i]->titel,0,15)}}</td>
                                    <td>{{$bugs_all[$i]->status}}</td>
                                    <td>{{$bugs_all[$i]->soort}}</td>
                                    <td>
                                    @if($bugs_all[$i]->prioriteit == 'laag')
                                    <span class="label label-success">Laag</span>
                                    @elseif($bugs_all[$i]->prioriteit == 'gemiddeld')
                                    <span class="label label-warning">Gemmideld</span>
                                    @elseif($bugs_all[$i]->prioriteit == 'hoog')
                                    <span class="label label-danger">Hoog</span>
                                    @elseif($bugs_all[$i]->prioriteit == 'kritisch')
                                    <span class="label label-purple">Kritisch</span>
                                    @else
                                    <span class="label label-info">Geen prioriteit</span>
                                    @endif
                                    </td>
                                    <td>{{$bugs_all[$i]->eind_datum}}</td>
                                    <td>#{{ $klanten[$x]->id .' '.$klanten[$x]->voornaam .' '.$klanten[$x]->tussenvoegsel.' '. $klanten[$x]->achternaam}}</td>
                                    <td>#{{ $project->id.' '.$project->projectnaam}}</td>
                                    <td>#{{$klanten[$y]->id .' '.$klanten[$y]->voornaam .' '.$klanten[$y]->tussenvoegsel.' '. $klanten[$y]->achternaam}}</td>
                                    <td>
                                        <a href="/bugchat/{{$bugs_all[$i]->id}}" class="">
                                            <button type="submit" class="btn btn-success btn-xs">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </a>
                                        <a href="/verwijderBug/{{$bugs_all[$i]->id}}" class="">
                                            <button class="btn btn-danger btn-xs">
                                                    <i class="fa fa-remove"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                {{-- */$i++;/* --}}
                                @endif
                            @endforeach

                        </tbody>
                      </table>
                    </div>
                   </div>
                   </div>
                  @else
                                              @endif
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   @extends('layouts.footer')

</body>

</html>
