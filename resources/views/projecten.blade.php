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
                            Projecten <small> een overzicht van alle projecten.</small>
                            @include('layouts.header-controls')
                        </h1>
                        {{--breadcrumbs layout spot!--}}
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
                <div class="row">

                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover data_table">
                                <thead>
                                <th>Project</th>
                                <th>URL</th>
                                <th>Titel</th>
                                <th>Klantnummer</th>
                                <th>Satus</th>
                                <th>Soort</th>
                                <th>Prioriteit</th>
                                <th></th>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                      <tr>
                                      <td>{{$project->projectnaam}}</td>
                                      <td>{{$project->projecturl}}</td>
                                      <td>{{$project->titel}}</td>
                                      <td>{{$project->gebruiker_id}}</td>
                                      <td>{{$project->status}}</td>
                                      <td>{{$project->soort}}</td>
                                      <td>
                                      @if($project->prioriteit == 'laag')
                                      <span class="label label-success">Laag</span>
                                      @elseif($project->prioriteit == 'gemiddeld')
                                      <span class="label label-warning">Gemmideld</span>
                                      @elseif($project->prioriteit == 'hoog')
                                      <span class="label label-danger">Hoog</span>
                                      @elseif($project->prioriteit == 'kritisch')
                                      <span class="label label-purple">Kritisch</span>
                                      @else
                                      <span class="label label-info">Geen prioriteit</span>
                                      @endif
                                      </td>
                                      <td>
                                      <a href="/projectmuteren/{{$project->id}}" class="">
                                           <button class="btn btn-success btn-xs wijzigKnop2" name="zoekProject" type="button" data-project="{{$project->projectnaam}}">
                                                  <i class="glyphicon glyphicon-pencil"></i>
                                           </button>
                                      </a>
                                      <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$project->id}}">
                                        <i class="glyphicon glyphicon-trash"></i>
                                      </button>
                                        </td>
                                      </tr>
                                      @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        @foreach($projects as $proj)
        <div class="modal fade" id="myModal{{$proj->id}}" tabindex="-1" role="dialog">
                   <div class="modal-dialog">
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title">Verwijder verzoek</h4>
                       </div>
                       <div class="modal-body">
                         <p>Weet u zeker dat u het project : <strong>{{$proj->titel}}</strong> wilt verwijderen&hellip;</p>

                       </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                         <a href="/verwijderProject/{{$proj->id}}" class="">
                             <button type="submit" class="btn btn-danger btn-xs">
                                {{--<i class="glyphicon glyphicon-trash"></i>--}}
                                Verwijder project
                             </button>
                         </a>
                       </div>
                     </div><!-- /.modal-content -->
                   </div><!-- /.modal-dialog -->
                 </div><!-- /.modal -->
                 @endforeach
        <!-- /#page-wrapper -->
            {{--@section('scripts')--}}
              {{--@stop--}}
    </div>

    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
