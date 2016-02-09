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
							<h3 class="panel-title">Wijzig project <small>alle velden met * zijn verplicht</small></h3>
						</div>
						<div class="panel-body">
							<form method="POST" action="/updateProject/{{$project->id}}">
								{!! csrf_field() !!}
								<input type="hidden" name="_method" value="PUT">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										@if($errors->has('projectnaam'))
                                        	<div class="form-group has-error">
                                        	@else
                                        	<div class="form-group">
                                        	@endif
											<label for="projectnaam2">Projectnaam *</label>
											<input type="text" class="form-control projectnaam2" required="true" id="projectnaam2" name="projectnaam" placeholder="Projectnaam"
											    value="@if(old('projectnaam')){{old('projectnaam')}}@else{{$project->projectnaam}}@endif">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										@if($errors->has('liveurl'))
                                        	<div class="form-group has-error">
                                        	@else
                                        	<div class="form-group">
                                        	@endif
											<label for="liveurl2">Live URL *</label>
											<input type="text" class="form-control projecturl2" required="true" id="liveurl2" name="liveurl" placeholder="Live URL"
											    value="@if(old('liveurl')){{old('liveurl')}}@else{{$project->liveurl}}@endif">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										@if($errors->has('developmenturl'))
                                        	<div class="form-group has-error">
                                        	@else
                                        	<div class="form-group">
                                        	@endif
											<label for="bedrijfsnaam">Development URL</label>
											<input type="text" class="form-control projecturl2" id="developmenturl2" name="developmenturl" placeholder="Development URL"
											    value="@if(old('developmenturl')){{old('developmenturl')}}@else{{$project->developmenturl}}@endif">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										@if($errors->has('gebruikersnaam'))
                                        	<div class="form-group has-error">
                                        	@else
                                        	<div class="form-group">
                                        	@endif
											<label for="bedrijfsnaam">Beheer account</label>
											<input type="text" class="form-control gebruikersnaam2"  id="gebruikersnaam2" name="gebruikersnaam" placeholder="Gebruikersnaam"
											    value="@if(old('gebruikersnaam')){{old('gebruikersnaam')}}@else{{$project->gebruikersnaam}}@endif">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										@if($errors->has('wachtwoord'))
                                        	<div class="form-group has-error">
                                        	@else
                                        	<div class="form-group">
                                        	@endif
											<label for="bedrijfsnaam">Beheer wachtwoord</label>
											<input type="text" class="form-control wachtwoord2" id="wachtwoord2" name="wachtwoord" placeholder="Wachtwoord"
											    value="{{Crypt::decrypt($project->wachtwoord)}}">
										</div>
									</div>
								</div>
								@if($errors->has('omschrijvingproject'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
								<label for="bedrijfsnaam">Omschrijving</label>
									<textarea class="form-control omschrijving2" rows="8" id="omschrijving2" name="omschrijvingproject">@if(old('omschrijvingproject')){!! nl2br(old('omschrijvingproject')) !!}@else{!! nl2br($project->omschrijvingproject) !!}@endif</textarea>
								</div>
								<button type="submit" class="btn btn-success pull-right"><span class="fa fa-check" aria-hidden="true"></span> Opslaan</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
	{{--@section('scripts')--}}
	{{--@stop--}}
	</div>
	<!-- /#wrapper -->
	@extends('layouts.footer')
	</body>
</html>