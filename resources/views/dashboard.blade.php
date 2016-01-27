<!DOCTYPE html>
<html lang="en">
	@include('layouts.header')
	@include('layouts.top-links')
	<div id="page-wrapper" >
		<div class="container-fluid">
			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h4 class="page-header">
						@if(Auth::user()->rol == 'medewerker')
						Projecten
						@else
						Mijn projecten
						@endif
					</h4>
				</div>
				@include('layouts.projectendashboard')
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				@include('layouts.feedbacktable')
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
	<!--</div>-->
	<!-- /#wrapper -->
	<script type="text/javascript">
		function myFunction() {
		    location.reload();
		}setInterval(function(){myFunction()}, 300000);
	</script>
	@extends('layouts.footer')
	</body>
</html>