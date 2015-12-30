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
                          <h3 class="panel-title">Profiel</h3>
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="/profiel/upload" files="true" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                          <input type="hidden" name="_method" value="PUT">
                          <input type="hidden" class="form-control id2" id="id2"  name="id" value="{{$user->id}}">
                            <img src="
                            @if(!$user->profielfoto)
                            {{"../assets/images/avatar.png"}}
                            @else
                            {{$user->profielfoto}}
                            @endif
                            "
                            alt="gfxuser" class="img-responsive center-block">
                            <div class="form-group center-block text-center">
                            <label class="center-block text-center" for="fotoinput">Kies uw foto</label>
                            {{--<input class="center-block" type="file"  name="profielfoto" id="profielfoto">--}}
                            <span class="btn btn-default btn-file text-center">
                                <i class="fa fa-search" ></i> Verkenner<input type="file" name="profielfoto" id="profielfoto" style="color:transparent;" onchange="this.style.color = 'transparant';">
                            </span>
                          </div>
                          <button type="submit" class="btn btn-default center-block"><span class="fa fa-check" aria-hidden="true"></span> Verander foto</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                    <form method="POST" action="/updateProfiel">
                          {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="PUT">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Mijn gegevens</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                              <label for="email">Email address</label>
                                <input type="hidden" class="form-control id2" id="id2"  name="id" value="{{$user->id}}">
                              <input type="email" class="form-control" required="true" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                              <label for="gebruikersnaam">Gebruikersnaam</label>
                              <input type="text" class="form-control" required="true" name="username" value="{{$user->username}}">
                            </div>
                            <div class="form-group">
                              <label for="wachtwoord">Wachtwoord</label>
                              <input type="password" class="form-control" name="password" >
                            </div>
                            <div class="form-group">
                               <label for="wachtwoord">Herhaal wachtwoord</label>
                               <input type="password" class="form-control" name="password_confirmation" >
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
                              <option value="man" @if($user->geslacht == 'man') selected @endif >Man</option>
                              <option value="vrouw" @if($user->geslacht == 'vrouw') selected @endif >Vrouw</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="bedrijfsnaam">Bedrijfsnaam</label>
                              <input type="text" class="form-control" required="true" name="bedrijf" value="{{$user->bedrijf}}">
                            </div>
                            @if($errors->has('telefoonnummer'))
                            <div class="form-group has-error">
                            @else
                            <div class="form-group">
                            @endif
                              <label for="bedrijfsnaam">Telefoonnummer</label>
                              <input type="text" class="form-control" required="true" name="telefoonnummer" value="{{$user->telefoonnummer}}">
                            </div>
                            <button type="submit" class="btn btn-default center-block"><span class="fa fa-check" aria-hidden="true"></span> Verander profiel</button>
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
