<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moodles - Helpdesk</title>
</head>

<div class="container">
<div class="col-lg-4"></div>
<div class="col-lg-4 well">

<form method="POST" action="/auth/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">
    <img src="{{URL::asset('../assets/images/logo.png')}}" class="img-responsive center-block" alt="Responsive image">
                <div class="form-group">
    @if (count($errors))
        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="form-group">
        Email
        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        Nieuw wachtwoord
        <input class="form-control" type="password" name="password">
    </div>
    <div class="form-group">
        Herhaal wachtwoord
        <input class="form-control" type="password" name="password_confirmation">
    </div>
    <div>
        <button class="btn btn-success" type="submit">
            Herstel wachtwoord
        </button>
        </div>

    </div>
</form>



</div>
<div class="col-lg-4"></div>


</div>


     @extends('layouts.footer')