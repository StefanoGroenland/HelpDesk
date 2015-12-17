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
                            Project wijzigen <small>Hier kan een project aangemaakt worden</small>
                            @include('layouts.header-controls')
                        </h1>
                        {{--breadcrumbs layout spot!--}}
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
                <div class="row">
                <div class="col-lg-2"></div>
                    <div class="col-lg-4">

                      <div class="panel panel-success">
                        <div class="panel-heading">
                          <h3 class="panel-title">Nieuw project 1/2</h3>
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="/addProject" >
                             {!! csrf_field() !!}
                          <div class="form-group">
                              <label for="bedrijfsnaam">Project</label>
                             <input type="text" class="form-control" id="titel" name="titel" required="true" placeholder="Titel">
                           </div>
                           <div class="form-group">
                              <select class="form-control" id="status" name="status" required="true">
                                <option value="open">Open</option>
                                <option value="bezig">Bezig</option>
                                <option value="gesloten">Gesloten</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control" id="prioriteit" required="true" name="prioriteit">
                                <option value="laag">Laag</option>
                                <option value="gemiddeld">Gemiddeld</option>
                                <option value="hoog">Hoog</option>
                                <option value="kritisch">Kritisch</option>
                              </select>
                            </div>
                            <div class="form-group">
                             <select class="form-control" id="soort" required="true" name="soort">
                               <option value="lay-out">Lay-out</option>
                               <option value="seo">SEO</option>
                               <option value="performance">Performance</option>
                               <option value="code">Code</option>
                             </select>
                           </div>
                            <div class="form-group">
                              <input type="text" class="form-control" id="projectnaam" required="true" name="projectnaam" placeholder="Projectnaam" value="">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" id="projecturl" required="true" name="projecturl" placeholder="Project URL" value="">
                            </div>
                            <div class="form-group">
                                    <label for="sel4">Beheer account</label>
                                  <input type="text" class="form-control" id="gebruikersnaam" required="true" name="gebruikersnaam" placeholder="Gebruikersnaam" value="">
                                </div>
                                 <div class="form-group">
                                  <input type="password" class="form-control" id="wachtwoord" required="true" name="wachtwoord" placeholder="Wachtwoord" value="">
                                </div>
                            <div class="form-group">
                               <textarea class="form-control" rows="5" id="omschrijvingproject" required="true" name="omschrijvingproject" value="" ></textarea>
                             </div>


                           </div>
                         </div>
                    </div>
                    <div class="col-lg-4">

                    <div class="panel panel-success">
                        <div class="panel-heading">
                          <h3 class="panel-title">Nieuw project 2/2</h3>
                        </div>
                        <div class="panel-body">

                        <div class="form-group">
                          <label class="radio-inline">
                            <input type="radio" name="radkoppel" id="radkoppel" value="koppel_klant"> Koppel klant
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="radmaak" id="radmaak" value="maak_klant" checked> Maak klant
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
                                      <input type="gebruikersnaam" class="form-control" id="username" required="true" name="username" placeholder="Gebruikersnaam" value="">
                                </div>
                                <div class="form-group">
                                     <input type="password" class="form-control" id="password" required="true" name="password" placeholder="Wachtwoord" value="">
                                </div>
                                <div class="form-group">
                                     <input type="email" class="form-control" id="email" required="true" name="email" placeholder="E-mail" value="">
                                </div>
                                <div class="form-group">
                                     <input type="text" class="form-control" id="bedrijf"  name="bedrijf" placeholder="Bedrijf" value="">
                                </div>
                                <div class="form-group">
                                     <input type="text" class="form-control" id="voornaam" required="true" name="voornaam" placeholder="Voornaam" value="">
                                </div>
                                <div class="form-group">
                                     <input type="text" class="form-control" id="tussenvoegsel"  name="tussenvoegsel" placeholder="Tussenvoegsel" value="">
                                </div>
                                <div class="form-group">
                                     <input type="text" class="form-control" id="achternaam" required="true" name="achternaam" placeholder="Achternaam" value="">
                                </div>
                                <div class="form-group">
                                     <select class="form-control"  id="geslacht" name="geslacht">
                                         <option value="man" >Man</option>
                                         <option value="vrouw" >Vrouw</option>
                                     </select>
                                </div>
                                <div class="form-group">
                                     <input type="text" class="form-control" id="telefoonnummer" required="true" name="telefoonnummer" placeholder="Telefoon nummer" value="">
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-success center-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Maak</button>
                          </div>
                       </div>

                    </form>
                    </div>
                    <div class="col-lg-2"></div>



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
