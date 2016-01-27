@extends('layouts.mail_temp')
@section('onderwerp')
Uw account staat klaar!
@endsection
@section('bericht')
<h4 class="page-header" >Welkom {{$volledige_naam}},</h4>
<p>Als klant bij <a href="http://www.moodles.nl">Moodles </a>is een account voor u klaargezet op <a href="http://helpdesk.moodles.nl">Moodles Helpdesk </a>
	<br>
	Hier kunt u eventuele problemen die zich voordoen op uw applicatie melden.
</p>
<br>
<div class="table-responsive">
	<table class="table" >
		<tr>
			<td colspan="2">Met onderstaande informatie kunt u aanmelden</td>
		</tr>
		<tr>
			<td><strong>Gebruikersnaam</strong></td>
			<td>{{$username}}</td>
		</tr>
		<tr>
			<td><strong>Wachtwoord</strong></td>
			<td>{{$password}}</td>
		</tr>
	</table>
</div>
<h5 class="page-header">
	Met vriendelijke groet,<br>
	Moodles helpdesk
</h5>
@endsection
@section('footer')
<p class="text-center" style="opacity:0.4;font-size:10px;" >
	Dit is een geautomatiseerd bericht die is verzonden na het aanmaken van uw account. 
</p>
@endsection