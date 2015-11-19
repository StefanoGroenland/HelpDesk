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
                        Bug muteren <small>muteer een bug</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li class="active">
                            <i class="fa fa-users"></i> Bug muteren
                        </li>
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
                                <div class="form-group">
                                    <label for="voornaam">Beschrijving</label>
                                    <textarea class="form-control" rows="6"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12"><button type="submit" class="btn btn-success center-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Maak</button></div>
                                </div>
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
