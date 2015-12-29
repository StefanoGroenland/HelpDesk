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
                      Klanten<small> een overzicht van alle klanten.</small>
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

             <!-- /.container-fluid -->
            <div class="col-lg-12">
                  <div class="table-responsive">
                      <table class="table table-hover data_table" >
                          <thead>
                          <th>Voornaam</th>
                          <th>Tussenvoegsel</th>
                          <th>Achternaam</th>
                          <th>Gebruikersnaam</th>
                          <th>Geslacht</th>
                          <th>E-mail</th>
                          <th>Telefoonnummer</th>
                          <th>Bedrijf</th>
                          <th></th>
                          </thead>
                          <tbody>
                              @foreach($klanten as $klant)
                              <tr>
                              <td>{{$klant->voornaam}}</td>
                              @if($klant->tussenvoegsel)
                                <td>{{$klant->tussenvoegsel}}</td>
                              @else
                              geen
                              @endif
                              <td>{{$klant->achternaam}}</td>
                              <td>{{$klant->username}}</td>
                              <td>{{$klant->geslacht}}</td>
                              <td>{{$klant->email}}</td>
                              <td>{{$klant->telefoonnummer}}</td>
                              <td>{{$klant->bedrijf}}</td>
                              <td>
                                 <a href="/klantmuteren/{{$klant->id}}" class="">
                                   <button class="btn btn-success btn-xs wijzigKnop2" name="zoekProject" type="button" data-project="{{$klant->email}}">
                                          <i class="glyphicon glyphicon-pencil"></i>
                                   </button>
                                   </a>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$klant->id}}">
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


         @foreach($klanten as $key)
                 <div class="modal fade" id="myModal{{$key->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Verwijder verzoek</h4>
                                </div>
                                <div class="modal-body">
                                  <p>Weet u zeker dat u de klant : <strong>{{$key->voornaam}}</strong> wilt verwijderen&hellip;</p>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default btn-xs pull-right" data-dismiss="modal">Close</button>
                                  <form method="POST" action="/verwijderGebruiker/{{$key->id}}" >
                                  {!! method_field('DELETE') !!}
                                  {!! csrf_field() !!}
                                  <button type="submit" class="btn btn-danger btn-xs pull-left">
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


         @stop

     </div>
     <!-- /#wrapper -->

     @extends('layouts.footer')

 </body>

 </html>
