@extends('layouts.mail_temp')
@section('onderwerp')
U heeft reactie op een discussie
@endsection

@section('bericht')

<h4 class="page-header" >Beste {{$volledige_naam}},</h4>

<div class="table-responsive">
     <table class="table">
         <thead>
         <th>Bug</th>
         <th>Soort</th>
         <th>Klant</th>
         <th>Projectnummer</th>
         </thead>
         <tbody>
            <tr>
                <td>{{$bug->titel}}</td>
                <td>{{$bug->soort}}</td>
                <td>{{$bug->klant_id .' '. $bug->klant->voornaam .' '. $bug->klant->tussenvoegsel .' '. $bug->klant->achternaam}}</td>
                <td>{{$bug->project_id}}</td>
            </tr>
         </tbody>
     </table>
 </div>

<h4 class="page-header">Bericht</h4>
<p>{!! $bericht !!} </p>


<a style="text-decoration: none;" href="http://helpdesk.moodles.nl/bugchat/{{$bug_id}}">
    <button class="btn btn-success center-block btn-sm" >
        Zie discussie.
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

