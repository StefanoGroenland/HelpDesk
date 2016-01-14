@extends('layouts.mail_temp')
@section('onderwerp')
U heeft reactie op een discussie
@endsection

@section('bericht')

<h4 class="page-header" >Beste {{$volledige_naam}},</h4>

<p>Het bericht : {!! $bericht !!} </p>


<a style="text-decoration: none;" href="http://helpdesk.moodles.nl/bugchat/{{$bug_id}}">
    <button class="btn btn-success center-block" >
        Zie discussie op Moodles Helpdesk.
    </button>
</a>
<h5 class="page-header">
    Met vriendelijke groet,<br>
    Moodles helpdesk
</h5>
@endsection



@section('footer')
<p class="text-center" style="opacity:0.4;font-size:10px;" >
    Dit is een geautomatiseerd bericht die wordt verzonden zodra er feedback wordt geplaatst. </p>
@endsection

