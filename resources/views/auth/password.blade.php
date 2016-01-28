<!DOCTYPE html>
<html lang="en">
<style>
.light-opacity{
        /*border: 2px solid #ffffff;!important;*/
        background-color: rgba(255,255,255,0.6);!important;
}
</style>
@include('layouts.header')
@include('layouts.top-links')
<img src="{{URL::asset('../assets/images/logo.png')}}" class="img-responsive center-block" alt="Responsive image">
<br>
<div class="container">
<form method="POST" action="/auth/email">
     {!! csrf_field() !!}
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4"></div>
        <div class="col-lg-4 col-md-4 col-sm-4 well light-opacity">

                <div class="form-group">
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
                             <button class="btn btn-default pull-right" type="submit">
                                 Herstel wachtwoord
                             </button>
                         </div>
                </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4"></div>
    </div>
    <div class="row">
                             <div class="col-lg-4 col-md-4 col-sm-4"></div>
                             <div class="col-lg-4 col-md-4 col-sm-4"><a class="pull-right" href="/" style="color:#fff;font-size:11px;margin-top:-10px;">Ga terug</a></div>
                             <div class="col-lg-4 col-md-4 col-sm-4"></div>
                            </div>

 </form>
 </div>



     @extends('layouts.footer')