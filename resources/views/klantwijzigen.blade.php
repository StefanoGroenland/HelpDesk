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
                  <h1 class="page-header">
                      Klant wijzigen <small> hier kan een klant gewijzigd worden </small>
                      @include('layouts.header-controls')
                  </h1>
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
                          @if (count($errors))
                              <ul class="list-unstyled">
                                  @foreach($errors->all() as $error)
                                      <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                                  @endforeach
                              </ul>
                          @endif
          <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Verander klant</h3>
                                    </div>
                                    <div class="panel-body">
                                      <form method="POST" action="/updateKlant">
                                      {!! csrf_field() !!}
                                      <input type="hidden" name="_method" value="PUT">
                                      <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                          <label for="email">Email address</label>
                                          <input type="email" class="form-control" required="true" id="email2" name="email" placeholder="E-Mail" value="{{$klant->email}}">
                                          <input type="hidden" class="form-control id2" id="id2"  name="id" value="{{$klant->id}}">
                                        </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                          <label for="gebruikersnaam">Gebruikersnaam</label>
                                          <input type="text" class="form-control" required="true" id="gebruikersnaam2" name="username" placeholder="Gebruikersnaam"  value="{{$klant->username}}">
                                        </div>
                                        </div>
                                      </div>
                                       <div class="row">
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                         <div class="form-group">
                                           <label for="achternaam">Wachtwoord</label>
                                           <input type="password" class="form-control"  id="wachtwoord2" name="password" placeholder="Wachtwoord"  value="">
                                         </div>
                                         </div>
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                         <div class="form-group">
                                           <label for="achternaam">Herhaal wachtwoord</label>
                                           <input type="password" class="form-control"  id="wachtwoord2" name="password_confirmation" placeholder="Herhaal wachtwoord"  value="">
                                         </div>
                                         </div>
                                       </div>
                                       <div class="row">
                                         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                         <div class="form-group">
                                           <label for="voornaam">Voornaam</label>
                                           <input type="text" class="form-control" required="true" id="voornaam2" name="voornaam" placeholder="Voornaam"  value="{{$klant->voornaam}}">
                                         </div>
                                         </div>
                                         <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                         <div class="form-group">
                                           <label for="tussenvoegsel">Tussenvoegsel</label>
                                           <input type="text" class="form-control" id="tussenvoegsel2" name="tussenvoegsel" placeholder="Tussenvoegsel"  value="{{$klant->tussenvoegsel}}">
                                         </div>
                                         </div>
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                         <div class="form-group">
                                           <label for="achternaam">Achternaam</label>
                                           <input type="text" class="form-control" required="true" id="achternaam2" name="achternaam" placeholder="Achternaam"  value="{{$klant->achternaam}}">
                                         </div>
                                         </div>
                                       </div>
                                       <div class="row">
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                         <div class="form-group">
                                            <label for="achternaam">Bedrijf</label>
                                            <input type="text" class="form-control" required="true" id="bedrijf2" name="bedrijf" placeholder="Bedrijf"  value="{{$klant->bedrijf}}">
                                          </div>
                                         </div>
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                         @if($errors->has('telefoonnummer'))
                                           <div class="form-group has-error">
                                           @else
                                           <div class="form-group">
                                           @endif
                                           <label for="telefoonnummer">Telefoonnummer</label>
                                           <input type="text" class="form-control" required="true" id="telefoonnummer2" name="telefoonnummer" placeholder="Telefoonnummer" value="{{$klant->telefoonnummer}}">
                                         </div>
                                         </div>
                                       </div>
                                         <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                              <label for="geslacht">Geslacht</label>
                                                <select class="form-control" id="geslacht2" required="true" name="geslacht">
                                                <option value="man" @if($klant->geslacht == 'man') selected @endif >Man</option>
                                                <option value="vrouw" @if($klant->geslacht == 'vrouw') selected @endif >Vrouw</option>
                                                </select>
                                              </div>
                                            </div>
                                         </div>


                                         <div class="row">
                                           <div class="col-lg-12"><button type="submit" name="veranderGebruiker" class="btn btn-default center-block"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Opslaan</button></div>
                                         </div>
                                      </form>
                                    </div>
                                  </div>
              </div>
          </div>
      </div>
             <!-- /.container-fluid -->
         </div>
         <!-- /#page-wrapper -->

         {{--@section('scripts')--}}


         {{--@stop--}}

     </div>
     <!-- /#wrapper -->

     @extends('layouts.footer')

 </body>

 </html>
