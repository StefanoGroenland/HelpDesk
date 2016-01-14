@extends('layouts.mail_temp')

@section('onderwerp')
Wachtwoord herstel.
@endsection

@section('bericht')

<h4 class="page-header" >Beste klant,</h4>

<p>Onlangs is er een aanvraag ingediend om uw wachtwoord aan te resetten,<br>
Door op de knop : <a href="{{ url('auth/reset/'.$token) }}"><button class="btn btn-success btn-xs" >Herstel uw wachtwoord</button></a>
te drukken.<br>
Indien u deze aanvraag niet zelf heb verricht kunt u dit bericht als onverzonden beschouwen.
</p>


<h5 class="page-header">
Met vriendelijke groet,<br>
Moodles helpdesk
</h5>

@endsection
@section('footer')
<p class="text-center" style="opacity:0.4;font-size:10px;" >
Dit is een geautomatiseerd bericht die wordt verzonden zodra er een aanvraag tot wachtwoord herstellen voorkomt. </p>
@endsection

