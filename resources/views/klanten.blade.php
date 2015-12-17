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
                          <th>Naam</th>
                          <th>E-mail</th>
                          <th>Bedrijf</th>
                          <th></th>
                          <th></th>
                          </thead>
                          <tbody>
                              @foreach($klanten as $klant)
                              <tr>
                              <td>{{$klant->voornaam . ' ' . substr($klant->tussenvoegsel,0,5) . ' ' . $klant->achternaam}}</td>
                              <td>{{$klant->email}}</td>
                              <td>{{$klant->bedrijf}}</td>
                              <td>
                                 <a href="/klantmuteren/{{$klant->id}}" class="">
                                   <button class="btn btn-success btn-xs wijzigKnop2" name="zoekProject" type="button" data-project="{{$klant->email}}">
                                          <i class="glyphicon glyphicon-pencil"></i>
                                   </button>
                                   </a>
                              </td>
                                <td>
                                <a href="/verwijderGebruiker/{{$klant->id}}" class="">
                                    <button type="submit" class="btn btn-danger btn-xs">
                                       <i class="glyphicon glyphicon-remove"></i>
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
         <!-- /#page-wrapper -->

         @section('scripts')


         @stop

     </div>
     <!-- /#wrapper -->

     @extends('layouts.footer')

 </body>

 </html>
