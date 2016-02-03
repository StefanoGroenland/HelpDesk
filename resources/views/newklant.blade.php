<!DOCTYPE html>
<html lang="en">
	@include('layouts.header')
	@extends('layouts.top-links')
	<div id="page-wrapper">
	<div class="container-fluid">
	<!-- Page Heading -->
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
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Nieuwe klant</h3>
			</div>
			<div class="panel-body">
				<form method="POST" action="/addUser" >
					{!! csrf_field() !!}
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							@if($errors->has('email'))
							<div class="form-group has-error">
								@else
								<div class="form-group">
									@endif
									<label for="email">E-mail</label>
									<input type="email" class="form-control" required="true" id="email" name="email" placeholder="Email" value="{{old('email')}}">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								@if($errors->has('username'))
								<div class="form-group has-error">
									@else
									<div class="form-group">
										@endif
										<label for="gebruikersnaam">Gebruikersnaam</label>
										<input type="text" class="form-control" required="true" id="gebruikersnaam" name="username" placeholder="Gebruikersnaam" value="{{old('username')}}">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									@if($errors->has('password'))
									<div class="form-group has-error">
										@else
										<div class="form-group">
											@endif
											<label for="wachtwoord">Wachtwoord</label>
											<input type="password" class="form-control" required="true" id="wachtwoord" name="password" placeholder="Wachtwoord">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										@if($errors->has('password'))
										<div class="form-group has-error">
											@else
											<div class="form-group">
												@endif
												<label for="wachtwoord">Herhaal wachtwoord</label>
												<input type="password" class="form-control" required="true" id="wachtwoord" name="password_confirmation" placeholder="Herhaal wachtwoord">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="form-group">
												<label for="voornaam">Voornaam</label>
												<input type="text" class="form-control" required="true" id="voornaam" name="voornaam" placeholder="Voornaam" value="{{old('voornaam')}}">
											</div>
										</div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<div class="form-group">
												<label for="tussenvoegsel">Tussenvoegsel</label>
												<input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel" placeholder="Tussenvoegsel"  value="{{old('tussenvoegsel')}}">
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="form-group">
												<label for="achternaam">Achternaam</label>
												<input type="text" class="form-control" required="true" id="achternaam" name="achternaam" placeholder="Achternaam" value="{{old('achternaam')}}">
											</div>
										</div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label for="achternaam">Geslacht</label>
											<div class="form-group">
												<label class="radio-inline">
												<input type="radio" name="radman" id="radman" checked> Man
												</label>
												<label class="radio-inline">
												<input type="radio" name="radvrouw" id="radvrouw" > Vrouw
												</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											@if($errors->has('telefoonnummer'))
											<div class="form-group has-error">
												@else
												<div class="form-group">
													@endif
													<label for="telefoonnummer">Telefoonnummer</label>
													<input type="text" class="form-control" required="true" id="telefoonnummer" maxlength="10" name="telefoonnummer" placeholder="Telefoonnummer" value="{{old('telefoonnummer')}}">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												@if($errors->has('bedrijf'))
												<div class="form-group has-error">
													@else
													<div class="form-group">
														@endif
														<label for="achternaam">Bedrijf</label>
														<input type="text" class="form-control" required="true" id="bedrijf" name="bedrijf" placeholder="Bedrijf" value="{{old('bedrijf')}}">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12"><button type="submit" class="btn btn-success pull-right"><span class="fa fa-plus" aria-hidden="true"></span> Toevoegen</button></div>
											</div>
				</form>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
		@section('scripts')
		<script type="text/javascript">
			$("#zoekKnop").on("click",function(){
			
			
			        var email = $('#zoekmail').val();
			        $('#email2').val('');
			        $('#gebruikersnaam2').val('');
			        $('#voornaam2').val('');
			        $('#tussenvoegsel2').val('');
			        $('#achternaam2').val('');
			        $('#telefoonnummer2').val('');
			        $('#geslacht2').val('');
			
			        $.ajax({
			          method: "POST",
			          url: "/updateData",
			          data: {   email: email ,
			                    _token: "{{ csrf_token() }}"
			                }
			        })
			          .done(function( msg ) {
			            $('#email2').val(msg[0].email);
			            $('#gebruikersnaam2').val(msg[0].username);
			            $('#voornaam2').val(msg[0].voornaam);
			            $('#tussenvoegsel2').val(msg[0].tussenvoegsel);
			            $('#achternaam2').val(msg[0].achternaam);
			            $('#telefoonnummer2').val(msg[0].telefoonnummer);
			            $('#geslacht2').val(msg[0].geslacht);
			          });
			});
		</script>
		<script type="text/javascript">
			$("#radvrouw").on("click",function(){
			   $('#radman').prop('checked',false)
			});
			$("#radman").on("click",function(){
			   $('#radvrouw').prop('checked',false)
			});
		</script>
		@stop
	</div>
	<!-- /#wrapper -->
	@extends('layouts.footer')
	</body>
</html>