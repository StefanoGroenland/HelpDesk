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
                      Klanten<small> een overzicht van alle klanten.</small>
                      @include('layouts.header-controls')
                  </h1>

                  <a href="../newklant" class="pull-left" style="margin-bottom: 25px;!important;">
                      <button type="submit" class="btn btn-success">
                         <i class="glyphicon glyphicon-plus"></i>
                         Klant toevoegen
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

             <!-- /.container-fluid -->
             <div class="row">
            <div class="col-lg-12">
                  <div class="table-responsive">
                      <table class="table table-hover data_table" >
                          <thead>
                          <th style="width: 10%">Voornaam</th>
                          <th style="width: 5%">Tussenvoegsel</th>
                          <th style="width: 10%">Achternaam</th>
                          <th style="width: 10%">Gebruikersnaam</th>
                          <th style="width: 5%">Geslacht</th>
                          <th style="width: 10%">E-mail</th>
                          <th style="width: 10%">Telefoonnummer</th>
                          <th style="width: 10%">Bedrijf</th>
                          <th style="width: 10%"></th>
                          </thead>
                          <tbody>
                              @foreach($klanten as $klant)
                              <tr style="cursor:pointer;!important;" data-href="/klantwijzigen/{{$klant->id}}" >
                              <td>{{ucfirst($klant->voornaam)}}</td>
                              @if($klant->tussenvoegsel)
                                <td>{{$klant->tussenvoegsel}}</td>
                              @else
                              <td>geen</td>
                              @endif
                              <td>{{ucfirst($klant->achternaam)}}</td>
                              <td>{{$klant->username}}</td>
                              <td>{{$klant->geslacht}}</td>
                              <td>{{$klant->email}}</td>
                              <td>{{$klant->telefoonnummer}}</td>
                              <td>{{$klant->bedrijf}}</td>
                              <td class="text-right">
                                 <a href="/klantwijzigen/{{$klant->id}}" class="">
                                   <button class="btn btn-success btn-xs wijzigKnop2" name="zoekProject" type="button" data-project="{{$klant->email}}">
                                          <i class="glyphicon glyphicon-pencil"></i>
                                   </button>
                                   </a>
                                <button type="button" class="btn btn-danger btn-xs deleteButton" data-toggle="modal" data-modal-id="{{$klant->id}}" data-target="#myModal{{$klant->id}}">
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


         @foreach($klanten as $key)
                 <div class="modal fade" id="myModal{{$key->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Verwijder verzoek</h4>
                                </div>
                                <div class="modal-body">
                                  <p>Weet u zeker dat u <strong>{{$key->voornaam}}</strong> wilt verwijderen&hellip;</p>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                                  <form method="POST" action="/verwijderGebruiker/{{$key->id}}" >
                                  {!! method_field('DELETE') !!}
                                  {!! csrf_field() !!}
                                  <button type="submit" class="btn btn-danger pull-right">
                                     {{--<i class="glyphicon glyphicon-trash"></i>--}}
                                     Verwijder klant
                                  </button>
                                  </form>

                                </div>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                          @endforeach

         <!-- /#page-wrapper -->
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

     </div>
     <!-- /#wrapper -->

     @extends('layouts.footer')

 </body>

 </html>
