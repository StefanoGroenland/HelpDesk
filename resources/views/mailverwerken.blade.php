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
				@foreach($message as $msg)
					<form method="POST" action="/postfeedback/{{$id}}" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Nieuwe feedback</h3>
							</div>
							<div class="panel-body">
							<div class="row">
							    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							    <h3>Afzender : {{$msg->from}}</h3>
							    </div>
							    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <label for="gebruiker_id">Koppel project</label>
                                    <select class="form-control"  id="project_id" name="project_id">
                                    <option value="geen">selecteer een klant</option>
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}" >{{$project->projectnaam }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                </div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label for="bedrijfsnaam">Feedback</label>
											<input type="text" class="form-control" id="titel" name="titel" required="true" placeholder="Titel"
											 value="@if(old('titel')){{old('titel')}} @else {{$msg->subject}} @endif">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label for="bedrijfsnaam">Prioriteit</label>
											<select data-toggle="tooltip" title="Wat voor prioriteit geeft u voor de fout?" class="form-control" name="prioriteit" required="true">
											<option @if(old('prioriteit') == 1)selected @endif value="1">Laag</option>
											<option @if(old('prioriteit') == 2)selected @endif value="2">Gemiddeld</option>
											<option @if(old('prioriteit') == 3)selected @endif value="3">Hoog</option>
											<option @if(old('prioriteit') == 4)selected @endif value="4">Kritisch</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label for="bedrijfsnaam">Categorie</label>
											<select  data-toggle="tooltip" title="In wat voor categorie valt de fout te herkennen?" class="form-control" name="soort" required="true">
											<option @if(old('soort') == "lay-out")selected @endif value="lay-out">Lay-out</option>
											<option @if(old('soort') == "seo")selected @endif value="seo">SEO</option>
											<option @if(old('soort') == "performance")selected @endif value="performance">Performance</option>
											<option @if(old('soort') == "code")selected @endif value="code">Code</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label for="end_date">Startdatum</label>
												<input data-toggle="tooltip" title="Wanneer heeft de fout zich als eerst voorgedaan?" type="text" name="start_datum" class="form_datetime form-control date-picker"
												    value="@if(old('start_datum')) {{date('d-m-Y H:i', strtotime(old('start_datum')))}} @else {{date('d-m-Y H:i', strtotime($msg->date))}} @endif"
												 data-rule-maxlength="30">
											</div>
										</div>
									</div>
									<div class="form-group">
										<textarea  class="form-control" rows="7" id="beschrijving"  name="beschrijving">@if(old('beschrijving')) {!! nl2br(old('beschrijving')) !!} @else {!! nl2br($msg->body) !!} @endif</textarea>

									</div>
									<button type="submit" class="btn btn-success pull-right"><span class="fa fa-plus" aria-hidden="true"></span> Toevoegen</button>
					</form>
					@endforeach
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
	@section('scripts')
	<script type="text/javascript" src="{{URL::asset('../assets/js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script>
	<script type="text/javascript" src="{{URL::asset('../assets/js/locales/bootstrap-datetimepicker.nl.js')}}" charset="UTF-8"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		       $(".form_datetime").datetimepicker({
		       language: 'nl',
		       weekStart: 1,
		       format: 'dd-mm-yyyy hh:ii',
		       autoclose: true
		       });
		});
	</script>
	@endsection
	@extends('layouts.footer')
	</body>
</html>