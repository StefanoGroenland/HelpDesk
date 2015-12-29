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
                            @include('layouts.header-controls')
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
                    <table class="table table-hover data_table">
                        <thead>
                        <th style="width: 10%">Bug nummer</th>
                        <th style="width: 10%">Bug titel</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 10%">Soort</th>
                        <th style="width: 10%">Prioriteit</th>
                        <th style="width: 10%">Deadline</th>
                        <th style="width: 10%">Klant</th>
                        <th style="width: 10%">Project</th>
                        <th style="width: 10%">Medewerker</th>
                        <th style="width: 10%"></th>
                        </thead>
                        <tbody>

                           @foreach($bugs_related as $bug)
                                <tr>
                                    <td>{{$bug->id}}</td>
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
                                    <td>{{date('d-m-y - H:i',strtotime($bug->eind_datum))}}</td>
                                    @if($bug->klant)
                                    <td>{{ucfirst($bug->klant->voornaam) .' '.$bug->klant->tussenvoegsel.' '. ucfirst($bug->klant->achternaam)}}</td>
                                    @endif
                                    {{--<td>{{$project->projectnaam}}</td>--}}
                                    @if($bug->project)
                                    <td>{{$bug->project->projectnaam}}</td>
                                    @endif
                                    @if($bug->user)
                                    <td>{{ucfirst($bug->user->voornaam) .' '.$bug->user->tussenvoegsel.' '. ucfirst($bug->user->achternaam)}}</td>
                                    @else
                                    <td>Geen</td>
                                    @endif
                                    <td>
                                        <a href="/bugchat/{{$bug->id}}" class="">
                                            <button type="submit" class="btn btn-success btn-xs">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </a>
                                        @if(Auth::user()->bedrijf == 'moodles')
                                             <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$bug->id}}">
                                               <i class="glyphicon glyphicon-trash"></i>
                                             </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
                @endif
             </div>

                @foreach($projects as $project)
                                <div class="row">
                                   <div class="col-lg-12">
                                   <h3 class="page-header">
                                       {{$project->projectnaam}} <small>alle bugs voor {{$project->projectnaam}}</small>
                                   </h3>
                                   <div class="table-responsive">
                                    <table class="table table-hover data_table">
                                        <thead>
                                        <th style="width: 10%">Bug nummer</th>
                                        <th style="width: 10%">Bug titel</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 10%">Soort</th>
                                        <th style="width: 10%">Prioriteit</th>
                                        <th style="width: 10%">Deadline</th>
                                        <th style="width: 10%">Klant</th>
                                        <th style="width: 10%">Project</th>
                                        <th style="width: 10%">Medewerker</th>
                                        <th style="width: 10%"></th>
                                        </thead>
                                        <tbody>
                                           @foreach($bugs_all as $bug)
                                           @if($bug->project_id == $project->id)
                                                <tr>
                                                    <td>{{$bug->id}}</td>
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
                                                    <td>{{date('d-m-y - H:i',strtotime($bug->eind_datum))}}</td>
                                                    @if($bug->klant)
                                                    <td>{{ucfirst($bug->klant->voornaam) .' '.$bug->klant->tussenvoegsel.' '. ucfirst($bug->klant->achternaam)}}</td>
                                                    @endif
                                                    <td>{{$project->projectnaam}}</td>
                                                    @if($bug->user)
                                                    <td>{{ucfirst($bug->user->voornaam) .' '.$bug->user->tussenvoegsel.' '. ucfirst($bug->user->achternaam)}}</td>
                                                    @else
                                                    <td>Geen</td>
                                                    @endif
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
                <div class="row">
                    <div class="col-lg-12">
                    <h3 class="page-header">
                        Alle bugs <small>een lijst van alle bugs</small>
                    </h3>
                    <div class="table-responsive">
                    <table class="table table-hover data_table">
                        <thead>
                        <th style="width: 10%">Bug nummer</th>
                        <th style="width: 10%">Bug titel</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 10%">Soort</th>
                        <th style="width: 10%">Prioriteit</th>
                        <th style="width: 10%">Deadline</th>
                        <th style="width: 10%">Klant</th>
                        <th style="width: 10%">Project</th>
                        <th style="width: 10%">Medewerker</th>
                        <th style="width: 10%"></th>
                        </thead>
                        <tbody>
                        {{-- */$i=0;/* --}}
                            @foreach($bugs_all as $bug)
                                @if(count($bugs_all) > 0)
                                    @if($bug->project_id == $bug->project->id)
                                    <tr>
                                        <td>{{$bug->id}}</td>
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
                                        <td>{{date('d-m-y - H:i',strtotime($bug->eind_datum))}}</td>
                                        @if($bug->klant)
                                        <td>{{ucfirst($bug->klant->voornaam) .' '.$bug->klant->tussenvoegsel.' '. ucfirst($bug->klant->achternaam)}}</td>
                                        @endif
                                        <td>{{$bug->project->projectnaam}}</td>
                                        @if($bug->user)
                                        <td>{{ucfirst($bug->user->voornaam) .' '.$bug->user->tussenvoegsel.' '. ucfirst($bug->user->achternaam)}}</td>
                                        @else
                                        <td>Geen</td>
                                        @endif
                                        <td>
                                            <a href="/bugchat/{{$bug->id}}" class="">
                                                <button type="submit" class="btn btn-success btn-xs">
                                                    <i class="glyphicon glyphicon-search"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif

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

    @foreach($bugs_related as $key)
                     <div class="modal fade" id="myModal{{$key->id}}" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title">Verwijder verzoek</h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Weet u zeker dat u de bug : <strong>{{$key->id}}</strong> wilt verwijderen&hellip;</p>

                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default btn-xs pull-right" data-dismiss="modal">Close</button>
                                      <form method="POST" action="/verwijderBug/{{$key->id}}" >
                                      {!! method_field('DELETE') !!}
                                      {!! csrf_field() !!}
                                      <button type="submit" class="btn btn-danger btn-xs pull-left">
                                         {{--<i class="glyphicon glyphicon-trash"></i>--}}
                                         Verwijder bug
                                      </button>
                                      </form>
                                    </div>
                                  </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                              </div><!-- /.modal -->
                              @endforeach
    <!-- /#wrapper -->
   @extends('layouts.footer')
</body>

</html>