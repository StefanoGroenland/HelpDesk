<!DOCTYPE html>
<html lang="en">
	@include('layouts.header')
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
					<div class="form-group" style="margin-top:10px;!important;">
						<label>Email</label>
						<input class="form-control" type="email" name="email" value="{{ old('email') }}">
					</div>
					<div class="form-group">
						<label>Nieuw wachtwoord</label>
						<input class="form-control" type="password" name="password">
					</div>
					<div class="form-group">
						<label>Herhaal wachtwoord</label>
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