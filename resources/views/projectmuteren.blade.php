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

</head>

<body>

    <div id="page-wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Moodles Helpdesk</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{URL::to('/profiel')}}"><i class="fa fa-fw fa-user"></i> Profiel</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Project muteren <small>Muteer projecten</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-users"></i> Project muteren
                            </li>
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
                          <form>
                            <div class="form-group">
                              <label for="project">Project</label>
                              <input type="text" class="form-control" id="email" placeholder="Projectnaam">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" id="gebruikersnaam" placeholder="Project URL">
                            </div>
                              <div class="form-group">
                              <label for="gebruiker">Gebruiker</label>
                              <input type="text" class="form-control" id="voornaam" placeholder="gebruikersnaam">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" id="wachtwoord" placeholder="Wachtwoord">
                            </div>
                              <div class="form-group">
                              <label for="voornaam">Contact persoon</label>
                              <input type="text" class="form-control" id="achternaam" placeholder="Voornaam">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" id="achternaam" placeholder="Achternaam">
                            </div>
                              <div class="form-group">
                              <input type="email" class="form-control" id="achternaam" placeholder="E-mail">
                            </div>
                              <div class="form-group">
                              <label for="bedrijfsnaam">Bedrijf</label>
                              <input type="text" class="form-control" id="bedrijfsnaam" placeholder="Bedrijfsnaam">
                            </div>
                              <div class="form-group">
                              <input type="text" class="form-control" id="bedrijfsnaam" placeholder="Telefoon nummer">
                            </div>

                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Maak de klant</button>
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
                          <form>
                              <div class="form-group">
                              <div class="input-group">
                                <input type="email" class="form-control" placeholder="Projectnaam">
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button">Zoek project</button>
                                </span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="project">Project</label>
                              <input type="text" class="form-control" id="email" placeholder="Projectnaam">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" id="gebruikersnaam" placeholder="Project URL">
                            </div>
                              <div class="form-group">
                              <label for="gebruiker">Gebruiker</label>
                              <input type="text" class="form-control" id="voornaam" placeholder="gebruikersnaam">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" id="wachtwoord" placeholder="Wachtwoord">
                            </div>
                              <div class="form-group">
                              <label for="voornaam">Contact persoon</label>
                              <input type="text" class="form-control" id="achternaam" placeholder="Voornaam">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" id="achternaam" placeholder="Achternaam">
                            </div>
                              <div class="form-group">
                              <input type="email" class="form-control" id="achternaam" placeholder="E-mail">
                            </div>
                              <div class="form-group">
                              <label for="bedrijfsnaam">Bedrijf</label>
                              <input type="text" class="form-control" id="bedrijfsnaam" placeholder="Bedrijfsnaam">
                            </div>
                              <div class="form-group">
                              <input type="text" class="form-control" id="bedrijfsnaam" placeholder="Telefoon nummer">
                            </div>
                                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Maak de klant</button>
                                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Verwijder de klant</button>
                                    <button type="submit" class="btn btn-warning">Annuleer</button>
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
                                    <tr>
                                        <td>Moodles Helpdesk</td>
                                        <td>www.moodles.nl/helpdesk</td>
                                        <td>Moodles</td>
                                        <td>
                                            <a href="#" class="">
                                        <button type="submit" class="btn btn-success btn-xs">
                                            <i class="fa fa-check "></i>
                                        </button>
                                        </a>
                                        <button class="btn btn-danger btn-xs">
                                                <i class="fa fa-remove"></i>
                                        </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Moodles</td>
                                        <td>www.moodles.nl</td>
                                        <td>Moodles</td>
                                        <td>
                                            <a href="#" class="">
                                        <button type="submit" class="btn btn-success btn-xs">
                                            <i class="fa fa-check "></i>
                                        </button>
                                        </a>
                                        <button class="btn btn-danger btn-xs">
                                                <i class="fa fa-remove"></i>
                                        </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Google Mail</td>
                                        <td>mail.google.nl</td>
                                        <td>Google</td>
                                        <td>
                                            <a href="#" class="">
                                        <button type="submit" class="btn btn-success btn-xs">
                                            <i class="fa fa-check "></i>
                                        </button>
                                        </a>
                                        <button class="btn btn-danger btn-xs">
                                                <i class="fa fa-remove"></i>
                                        </button>
                                        </td>
                                    </tr>
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
