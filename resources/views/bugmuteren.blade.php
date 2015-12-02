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
                        Bug melden <small>meld een bug</small>
                    </h1>
                    <ol class="breadcrumb">
                        @include(Auth::user()->bedrijf == 'moodles' ? 'layouts.adminbreadcrumbs' : 'layouts.breadcrumbs')
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">

                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nieuwe bug</h3>
                        </div>
                        <div class="panel-body">
                            <form>
                            <div class="form-group">
                                <label for="bedrijfsnaam">Project</label>
                               <input type="text" class="form-control" id="titel" placeholder="Titel">
                             </div>
                              <div class="form-group">
                                <select class="form-control">
                                  <option value="geen_prio">Prioriteit</option>
                                  <option value="laag">Laag</option>
                                  <option value="gemiddeld">Gemiddeld</option>
                                  <option value="hoog">Hoog</option>
                                  <option value="kritisch">Kritisch</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="form-control">
                                  <option value="geen_prio">Soort</option>
                                  <option value="laag">Laag</option>
                                  <option value="gemiddeld">Gemiddeld</option>
                                  <option value="hoog">Hoog</option>
                                  <option value="kritisch">Kritisch</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="projectnaam" placeholder="Projectnaam">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="project_url" placeholder="Project URL">
                              </div>
                              <div class="form-group">
                              <label for="start_date">Startdatum</label>
                                <input type="date" class="form-control" value="{{date('Y-m-d')}}" id="startdatum">
                              </div>
                              <div class="form-group">
                              <label for="start_date">Einddatum</label>
                                <input type="datetime-local" class="form-control" id="einddatum">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Gebruiker</label>
                                <input type="text" class="form-control" id="username" placeholder="gebruikersnaam">
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="Wachtwoord">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Contactpersoon</label>
                                <input type="text" class="form-control" id="voornaam" placeholder="Voornaam">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="achternaam" placeholder="Achternaam">
                              </div>
                                <div class="form-group">
                                <input type="email" class="form-control" id="email" placeholder="E-mail">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Bedrijf</label>
                                <input type="text" class="form-control" id="bedrijfsnaam" placeholder="Bedrijfsnaam">
                              </div>
                                <div class="form-group">
                                <input type="text" class="form-control" id="bedrijfsnaam" placeholder="Telefoon nummer">
                              </div>
                              <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Maak</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
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
