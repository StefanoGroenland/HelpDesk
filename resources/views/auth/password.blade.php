<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<div class="container">
<form method="POST" action="/auth/email">
     {!! csrf_field() !!}
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 well">
            <img src="{{URL::asset('../assets/images/logo.png')}}" class="img-responsive center-block" alt="Responsive image">
                <div class="form-group" style="margin-top:50px;!important;">
                         @if (count($errors))
                             <ul class="list-unstyled">
                                 @foreach($errors->all() as $error)
                                     <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                                 @endforeach
                             </ul>
                         @endif
                            @if(Session::has('status'))
                                <ul class="list-unstyled">
                                    <li class="alert alert-success"><i class="fa fa-info"></i> {{Session::get('status')}}</li>
                                </ul>
                            @endif
                         <div class="form-group">
                             <label>E-mail</label>
                             <input class="form-control" type="email" name="email" placeholder="Hier uw e-mailadres" value="{{ old('email') }}">
                         </div>
                         <div>
                             <button class="btn btn-success" type="submit">
                                 Herstel wachtwoord
                             </button>
                              <a class="pull-right" href="/">Ga terug</a>
                         </div>
                </div>

        </div>
        <div class="col-lg-4"></div>
    </div>

 </form>
 </div>



     @extends('layouts.footer')