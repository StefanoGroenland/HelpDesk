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
                            Dashboard <small>Overzicht</small>
                            @include('layouts.header-controls')
                        </h1>
                        {{--Breadcrumbs spot!--}}
                         <ol class="breadcrumb">
                         @include('layouts.breadcrumbs')
                         </ol>

                    </div>
                </div>
                <div class="row">
                <div class="col-lg-2">
                <img class="img-responsive" src="{{URL::asset('../assets/images/logo.png')}}" alt="...">
                <a href="#">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-12 text-center">
                                                        <i class="fa fa-plus fa-3x"></i>
                                                    </div>
                                                    </div>
                                                <div class="row">
                                                <a href="/bugmuteren">
                                                <div class="col-xs-12 text-center">
                                                    <h5>Bug melden</h5>
                                                </div>
                                                </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                </div>
                <div class="col-lg-10">
                <h4 class="page-header">
                Mijn projecten
                </h4>
                </div>
                       @foreach($projects_send as $project)
                                        {{-- */$i=0;/* --}}
                                        {{-- */$x=0;/* --}}
                                        {{-- */$y=0;/* --}}
                                       <div class="col-lg-2 col-md-6">
                                       @if($project->prioriteit == 'laag')
                                              <div class="panel panel-green">
                                          @elseif($project->prioriteit == 'gemiddeld')
                                              <div class="panel panel-yellow">
                                          @elseif($project->prioriteit == 'hoog')
                                              <div class="panel panel-red">
                                          @elseif($project->prioriteit == 'kritisch')
                                              <div class="panel panel-purple">
                                          @endif
                                               <div class="panel-heading">
                                                   <div class="row">
                                                   <div id='notificatie'><div>2</div></div>
                                                       <div class="col-xs-12 text-right">
                                                       @if($project->prioriteit == 'laag')
                                                           <span class="label label-success">{{$project->projectnaam}}</span>
                                                       @elseif($project->prioriteit == 'gemiddeld')
                                                           <span class="label label-yellow">{{$project->projectnaam}}</span>
                                                       @elseif($project->prioriteit == 'hoog')
                                                           <span class="label label-danger">{{$project->projectnaam}}</span>
                                                       @elseif($project->prioriteit == 'kritisch')
                                                           <span class="label label-purple">{{$project->projectnaam}}</span>
                                                       @endif
                                                           <div><span class="badge">
                                                           @foreach($bugs_send as $bug)
                                                           @if($bug->status == 'open')
                                                               @if($bug->project_id == $project->id)
                                                                   {{-- */$i++/* --}}
                                                               @endif
                                                           @endif
                                                           @endforeach
                                                           {{$i}}
                                                           </span> Openstaand</div>
                                                           <div><span class="badge">
                                                           @foreach($bugs_send as $bug)
                                                           @if($bug->status == 'bezig')
                                                               @if($bug->project_id == $project->id)
                                                                   {{-- */$x++/* --}}
                                                               @endif
                                                           @endif
                                                           @endforeach
                                                           {{$x}}
                                                           </span> Bezig</div>
                                                           <div><span class="badge">
                                                           @foreach($bugs_send as $bug)
                                                           @if($bug->status == 'gesloten')
                                                               @if($bug->project_id == $project->id)
                                                                   {{-- */$y++/* --}}
                                                               @endif
                                                           @endif
                                                           @endforeach
                                                           {{$y}}
                                                           </span> Gesloten</div>
                                                       </div>
                                                   </div>
                                               </div>
                                   <a href="/bugoverzicht/{{Auth::user()->id}}">
                                       <div class="panel-footer">
                                           <span class="pull-left">Bekijk</span>
                                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                           <div class="clearfix"></div>
                                       </div>
                                   </a>
                               </div>
                               </div>
                           @endforeach

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4>Verstuurde feedback</h4>
                        <div class="table-responsive">
                        <table class="table table-hover data_table">
                                <thead>
                                <th>Gepost op :</th>
                                <th>Start datum</th>
                                <th>Deadline</th>
                                <th>Soort</th>
                                <th>Status</th>
                                <th>Prioriteit</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @foreach($bugs_send as $bug)
                                    <tr>
                                        <td>{{$bug->created_at->format('d-m-y - H:i')}}</td>
                                        <td>{{date('d-m-y - H:i',strtotime($bug->start_datum))}}</td>
                                        <td>{{date('d-m-y - H:i',strtotime($bug->eind_datum))}}</td>
                                        <td>{{$bug->soort}}</td>
                                        <td>{{$bug->status}}</td>
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
                                        <td>
                                            <a href="/bugchat/{{$bug->id}}">
                                        <button type="submit" class="btn btn-success btn-xs">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<!--</div>-->

    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
