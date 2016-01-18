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
                            Project toevoegen <small>Hier kan een project toegevoegd worden</small>
                            @include('layouts.header-controls')
                        </h1>
                        {{--breadcrumbs layout spot!--}}
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
                    <div class="col-lg-6">

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Project gegevens</h3>
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="/addProject">
                             {!! csrf_field() !!}
                            <div class="form-group">
                            <label for="sel4">Project gegevens</label>
                              <input type="text" class="form-control" id="projectnaam" required="true" name="projectnaam" placeholder="Projectnaam" value="{{old('projectnaam')}}">
                            </div>
                            <div class="form-group">
                              <input data-toggle="tooltip" title="Live URL / Productie URL van ons is dit bijvoorbeeld helpdesk.moodles.nl" type="text" class="form-control" id="projecturl" required="true" name="liveurl" placeholder="Productie URL" value="{{old('liveurl')}}">
                            </div>
                            <div class="form-group">
                              <input data-toggle="tooltip" title="Development URL van ons is dit bijvoorbeeld dev.helpdesk.moodles.nl/admin Let op! : voeg de link toe naar het beheerpaneel" type="text" class="form-control" id="projecturl" name="developmenturl" placeholder="Development URL" value="{{old('developmenturl')}}">
                            </div>
                            <div class="form-group">
                               <label for="sel4">Beheer account</label>
                              <input data-toggle="tooltip" title="Met dit account moet toegang zijn op het beheerderspaneel van de website!" type="text" class="form-control" id="gebruikersnaam" required="true" name="gebruikersnaam" placeholder="Gebruikersnaam" value="{{old('gebruikersnaam')}}">
                            </div>
                             <div class="form-group">
                              <input data-toggle="tooltip" title="Wachtwoord voor bovenstaand Beheer account." type="text" class="form-control" id="wachtwoord" required="true" name="wachtwoord" placeholder="Wachtwoord" value="{{old('wachtwoord')}}">
                            </div>
                            <div class="form-group">
                               <textarea class="form-control" rows="13" id="omschrijvingproject" name="omschrijvingproject">{{old('omschrijvingproject')}}</textarea>
                             </div>


                           </div>
                         </div>
                    </div>
                    <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Klant gegevens</h3>
                        </div>
                        <div class="panel-body">

                        <div class="form-group">
                          <label class="radio-inline">
                            <input type="radio" name="radkoppel" id="radkoppel" value="koppel_klant"> Koppel klant
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="radmaak" id="radmaak" value="maak_klant" checked> Nieuwe klant
                          </label>
                        </div>


                        <div class="form-group" >
                            <label for="gebruiker_id">Koppel klant</label>
                            <select class="form-control"  id="gebruiker_id" name="gebruiker_id" disabled>
                                @foreach($klanten as $klant)
                                <option value="{{$klant->id}}" >{{$klant->voornaam.' '.$klant->achternaam.' #'. $klant->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <fieldset id="fieldset-klant" >
                                <div class="form-group">
                                      <label for="sel4">Nieuwe klant</label>
                                      <input type="gebruikersnaam" class="form-control" id="username" required="true" name="username" placeholder="Gebruikersnaam" value="{{old('username')}}">
                                </div>
                                @if($errors->has('password'))
                                <div class="form-group has-error">
                                @else
                                <div class="form-group">
                                @endif
                                     <input type="password" class="form-control" id="password" required="true" name="password" placeholder="Wachtwoord">
                                </div>
                                @if($errors->has('password'))
                                <div class="form-group has-error">
                                @else
                                <div class="form-group">
                                @endif
                                     <input type="password" class="form-control" id="password_confirmation" required="true" name="password_confirmation" placeholder="Herhaal wachtwoord">
                                </div>
                                @if($errors->has('email'))
                                <div class="form-group has-error">
                                @else
                                <div class="form-group">
                                @endif
                                     <input type="email" class="form-control" id="email" required="true" name="email" placeholder="E-mail" value="{{old('email')}}">
                                </div>
                                @if($errors->has('bedrijf'))
                                <div class="form-group has-error">
                                @else
                                <div class="form-group">
                                @endif
                                     <input type="text" class="form-control" id="bedrijf"  name="bedrijf" placeholder="Bedrijf" value="{{old('bedrijf')}}">
                                </div>
                                <div class="form-group">
                                     <input type="text" class="form-control" id="voornaam" required="true" name="voornaam" placeholder="Voornaam" value="{{old('voornaam')}}">
                                </div>
                                <div class="form-group">
                                     <input type="text" class="form-control" id="tussenvoegsel"  name="tussenvoegsel" placeholder="Tussenvoegsel" value="{{old('tussenvoegsel')}}">
                                </div>
                                <div class="form-group">
                                     <input type="text" class="form-control" id="achternaam" required="true" name="achternaam" placeholder="Achternaam" value="{{old('achternaam')}}">
                                </div>
                                <div class="form-group">
                                     <select class="form-control"  id="geslacht" name="geslacht">
                                         <option value="man" >Man</option>
                                         <option value="vrouw" >Vrouw</option>
                                     </select>
                                </div>
                                @if($errors->has('telefoonnummer'))
                                <div class="form-group has-error">
                                @else
                                <div class="form-group">
                                @endif
                                     <input type="text" class="form-control" id="telefoonnummer" maxlength="11" required="true" name="telefoonnummer" placeholder="Telefoon nummer" value="{{old('telefoonnummer')}}">
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-default center-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Toevoegen</button>
                          </div>
                       </div>

                    </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
            @section('scripts')
                                <script type="text/javascript">
                                            $("#radkoppel").on("click",function(){
                                               $('#fieldset-klant').prop('disabled',true)
                                               $('#gebruiker_id').prop('disabled',false)
                                               $('#radmaak').prop('checked',false)
                                            });
                                            $("#radmaak").on("click",function(){
                                               $('#fieldset-klant').prop('disabled',false)
                                               $('#gebruiker_id').prop('disabled',true)
                                               $('#radkoppel').prop('checked',false)
                                            });

                     </script>
                    @stop
    </div>
    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
