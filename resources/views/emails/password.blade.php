@extends('layouts.mail_temp')
@section('onderwerp')
Wachtwoord herstel
@endsection
@section('bericht')
<h4 class="page-header" >Beste {{$user->voornaam}},</h4>
<p>Onlangs is er een aanvraag ingediend om uw wachtwoord te resetten,<br>
	Door op de knop : <a href="{{ url('auth/reset/'.$token) }}"><button class="btn btn-success btn-xs" >Herstel uw wachtwoord</button></a>
	te drukken. Kunt u uw wachtwoord aanpassen.<br>
</p>
<h5 class="page-header">
	Met vriendelijke groet,<br>
	Moodles helpdesk
</h5>
@endsection
@section('footer')
<p class="text-center" style="opacity:0.4;font-size:10px;" >
	Mocht u zelf niet deze aanvraag gedaan te hebben kunt u deze e-mail negeren. Uw account blijft veilig<br>
	Dit is een geautomatiseerd bericht die wordt verzonden zodra er een aanvraag tot wachtwoord herstellen voorkomt. 
</p>
@endsection