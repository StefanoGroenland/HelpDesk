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
                            Project wijzigen <small>Hier kan een project worden veranderd/aangemaakt worden</small>
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
                    <div class="col-lg-4">

                      <div class="panel panel-green">
                        <div class="panel-heading">
                          <h3 class="panel-title">Nieuw project</h3>
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
                                  <input type="text" class="form-control" id="wachtwoord" required="true" name="wachtwoord" placeholder="Wachtwoord" value="">
                                </div>

                               <div class="form-group">
                                    <label for="sel4">Koppel klant</label>
                                    <select class="form-control"  id="gebruiker_id" name="gebruiker_id">
                                        @foreach($klanten as $klant)
                                        <option value="{{$klant->id}}" >{{$klant->voornaam.' '.$klant->achternaam.' #'. $klant->id }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            <div class="form-group">
                               <textarea class="form-control" rows="5" id="omschrijvingproject" required="true" name="omschrijvingproject" value="" ></textarea>
                             </div>

                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Maak</button>
                          </form>
                        </div>
                      </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <h3 class="panel-title">Verander project</h3>
                          </div>
                          <div class="panel-body">
                            <form method="POST" action="/updateProject">
                                               {!! csrf_field() !!}
                                               <input type="hidden" name="_method" value="PUT">
                                                 <div class="form-group">
                                                   <div class="input-group">
                                                     <input type="text" required="true" id="zoeknaam" name="zoeknaam" class="form-control" placeholder="Projectnaam">
                                                     <span class="input-group-btn">
                                                       <button class="btn btn-default" id="zoekKnop2" name="zoekProject" type="button">Zoek project</button>
                                                     </span>
                                                   </div>
                                                 </div>
                            <div class="form-group">
                                <label for="bedrijfsnaam">Project</label>
                               <input type="text" class="form-control" id="titel2" name="titel" placeholder="Titel">
                             </div>
                             <div class="form-group">
                                 <select class="form-control" id="status2" name="status" required="true">
                                   <option value="open">Open</option>
                                   <option value="bezig">Bezig</option>
                                   <option value="gesloten">Gesloten</option>
                                 </select>
                               </div>
                               <div class="form-group">
                                 <select class="form-control" id="prioriteit2" required="true" name="prioriteit">
                                   <option value="laag">Laag</option>
                                   <option value="gemiddeld">Gemiddeld</option>
                                   <option value="hoog">Hoog</option>
                                   <option value="kritisch">Kritisch</option>
                                 </select>
                               </div>
                               <div class="form-group">
                                <select class="form-control" id="soort2" required="true" name="soort">
                                  <option value="lay-out">Lay-out</option>
                                  <option value="seo">SEO</option>
                                  <option value="performance">Performance</option>
                                  <option value="code">Code</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="projectnaam2" name="projectnaam" placeholder="Projectnaam" value="">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="projecturl2" name="projecturl" placeholder="Project URL" value="">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Gebruiker</label>
                                <input type="text" class="form-control" id="gebruikersnaam2" name="gebruikersnaam" placeholder="gebruikersnaam" value="">
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control" id="wachtwoord2" name="wachtwoord" placeholder="Wachtwoord" value="">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Contactpersoon</label>
                                <input type="text" class="form-control" id="voornaam2" name="voornaam" placeholder="Voornaam" value="">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="achternaam2"name="achternaam" placeholder="Achternaam" value="">
                              </div>
                                <div class="form-group">
                                <input type="email" class="form-control" id="email2" name="email" placeholder="E-mail" value="">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Bedrijf</label>
                                <input type="text" class="form-control" id="bedrijf2" name="bedrijf" placeholder="Bedrijfsnaam" value="">
                              </div>
                                <div class="form-group">
                                <input type="text" class="form-control" id="telefoonnummer2" name="telefoonnummer" placeholder="Telefoon nummer" value="">
                              </div>
                              <div class="form-group">
                                 <textarea class="form-control" rows="5" id="omschrijving2" name="omschrijvingproject" value="" ></textarea>
                               </div>

                              <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Verander</button>
                            </form>
                            </div>
                           </div>

                         </div>
                    <div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <th>Project</th>
                                <th>URL</th>
                                <th>Klantnummer</th>
                                <th></th>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                      <tr>
                                      <td>{{$project->projectnaam}}</td>
                                      <td>{{$project->projecturl}}</td>
                                      <td>{{$project->gebruiker_id}}</td>
                                      <td>
                                      <a href="/verwijderProject/{{$project->id}}" class="">
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
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
            @section('scripts')
                    <script type="text/javascript">
                        $("#zoekKnop2").on("click",function(){


                                var email = $('#zoeknaam').val();
                                $('#titel2').val('');
                                $('#status2').val('');
                                $('#prioriteit2').val('');
                                $('#type2').val('');
                                $('#projectnaam2').val('');
                                $('#projecturl2').val('');
                                $('#gebruikersnaam2').val('');
                                $('#wachtwoord2').val('');
                                $('#voornaam2').val('');
                                $('#achternaam2').val('');
                                $('#email2').val('');
                                $('#bedrijf2').val('');
                                $('#telefoonnummer2').val('');
                                $('#omschrijving2').val('');

                                $.ajax({
                                  method: "POST",
                                  url: "/updateProjectData",
                                  data: {   input: email ,
                                            _token: "{{ csrf_token() }}"
                                        }
                                })
                                  .done(function( msg ) {
                                    $('#titel2').val(msg[0].titel);
                                    $('#status2').val(msg[0].status);
                                    $('#prioriteit2').val(msg[0].prioriteit);
                                    $('#soort2').val(msg[0].soort);
                                    $('#projectnaam2').val(msg[0].projectnaam);
                                    $('#projecturl2').val(msg[0].projecturl);
                                    $('#gebruikersnaam2').val(msg[0].gebruikersnaam);
                                    $('#wachtwoord2').val(msg[0].wachtwoord);
                                    $('#voornaam2').val(msg[0].voornaam);
                                    $('#achternaam2').val(msg[0].achternaam);
                                    $('#email2').val(msg[0].email);
                                    $('#bedrijf2').val(msg[0].bedrijf);
                                    $('#telefoonnummer2').val(msg[0].telefoonnummer);
                                    $('#omschrijving2').val(msg[0].omschrijvingproject);
                                  });
                        });
                    </script>
                    @stop
    </div>
    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
