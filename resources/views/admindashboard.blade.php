<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moodles - Helpdesk</title>

    <link rel="shortcut icon" type="image/ico" href="./favicon.ico" />
</head>

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
                @if(count($projects) > 0)
                @foreach($projects as $pro)
                {{-- */$unread=0;/* --}}
                 {{-- */$i=0;/* --}}
                 {{-- */$x=0;/* --}}
                 {{-- */$y=0;/* --}}
                 {{-- */$krit=0;/* --}}
                 {{-- */$hoog=0;/* --}}
                 {{-- */$gem=0;/* --}}
                 {{-- */$laag=0;/* --}}
                 {{-- */$crit = '';/* --}}
                 {{-- */$high = '';/* --}}
                 {{-- */$avg = '';/* --}}
                 {{-- */$low = '';/* --}}
                 {{-- */$panel_type = '';/* --}}
                <div class="col-lg-2 col-md-6">

                @foreach($pro->bug as $bug)

                @if($bug->prioriteit == 4 && $bug->status != 'gesloten')
                {{-- */$crit='kritisch';/* --}}
                @elseif($bug->prioriteit == 3 && $bug->status != 'gesloten')
                {{-- */$high='hoog';/* --}}
                @elseif($bug->prioriteit == 2 && $bug->status != 'gesloten')
                {{-- */$avg='gemiddeld';/* --}}
                @elseif($bug->prioriteit == 1 && $bug->status != 'gesloten')
                {{-- */$low='laag';/* --}}
                @else
                @endif
                @endforeach


                @if($crit == 'kritisch')
                       {{-- */$panel_type='purple';/* --}}
                   @elseif($high == 'hoog')
                       {{-- */$panel_type='red';/* --}}
                   @elseif($avg == 'gemiddeld')
                       {{-- */$panel_type='yellow';/* --}}
                   @elseif($low == 'laag')
                       {{-- */$panel_type='green';/* --}}
                       @else
                       {{-- */$panel_type='default';/* --}}
                   @endif

                        <div class="panel panel-{{$panel_type}}">
                        <div class="panel-heading" style="padding-left:10px;padding-right:10px;">
                        <a href="/bugs/{{$pro->id}}">
                            <div class="row">
                                @foreach($bugs as $bug)
                                    @if($bug->last_client > 0)
                                        @if($bug->project_id == $pro->id)
                                        {{-- */$unread ++;/* --}}
                                        @endif
                                    @endif
                                    @if($bug->prioriteit == 1)
                                        @if($bug->project_id == $pro->id)
                                        {{-- */$laag++;/* --}}
                                        @endif
                                    @endif
                                    @if($bug->prioriteit == 2)
                                        @if($bug->project_id == $pro->id)
                                        {{-- */$gem++;/* --}}
                                        @endif
                                    @endif
                                    @if($bug->prioriteit == 3)
                                        @if($bug->project_id == $pro->id)
                                        {{-- */$hoog++;/* --}}
                                        @endif
                                    @endif
                                    @if($bug->prioriteit == 4)
                                        @if($bug->project_id == $pro->id)
                                        {{-- */$krit++;/* --}}
                                        @endif
                                    @endif
                                @endforeach
                                <div id='notificatie'><div>
                                {{$unread}}
                                </div></div>
                                <div class="col-xs-12 text-right pull-right">
                                <span style="border: solid #ffffff 1px;" class="label label-purple pull-left">{{$krit}}</span>

                                    <small><strong>{{substr($pro->projectnaam,0,15)}}..</strong></small>
                                    <div>
                                    <span style="border: solid #ffffff 1px;" class="label label-danger pull-left">{{$hoog}}</span><span class="badge">
                                    @foreach($bugs as $bug)
                                    @if($bug->status == 'open')
                                        @if($bug->project_id == $pro->id )
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
                                        @if($bug->project_id == $pro->id)
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
                                        @if($bug->project_id == $pro->id)
                                            {{-- */$y++/* --}}
                                        @endif
                                    @endif
                                    @endforeach
                                    {{$y}}
                                    </span> Gesloten</div>
                                </div>
                            </div>
                            </a>
                        </div>
                         <a href="/bugs/{{$pro->id}}">
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
                    <div class="col-lg-12">
                        <h4>Laatst gemelde feedback</h4>
                        <div class="table-responsive">
                        <table class="table table-hover data_table">
                                <thead>
                                <th>Gepost op </th>
                                <th>Status </th>
                                <th>Deadline</th>
                                <th>Feedback</th>
                                <th>Prioriteit</th>
                                <th>Klant</th>
                                <th>Project</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @if(count($bugs) > 0)
                                @foreach($bugs as $bug)

                                    <tr style="cursor:pointer;!important;" data-href="/bugchat/{{$bug->id}}">
                                        {{--@if($bug->updated_at == '0000-00-00 00:00:00')--}}
                                        {{--<td>{{$bug->created_at->format('d-m-y - H:i')}}</td>--}}
                                        {{--@else--}}
                                        {{--<td>{{$bug->updated_at->format('d-m-y - H:i')}}</td>--}}
                                        {{--@endif--}}
                                        <td>{{$bug->created_at->format('d-m-y - H:i')}}</td>
                                        <td>{{$bug->status}}</td>
                                        @if($bug->eind_datum == '0000-00-00 00:00:00')
                                        <td>Geen eind datum.</td>
                                        @else
                                        <td>{{date('d-m-y - H:i',strtotime($bug->eind_datum))}}</td>
                                        @endif
                                        <td>{{$bug->titel}}</td>
                                        <td>
                                        @if($bug->prioriteit == 1)
                                        <span class="label label-success">Laag</span>
                                        @elseif($bug->prioriteit == 2)
                                        <span class="label label-warning">Gemmideld</span>
                                        @elseif($bug->prioriteit == 3)
                                        <span class="label label-danger">Hoog</span>
                                        @elseif($bug->prioriteit == 4)
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
                                        <td class="text-right" >
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

            </div>
            </div>
            <!-- /.container-fluid -->

        <!-- /#page-wrapper -->
<!--</div>-->

    <!-- /#wrapper -->
    @section('scripts')
    <script type="text/javascript">
        setTimeout(function(){
        window.location.reload()
        }, 300000);
    </script>

    <script type="text/javascript">
       $('tr[data-href]').on("dblclick", function() {
            document.location = $(this).data('href');
        });
        $('tr button[data-target]').on("click", function() {
            document.location = $(this).data('target');
        });
    </script>

    @endsection

    @extends('layouts.footer')

</body>

</html>
