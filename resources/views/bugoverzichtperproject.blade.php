<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moodles - Helpdesk</title>

    <link rel="shortcut icon" type="image/ico" href="../../favicon.ico" />
</head>

    @extends('layouts.top-links')
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                            @if(Auth::user()->bedrijf != 'moodles')
                            <ol class="breadcrumb">
                                @include('layouts.breadcrumbs')
                            </ol>
                            @endif
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
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            {{$project->projectnaam}} <small>alle feedback van dit project</small>
                        </h3>
                        <a href="/feedbackmelden/{{$project->id}}" class="pull-left">
                            <button type="submit" class="btn btn-success">
                               <i class="glyphicon glyphicon-plus"></i>
                               Feedback toevoegen
                            </button>
                        </a>
                    </div>
                </div>

                    <div class="row">
                     <div class="col-lg-12">
                     <br>
                      <div class="table-responsive">
                       <table class="table table-hover data_table">
                        <thead>
                        <th style="width: 10%"><i class="fa fa-hashtag"></i></th>
                        <th style="width: 10%">Feedback titel</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 10%">Soort</th>
                        <th style="width: 10%">Prioriteit</th>
                        <th style="width: 10%">Startdatum</th>
                        <th style="width: 10%">Deadline</th>
                        <th style="width: 10%">Gemeld door</th>
                        <th style="width: 10%">Project</th>
                        <th style="width: 10%"></th>
                        </thead>
                        <tbody>
                            @foreach($bugs as $bug)

                                    <tr style="cursor:pointer;!important;" data-href="/bugchat/{{$bug->id}}" >
                                        @if(Auth::user()->bedrijf == 'moodles' && $bug->last_client > 0)
                                        <td>{{$bug->id}}<i class="fa fa-exclamation" style="color:red"></i></td>
                                        @elseif(Auth::user()->bedrijf != 'moodles' && $bug->last_admin > 0)
                                        <td>{{$bug->id}}<i class="fa fa-exclamation" style="color:red"></i></td>
                                        @else
                                        <td>{{$bug->id}}</td>
                                        @endif
                                        <td>{{substr($bug->titel,0,15)}}...</td>
                                        <td>{{$bug->status}}</td>
                                        <td>{{$bug->soort}}</td>
                                        <td>
                                        @if($bug->prioriteit == 1)
                                        <span class="label label-success">Laag</span>
                                        @elseif($bug->prioriteit == 2)
                                        <span class="label label-warning">Gemiddeld</span>
                                        @elseif($bug->prioriteit == 3)
                                        <span class="label label-danger">Hoog</span>
                                        @elseif($bug->prioriteit == 4)
                                        <span class="label label-purple">Kritisch</span>
                                        @else
                                        <span class="label label-info">Geen prioriteit</span>
                                        @endif
                                        </td>
                                        <td>{{date('d-m-Y - H:i',strtotime($bug->start_datum))}}</td>
                                        @if($bug->eind_datum == '0000-00-00 00:00:00')
                                        <td>Geen eind datum.</td>
                                        @else
                                        <td>{{date('d-m-Y - H:i',strtotime($bug->eind_datum))}}</td>
                                        @endif
                                        @if($bug->klant)
                                        <td>{{ucfirst($bug->klant->voornaam) .' '.$bug->klant->tussenvoegsel.' '. ucfirst($bug->klant->achternaam)}}</td>
                                        @endif
                                        <td>{{$bug->project->projectnaam}}</td>
                                        <td class="text-right" >
                                            <a href="/bugchat/{{$bug->id}}" class="">
                                                <button type="submit" class="btn btn-success btn-xs">
                                                    <i class="glyphicon glyphicon-search"></i>
                                                </button>
                                            </a>
                                            @if(Auth::user()->bedrijf == 'moodles')
                                            <button type="button" class="btn btn-danger btn-xs deleteButton" data-toggle="modal" data-modal-id="{{$bug->id}}" data-target="#myModal{{$bug->id}}">
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
                   </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>

    @foreach($bugs as $key)
                     <div class="modal fade" id="myModal{{$key->id}}" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title">Verwijder verzoek</h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Weet u zeker dat u feedback met id : <strong>{{$key->id}}</strong> wilt verwijderen&hellip;</p>

                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                                      <form method="POST" action="/verwijderBug/{{$key->id}}" >
                                      {!! method_field('DELETE') !!}
                                      {!! csrf_field() !!}
                                      <button type="submit" class="btn btn-danger btn-xs pull-right">
                                         {{--<i class="glyphicon glyphicon-trash"></i>--}}
                                         Verwijder feedback
                                      </button>
                                      </form>
                                    </div>
                                  </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                              </div><!-- /.modal -->
                              @endforeach
    <!-- /#wrapper -->
    @section('scripts')
         <script type="text/javascript">
            $(document).ready(function() {
                  $('.data_table').on("click",'tr[data-href]',  function() {
                     window.location.href = $(this).data('href');
                 });
         $('.deleteButton').on("click", function(event) {

                     var modalId = $(this).data('modal-id');
                     event.stopPropagation();
                     jQuery.noConflict()
                     $('#myModal'+modalId).modal('show');
                 });
            })
         </script>
        @endsection
   @extends('layouts.footer')

</body>

</html>