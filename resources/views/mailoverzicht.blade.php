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
			<div class="row">
				<div class="col-lg-12">
					<h3>E-mail feedback <small>Alle feedback rechtstreeks uit de mail</small></h3>
					<div class="table-responsive">
						<table class="table table-hover data_table">
							<thead>
								<th style="width: 5%"><i class="fa fa-hashtag"></i></th>
								<th style="width: 5%">Afzender</th>
								<th style="width: 10%">Feedback titel</th>
								<th style="width: 10%">Ontvangen op</th>
								<th style="width: 10%">Omschrijving</th>
								<th style="width: 10%"></th>
							</thead>
							<tbody>
								@foreach($messages as $message)

								<tr style="cursor:pointer;!important;" data-href="/mailverwerken/{{$message->id}}">
                                    <td>{{$message->id}}</td>
                                    <td>{{$message->from}}</td>
                                    <td>{{$message->subject}}</td>
                                    <td>{{date('d-m-Y H:i:s', strtotime($message->date))}}</td>
                                    <td>{{substr($message->body,0,25)}}</td>
									<td class="text-right" >
										<a href="/mailverwerken/{{$message->id}}" class="">
										<button type="submit" class="btn btn-success">
										<i class="fa fa-pencil"></i>
										</button>
										</a>
										<button type="button" class="btn btn-danger deleteButton" data-toggle="modal" data-modal-id="{{$message->id}}" data-target="#myModal{{$message->id}}">
										<i class="fa fa-trash"></i>
										</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
	</div>


	@foreach($messages as $key)
	<div class="modal fade" id="myModal{{$key->id}}" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Verwijder verzoek</h4>
				</div>
				<div class="modal-body">
					<p>Weet u zeker dat u <strong>{{$key->subject}}</strong> wilt verwijderen&hellip;</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
					<form method="POST" action="/verwijderMail/{{$key->id}}" >
						{!! method_field('DELETE') !!}
						{!! csrf_field() !!}
						<button type="submit" class="btn btn-danger pull-right">
						Verwijder mail
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