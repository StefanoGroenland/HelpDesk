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
                <div class="row">
                    <div class="col-lg-6">

                      <div class="panel panel-green">
                        <div class="panel-heading">
                          <h3 class="panel-title">Profiel</h3>
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="/updateProfiel">
                          {!! csrf_field() !!}
                          <input type="hidden" name="_method" value="PUT">
                          <input type="hidden" class="form-control id2" id="id2"  name="id" value="{{$user->id}}">
                            <img src="assets/images/avatar.png" alt="gfxuser" class="img-circle center-block">
                            <div class="form-group center-block">
                            <label class="center-block text-center" for="fotoinput">Kies uw foto</label>
                            <input class="center-block" type="file"  name="profielfoto" id="profielfoto">
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-lg-6">
                      <div class="panel panel-green">
                        <div class="panel-heading">
                          <h3 class="panel-title">Mijn gegevens</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                              <label for="email">Email address</label>
                              <input type="email" class="form-control" required="true" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                              <label for="gebruikersnaam">Gebruikersnaam</label>
                              <input type="text" class="form-control" required="true" name="username" value="{{$user->username}}">
                            </div>
                            <div class="form-group">
                              <label for="wachtwoord">Wachtwoord</label>
                              <input type="password" class="form-control" required="true" name="password" value="{{$user->password}}">
                            </div>
                              <div class="form-group">
                              <label for="voornaam">Voornaam</label>
                              <input type="text" class="form-control" required="true" name="voornaam" value="{{$user->voornaam}}">
                            </div>
                            <div class="form-group">
                               <label for="voornaam">Tussenvoegsel</label>
                               <input type="text" class="form-control" name="tussenvoegsel" value="{{$user->tussenvoegsel}}">
                             </div>
                            <div class="form-group">
                              <label for="achternaam">Achternaam</label>
                              <input type="text" class="form-control" required="true" name="achternaam" value="{{$user->achternaam}}">
                            </div>
                            <div class="form-group">
                            <label for="geslacht">Geslacht</label>
                              <select class="form-control" id="geslacht2" required="true" name="geslacht">
                                <option value="{{$user->geslacht}}">{{$user->geslacht}}</option>
                                <option value="man">Man</option>
                                <option value="vrouw">Vrouw</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="bedrijfsnaam">Bedrijfsnaam</label>
                              <input type="text" class="form-control" required="true" name="bedrijf" value="{{$user->bedrijf}}">
                            </div>
                            <div class="form-group">
                              <label for="bedrijfsnaam">Telefoonnummer</label>
                              <input type="text" class="form-control" required="true" name="telefoonnummer" value="{{$user->telefoonnummer}}">
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
