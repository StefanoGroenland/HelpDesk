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
                             <select class="form-control" id="type" name="type" required="true">
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
                              <label for="bedrijfsnaam">Gebruiker</label>
                              <input type="text" class="form-control" id="gebruikersnaam" required="true" name="gebruikersnaam" placeholder="gebruikersnaam" value="">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" id="wachtwoord" required="true" name="wachtwoord" placeholder="Wachtwoord" value="">
                            </div>
                              <div class="form-group">
                              <label for="bedrijfsnaam">Contactpersoon</label>
                              <input type="text" class="form-control" id="voornaam" required="true" name="voornaam" placeholder="Voornaam" value="">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" id="achternaam" required="true" name="achternaam" placeholder="Achternaam" value="">
                            </div>
                              <div class="form-group">
                              <input type="email" class="form-control" id="email" required="true" name="email" placeholder="E-mail" value="">
                            </div>
                              <div class="form-group">
                              <label for="bedrijfsnaam">Bedrijf</label>
                              <input type="text" class="form-control" id="bedrijf" required="true" name="bedrijf" placeholder="Bedrijfsnaam" value="">
                            </div>
                              <div class="form-group">
                              <input type="text" class="form-control" id="telefoonnummer" required="true" name="telefoonnummer" placeholder="Telefoon nummer" value="">
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
                            <form method="POST" action="/">
                                               {!! csrf_field() !!}
                                               <input type="hidden" name="_method" value="PUT">
                                                 <div class="form-group">
                                                   <div class="input-group">
                                                     <input type="text" required="true" id="zoeknaam" name="zoeknaam" class="form-control" placeholder="Projectnaam">
                                                     <span class="input-group-btn">
                                                       <button class="btn btn-default" id="zoekKnop" name="zoekProject" type="button">Zoek project</button>
                                                     </span>
                                                   </div>
                                                 </div>
                            <div class="form-group">
                                <label for="bedrijfsnaam">Project</label>
                               <input type="text" class="form-control" id="titel2" placeholder="Titel">
                             </div>
                             <div class="form-group">
                                <select class="form-control" id="status2">
                                  <option value="open_status">Open</option>
                                  <option value="bezig_status">Bezig</option>
                                  <option value="gesloten_status">Gesloten</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="form-control" id="prioriteit2">
                                  <option value="open_status">Laag</option>
                                  <option value="bezig_status">Gemiddeld</option>
                                  <option value="gesloten_status">Hoog</option>
                                  <option value="gesloten_status">Kritisch</option>
                                </select>
                              </div>
                              <div class="form-group">
                               <select class="form-control" id="type2">
                                 <option value="open_status">Lay-out</option>
                                 <option value="bezig_status">SEO</option>
                                 <option value="gesloten_status">Performance</option>
                                 <option value="gesloten_status">Code</option>
                               </select>
                             </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="projectnaam2" placeholder="Projectnaam" value="">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="projecturl2" placeholder="Project URL" value="">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Gebruiker</label>
                                <input type="text" class="form-control" id="gebruikersnaam2" placeholder="gebruikersnaam" value="">
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control" id="wachtwoord2" placeholder="Wachtwoord" value="">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Contactpersoon</label>
                                <input type="text" class="form-control" id="voornaam2" placeholder="Voornaam" value="">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="achternaam2" placeholder="Achternaam" value="">
                              </div>
                                <div class="form-group">
                                <input type="email" class="form-control" id="email2" placeholder="E-mail" value="">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Bedrijf</label>
                                <input type="text" class="form-control" id="bedrijfsnaam2" placeholder="Bedrijfsnaam" value="">
                              </div>
                                <div class="form-group">
                                <input type="text" class="form-control" id="telefoonnummer2" placeholder="Telefoon nummer" value="">
                              </div>
                              <div class="form-group">
                                 <textarea class="form-control" rows="5" id="omschrijving2" value="" ></textarea>
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
                                <th>Bedrijf</th>
                                <th></th>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                      <tr>
                                      <td>{{$project->projectnaam}}</td>
                                      <td>{{$project->projecturl}}</td>
                                      <td>{{$project->bedrijf}}</td>
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

    </div>
    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
