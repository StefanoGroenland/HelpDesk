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
                            @include('layouts.adminbreadcrumbs')
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2 col-md-6">
                        <div class="row">
                    <a href="{{URL::to('/newproject')}}">
                    <div class="col-lg-12 col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <i class="fa fa-plus fa-4x"></i>
                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <h3>Project</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                    </div>
                </div>
                {{--<div class="col-lg-2 col-md-6">--}}
                    {{--<div class="row">--}}
                {{--<a href="{{URL::to('/newmedewerker')}}">--}}
                {{--<div class="col-lg-12 col-md-6">--}}
                    {{--<div class="panel panel-warning">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-xs-12 text-center">--}}
                                    {{--<i class="fa fa-plus fa-4x"></i>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-xs-12 text-center">--}}
                                    {{--<h3>Medewerker</h3>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--</a>--}}
                {{--</div>--}}
               {{--</div>--}}

                @if(count($projects) > 0)
                @foreach($projects as $project)

                 {{-- */$i=0;/* --}}
                 {{-- */$x=0;/* --}}
                 {{-- */$y=0;/* --}}
                 {{-- */$krit=0;/* --}}
                 {{-- */$hoog=0;/* --}}
                 {{-- */$gem=0;/* --}}
                 {{-- */$laag=0;/* --}}
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
                                @foreach($bugs as $bug)
                                @if($bug->prioriteit == 'laag')
                                    @if($bug->project_id == $project->id)
                                    {{-- */$laag++;/* --}}
                                    @endif
                                @endif
                                @if($bug->prioriteit == 'gemiddeld')
                                    @if($bug->project_id == $project->id)
                                    {{-- */$gem++;/* --}}
                                    @endif
                                @endif
                                @if($bug->prioriteit == 'hoog')
                                    @if($bug->project_id == $project->id)
                                    {{-- */$hoog++;/* --}}
                                    @endif
                                @endif
                                @if($bug->prioriteit == 'kritisch')
                                    @if($bug->project_id == $project->id)
                                    {{-- */$krit++;/* --}}
                                    @endif
                                @endif
                                @endforeach
                                <div class="col-xs-12 text-right pull-right">
                                <span style="border: solid #ffffff 1px;" class="label label-purple pull-left">{{$krit}}</span>
                                @if($project->prioriteit == 'laag')
                                    <span class="label label-success">{{$project->projectnaam}}</span>
                                @elseif($project->prioriteit == 'gemiddeld')
                                    <span class="label label-yellow">{{$project->projectnaam}}</span>
                                @elseif($project->prioriteit == 'hoog')
                                    <span class="label label-danger">{{$project->projectnaam}}</span>
                                @elseif($project->prioriteit == 'kritisch')
                                    <span class="label label-purple">{{$project->projectnaam}}</span>
                                @endif
                                    <div>
                                    <span style="border: solid #ffffff 1px;" class="label label-danger pull-left">{{$hoog}}</span><span class="badge">
                                    @foreach($bugs as $bug)
                                    @if($bug->status == 'open')
                                        @if($bug->project_id == $project->id )
                                            {{-- */$i++/* --}}
                                        @endif
                                    @endif
                                    @endforeach
                                    {{$i}}
                                    </span> Openstaand</div>
                                    <span style="border: solid #ffffff 1px;" class="label label-warning pull-left">{{$gem}}</span>
                                    <div><span class="badge">
                                    @foreach($bugs as $bug)
                                    @if($bug->status == 'bezig')
                                        @if($bug->project_id == $project->id)
                                            {{-- */$x++/* --}}
                                        @endif
                                    @endif
                                    @endforeach
                                    {{$x}}
                                    </span> Bezig</div>
                                    <span style="border: solid #ffffff 1px;" class="label label-success pull-left">{{$laag}}</span>
                                    <div><span class="badge">
                                    @foreach($bugs as $bug)
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
                  @endif
                  </div>
                <div class="row">
                    <div class="col-lg-9">
                        <h4>Laatst gemelde bugs</h4>
                        <div class="table-responsive">
                        <table class="table table-hover data_table">
                                <thead>
                                <th>Gepost op </th>
                                <th>Status </th>
                                <th>Deadline</th>
                                <th>Bug</th>
                                <th>Prioriteit</th>
                                <th>Klant</th>
                                <th>Project</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @if(count($bugs) > 0)
                                @foreach($bugs as $bug)

                                    <tr>
                                        <td>{{$bug->created_at->format('d-m-y - H:i')}}</td>
                                        <td>{{$bug->status}}</td>
                                        <td>{{date('d-m-y - H:i',strtotime($bug->eind_datum))}}</td>
                                        <td>{{$bug->titel}}</td>
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
                                        @if($bug->klant)
                                        <td>{{ucfirst($bug->klant->voornaam) .' '. $bug->klant->tussenvoegsel .' '. ucfirst($bug->klant->achternaam)}}</td>
                                        @endif
                                        @if($bug->project)
                                            <td>{{$bug->project->projectnaam}}</td>
                                        @endif
                                        <td>
                                            <a href="/bugchat/{{$bug->id}}">
                                        <button type="submit" class="btn btn-success btn-xs">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                           </a>
                                        </td>
                                    </tr>

                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-success">
                        <div class="panel-heading"><small>Wachtwoord reset</small></div>
                        <div class="panel-footer">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                              <div class="row">
                                  <div class="col-lg-12">
                                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                  </div>
                              </div>
                            @endif
                          @endforeach
                          <form method="POST" action="/resetUserPassword" >
                             {!! csrf_field() !!}
                             <input type="hidden" name="_method" value="PUT">

                          <div class="form-group">
                             <input type="text" class="form-control" name="email" required="true" placeholder="E-mail">
                           </div>
                           <div class="form-group">
                              <input type="text" class="form-control"  name="password" required="true" placeholder="Wachtwoord">
                            </div>
                           <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Reset</button>
                          </form>
                        </div>
                        </div>
                    </div>
            </div>
            </div>
            <!-- /.container-fluid -->

        <!-- /#page-wrapper -->
<!--</div>-->

    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
