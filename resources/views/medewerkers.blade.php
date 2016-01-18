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
                     Medewerkers <small> een overzicht van alle medewerkers.</small>
                     @include('layouts.header-controls')
                 </h1>
                  <a href="../newmedewerker" class="pull-left" style="margin-bottom: 25px;!important;">
                      <button type="submit" class="btn btn-warning btn-xs">
                         <i class="glyphicon glyphicon-plus"></i>
                         Medewerker toevoegen
                      </button>
                  </a>
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
         <div class="row">

             <div class="col-lg-12">
                 <div class="table-responsive">
                     <table class="table table-hover data_table">
                         <thead>
                         <th style="width: 10%">Voornaam</th>
                         <th style="width: 5%">Tussenvoegsel</th>
                         <th style="width: 10%">Achternaam</th>
                         <th style="width: 10%">Gebruikersnaam</th>
                         <th style="width: 10%">Geslacht</th>
                         <th style="width: 10%">E-mail</th>
                         <th style="width: 10%">Telefoonummer</th>
                         <th style="width: 10%"></th>
                         </thead>
                         <tbody>
                             @foreach($medewerkers as $medewerker)
                             <tr style="cursor:pointer;!important;" data-href="/medewerkermuteren/{{$medewerker->id}}">
                             <td>{{ucfirst($medewerker->voornaam)}}</td>
                             @if($medewerker->tussenvoegsel)
                             <td>{{$medewerker->tussenvoegsel}}</td>
                             @else
                             <td>geen</td>
                             @endif
                             <td>{{ucfirst($medewerker->achternaam)}}</td>
                             <td>{{$medewerker->username}}</td>
                             <td>{{$medewerker->geslacht}}</td>
                             <td>{{$medewerker->email}}</td>
                             <td>{{$medewerker->telefoonnummer}}</td>
                             <td class="text-right">
                                <a href="/medewerkermuteren/{{$medewerker->id}}" class="">
                                  <button class="btn btn-success btn-xs wijzigKnop2" name="zoekProject" type="button" data-project="{{$medewerker->email}}">
                                         <i class="glyphicon glyphicon-pencil"></i>
                                  </button>
                               </a>
                               <button type="button" class="btn btn-danger btn-xs deleteButton" data-toggle="modal" data-modal-id="{{$medewerker->id}}" data-target="#myModal{{$medewerker->id}}">
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
        <!-- /#page-wrapper -->
    </div>
    @foreach($medewerkers as $key)
                     <div class="modal fade" id="myModal{{$key->id}}" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title">Verwijder verzoek</h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Weet u zeker dat u de medewerker : <strong>{{$key->voornaam}}</strong> wilt verwijderen&hellip;</p>

                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <form method="POST" action="/verwijderGebruiker/{{$key->id}}" >
                                      {!! method_field('DELETE') !!}
                                      {!! csrf_field() !!}
                                      <button type="submit" class="btn btn-danger pull-right">
                                         {{--<i class="glyphicon glyphicon-trash"></i>--}}
                                         Verwijder medewerker
                                      </button>
                                      </form>
                                    </div>
                                  </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                              </div><!-- /.modal -->
                              @endforeach
    <!-- /#wrapper -->

    @extends('layouts.footer')
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

</body>

</html>
