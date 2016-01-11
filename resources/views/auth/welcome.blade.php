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
            <div class="container">
                    <form method="POST" action="/auth/login">
                     {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 well">
                                <img src="{{URL::asset('../assets/images/logo.png')}}" class="img-responsive center-block" alt="Responsive image">
                                <div class="form-group">
                                @if (count($errors))
                                    <ul class="list-unstyled">
                                        @foreach($errors->all() as $error)
                                            <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                    <label for="gebruikersnaam">Gebrukersnaam</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Gebrukersnaam" value="{{old('username')}}">
                                </div>
                                <div class="form-group">
                                    <label for="wachtwoord">Wachtwoord</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord">
                                </div>
                                <button type="submit" class="btn btn-success">Aanmelden</button>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                  </form>
            </div>
            <!-- /.container-fluid -->

        @extends('layouts.footer')

</body>

</html>
