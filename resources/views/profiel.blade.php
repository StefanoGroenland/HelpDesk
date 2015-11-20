<?php
?>


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
                            Mijn profiel <small>profiel wijzigen</small>
                        </h1>
                        <ol class="breadcrumb">
                            @include(Auth::user()->bedrijf == 'moodles' ? 'layouts.adminbreadcrumbs' : 'layouts.breadcrumbs')
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">

                      <div class="panel panel-green">
                        <div class="panel-heading">
                          <h3 class="panel-title">Profiel</h3>
                        </div>
                        <div class="panel-body">
                          <form>
                            <img src="assets/images/avatar.png" alt="gfxuser" class="img-circle center-block">
                            <div class="form-group center-block">
                            <label class="center-block text-center" for="fotoinput">Kies uw foto</label>
                            <input class="center-block" type="file" id="exampleInputFile">
                          </div>
                            <button type="submit" class="btn btn-success center-block"><span class="fa fa-check" aria-hidden="true"></span> Verander foto</button>
                          </form>
                        </div>
                      </div>

                    </div>
                    <div class="col-lg-6">

                      <div class="panel panel-green">
                        <div class="panel-heading">
                          <h3 class="panel-title">Mijn gegevens</h3>
                        </div>
                        <div class="panel-body">
                          <form>
                            <div class="form-group">
                              <label for="email">Email address</label>
                              <input type="email" class="form-control" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                              <label for="gebruikersnaam">Gebruikersnaam</label>
                              <input type="text" class="form-control" id="gebruikersnaam" placeholder="Gebruikersnaam">
                            </div>
                            <div class="form-group">
                              <label for="wachtwoord">Wachtwoord</label>
                              <input type="password" class="form-control" id="wachtwoord" placeholder="Wachtwoord">
                            </div>
                              <div class="form-group">
                              <label for="voornaam">Voornaam</label>
                              <input type="text" class="form-control" id="voornaam" placeholder="Voornaam">
                            </div>
                            <div class="form-group">
                              <label for="achternaam">Achternaam</label>
                              <input type="text" class="form-control" id="achternaam" placeholder="Achternaam">
                            </div>
                            <div class="form-group">
                              <label for="bedrijfsnaam">Bedrijfsnaam</label>
                              <input type="text" class="form-control" id="bedrijfsnaam" placeholder="Bedrijfsnaam">
                            </div>

                            <button type="submit" class="btn btn-success"><span class="fa fa-check" aria-hidden="true"></span> Verander profiel</button>
                          </form>
                        </div>
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
