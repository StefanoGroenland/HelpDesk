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
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            {{$project->projectnaam}} <small>alle bugs van dit project</small>
                        </h3>
                        <a href="/bugmuteren/{{$project->id}}" class="pull-left">
                            <button type="submit" class="btn btn-info btn-xs">
                               <i class="glyphicon glyphicon-plus"></i>
                               Bugmelden
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
                        <th style="width: 10%">Bug nummer</th>
                        <th style="width: 10%">Bug titel</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 10%">Soort</th>
                        <th style="width: 10%">Prioriteit</th>
                        <th style="width: 10%">Deadline</th>
                        <th style="width: 10%">Gemeld door</th>
                        <th style="width: 10%">Project</th>
                        <th style="width: 10%"></th>
                        </thead>
                        <tbody>
                            @foreach($bugs as $bug)

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
                                        @if($bug->eind_datum == '0000-00-00 00:00:00')
                                        <td>Geen eind datum.</td>
                                        @else
                                        <td>{{date('d-m-y - H:i',strtotime($bug->eind_datum))}}</td>
                                        @endif
                                        @if($bug->klant)
                                        <td>{{ucfirst($bug->klant->voornaam) .' '.$bug->klant->tussenvoegsel.' '. ucfirst($bug->klant->achternaam)}}</td>
                                        @endif
                                        <td>{{$bug->project->projectnaam}}</td>
                                        <td>
                                            <a href="/bugchat/{{$bug->id}}" class="">
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