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
			<!-- /.row -->
			@if(Auth::user()->rol == 'medewerker')
			<div class="row">
				<div class="col-lg-12">
					<h3>Open feedback <small>Alle feedback met de status 'open' of 'bezig'</small></h3>
					<div class="table-responsive">
						<table class="table table-hover data_table">
							<thead>
								<th style="width: 5%"><i class="fa fa-hashtag"></i></th>
								<th style="width: 10%">Bedrijf</th>
								<th style="width: 15%">Feedback titel</th>
								<th style="width: 5%">Status</th>
								<th style="width: 5%">Soort</th>
								<th style="width: 10%">Prioriteit</th>
								<th style="width: 10%">Startdatum</th>
								<th style="width: 10%">Deadline</th>
								<th style="width: 10%">Gemeld door</th>
								<th style="width: 10%">Project</th>
								<th style="width: 10%"></th>
							</thead>
							<tbody>
								@foreach($bugs_all as $bug)
								@if($bug->project)
								@if($bug->project)
                                @if($bug->project_id == $bug->project->id && $bug->status != 'gesloten')
									<tr style="cursor:pointer;!important;" data-href="/bugchat/{{$bug->id}}">
                                        @if(Auth::user()->rol == 'medewerker' && $bug->last_client > 0 && $bug->status != 'gesloten')
                                    	<td  class="attention text-center" >{{$bug->id}}<br><i class="fa fa-exclamation-circle"></i></td>
                                    	@else
                                    	<td class="text-center">{{$bug->id}}</td>
                                    	@endif
									    <td>{{$bug->klant->bedrijf}}</td>
									    <td>{{substr($bug->titel,0,30)}} @if(strlen($bug->titel) > 30) ... @endif</td>
									    <td>{{strtoupper($bug->status)}}</td>
									    <td>{{$bug->soort}}</td>
									    <td>
                                            @if($bug->prioriteit == 1)
                                            <span class="label label-success"><span style="display:none;">4</span>Laag</span>
                                            @elseif($bug->prioriteit == 2)
                                            <span class="label label-warning"><span style="display:none;">3</span>Gemiddeld</span>
                                            @elseif($bug->prioriteit == 3)
                                            <span class="label label-danger"><span style="display:none;">2</span>Hoog</span>
                                            @elseif($bug->prioriteit == 4)
                                            <span class="label label-purple"><span style="display:none;">1</span>Kritisch</span>
                                            @else
                                            <span class="label label-info">Geen prioriteit</span>
                                            @endif
									    </td>
									<td>{{date('d-m-Y - H:i',strtotime($bug->start_datum))}}</td>
									@if($bug->eind_datum == '0000-00-00 00:00:00')
									    <td>Geen eind datum.</td>
									@else
									    <td>{{date('d-m-Y - H:i',strtotime($bug->eind_datum))}}</td>
									@endif
									@if($bug->melder)
									    <td>{{ucfirst($bug->melder->voornaam) .' '.$bug->melder->tussenvoegsel.' '. ucfirst($bug->melder->achternaam)}}</td>
									@endif
									<td>{{$bug->project->projectnaam}}</td>
									<td class="text-right" >
										<a href="/bugchat/{{$bug->id}}" class="">
										<button type="submit" class="btn btn-success">
										<i class="fa fa-comment-o"></i>
										</button>
										</a>
										@if(Auth::user()->rol == 'medewerker')
										<a href="/feedbackwijzigen/{{$bug->id}}">
										<button type="submit" class="btn btn-warning">
										<i class="fa fa-pencil"></i>
										</button>
										</a>
										<button type="button" class="btn btn-danger deleteButton" data-toggle="modal" data-modal-id="{{$bug->id}}" data-target="#myModal{{$bug->id}}">
										<i class="fa fa-trash"></i>
										</button>
										@endif
									</td>
								</tr>
								@endif
								@endif
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<h3>Gesloten feedback <small>Alle feedback met de status 'gesloten'</small></h3>
					<a class="btn btn-info" role="button" data-toggle="collapse" href="#collapseGesloten" aria-expanded="false" aria-controls="collapseGesloten">
                      <i class="fa fa-archive" > </i> Gesloten feedback bekijken
                    </a>
					<div class="table-responsive collapse" id="collapseGesloten">
					<br>
						<table class="table table-hover data_table">
							<thead>
								<th style="width: 5%"><i class="fa fa-hashtag"></i></th>
                                <th style="width: 10%">Bedrijf</th>
                                <th style="width: 15%">Feedback titel</th>
                                <th style="width: 5%">Status</th>
                                <th style="width: 5%">Soort</th>
                                <th style="width: 10%">Prioriteit</th>
                                <th style="width: 10%">Startdatum</th>
                                <th style="width: 10%">Deadline</th>
                                <th style="width: 10%">Gemeld door</th>
                                <th style="width: 10%">Project</th>
                                <th style="width: 10%"></th>
							</thead>
							<tbody>
								@foreach($bugs_all as $bug)
								@if($bug->project)
								@if($bug->project_id == $bug->project->id && $bug->status == 'gesloten')
                                    <tr style="cursor:pointer;!important;" data-href="/bugchat/{{$bug->id}}">
                                    @if(Auth::user()->rol == 'medewerker' && $bug->last_client > 0 && $bug->status == 'gesloten')
									<td class="text-center attention" >{{$bug->id}}<br><i class="fa fa-exclamation-circle"></i></td>
									@else
									<td class="text-center">{{$bug->id}}</td>
									@endif
									<td>{{$bug->klant->bedrijf}}</td>
									<td>{{substr($bug->titel,0,30)}} @if(strlen($bug->titel) > 30) ... @endif</td>
									<td>{{strtoupper($bug->status)}}</td>
									<td>{{$bug->soort}}</td>
									<td>
                                        @if($bug->prioriteit == 1)
                                        <span class="label label-success"><span style="display:none;">4</span>Laag</span>
                                        @elseif($bug->prioriteit == 2)
                                        <span class="label label-warning"><span style="display:none;">3</span>Gemiddeld</span>
                                        @elseif($bug->prioriteit == 3)
                                        <span class="label label-danger"><span style="display:none;">2</span>Hoog</span>
                                        @elseif($bug->prioriteit == 4)
                                        <span class="label label-purple"><span style="display:none;">1</span>Kritisch</span>
                                        @else
                                        <span class="label label-info">Geen prioriteit</span>
                                        @endif
									</td>
									<td>{{date('d-m-Y - H:i',strtotime($bug->start_datum))}}</td>
									@if($bug->eind_datum == '0000-00-00 00:00:00')
									<td>Geen eind datum.</td>
									@else
									<td>{{date('d-m-Y - H:i',strtotime($bug->eind_datum))}}</td>
									@endif
									@if($bug->melder)
									<td>{{ucfirst($bug->melder->voornaam) .' '.$bug->melder->tussenvoegsel.' '. ucfirst($bug->melder->achternaam)}}</td>
									@endif
									<td>{{$bug->project->projectnaam}}</td>
									<td class="text-right" >
										<a href="/bugchat/{{$bug->id}}" class="">
										<button type="submit" class="btn btn-success">
										<i class="fa fa-comment-o"></i>
										</button>
										</a>
										@if(Auth::user()->rol == 'medewerker')
										<a href="/feedbackwijzigen/{{$bug->id}}">
										<button type="submit" class="btn btn-warning">
										<i class="fa fa-pencil"></i>
										</button>
										</a>
										<button type="button" class="btn btn-danger deleteButton" data-toggle="modal" data-modal-id="{{$bug->id}}" data-target="#myModal{{$bug->id}}">
										<i class="fa fa-trash"></i>
										</button>
										@endif
									</td>
								</tr>
								@endif
								@endif
								@endforeach
								@else
								@foreach($projects as $project)
								<div class="row">
									<div class="col-lg-12">
										<h3 class="page-header">
											{{$project->projectnaam}} <small>alle bugs voor {{$project->projectnaam}}</small>
										</h3>
										<div class="table-responsive">
											<table class="table table-hover data_table">
												<thead>
													<th style="width: 5%"><i class="fa fa-hashtag"></i></th>
													<th style="width: 20%">Feedback titel</th>
													<th style="width: 5%">Status</th>
													<th style="width: 5%">Soort</th>
													<th style="width: 5%">Prioriteit</th>
													<th style="width: 10%">Startdatum</th>
													<th style="width: 10%">Deadline</th>
													<th style="width: 10%">Project</th>
													<th style="width: 10%"></th>
												</thead>
												<tbody>
													@foreach($bugs_all as $bug)
													@if($bug->project_id == $project->id)


														<tr style="cursor:pointer;!important;" data-href="/bugchat/{{$bug->id}}">
                                                        @if(Auth::user()->rol == 'klant' && $bug->last_admin > 0 && $bug->status != 'gesloten')
                                                        <td class="text-center attention" >{{$bug->id}}<br><i class="fa fa-exclamation-circle"></i></td>
                                                        @else
                                                        <td class="text-center">{{$bug->id}}</td>
                                                        @endif
														<td>{{substr($bug->titel,0,30)}} @if(strlen($bug->titel) > 30) ... @endif</td>
														<td>{{strtoupper($bug->status)}}</td>
														<td>{{$bug->soort}}</td>
														<td>
                                                            @if($bug->prioriteit == 1)
                                                            <span class="label label-success"><span style="display:none;">4</span>Laag</span>
                                                            @elseif($bug->prioriteit == 2)
                                                            <span class="label label-warning"><span style="display:none;">3</span>Gemiddeld</span>
                                                            @elseif($bug->prioriteit == 3)
                                                            <span class="label label-danger"><span style="display:none;">2</span>Hoog</span>
                                                            @elseif($bug->prioriteit == 4)
                                                            <span class="label label-purple"><span style="display:none;">1</span>Kritisch</span>
                                                            @else
                                                            <span class="label label-info">Geen prioriteit</span>
                                                            @endif
														</td>
														<td>{{date('d-m-Y - H:i',strtotime($bug->start_datum))}}</td>
														@if($bug->eind_datum == '0000-00-00 00:00:00')
														<td>Geen eind datum.</td>
														@else
														<td>{{date('d-m-Y - H:i',strtotime($bug->eind_datum))}}</td>
														@endif
														<td>{{$project->projectnaam}}</td>
														<td class="text-right">
															<a href="/bugchat/{{$bug->id}}">
															<button type="submit" class="btn btn-success">
															<i class="fa fa-comment-o"></i>
															</button>
															</a>
														</td>
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
	</div>
	@foreach($bugs_all as $key)
	<div class="modal fade" id="myModal{{$key->id}}" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Verwijder verzoek</h4>
				</div>
				<div class="modal-body">
					<p>Weet u zeker dat u <strong>{{$key->titel}}</strong> wilt verwijderen&hellip;</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
					<form method="POST" action="/verwijderBug/{{$key->id}}" >
						{!! method_field('DELETE') !!}
						{!! csrf_field() !!}
						<button type="submit" class="btn btn-danger pull-right">
						Verwijder feedback
						</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	@endforeach
	<!-- /#wrapper -->
	@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
		      $('.data_table').on("click",'tr[data-href]',  function() {
		         window.location.href = $(this).data('href');
		     });
		     $('.deleteButton').on("click", function(event) {
		
		         var modalId = $(this).data('modal-id');
		         event.stopPropagation();
		         jQuery.noConflict()
		         $('#myModal'+modalId).modal('show');
		     });
		})
		
	</script>
	@endsection
	@extends('layouts.footer')
	</body>
</html>