@extends('layouts.mail_temp')
<style>
.label-purple {
    background-color: #ad4ef0;
}
.label-purple[href]:hover,
.label-purple[href]:focus {
  background-color: #ad4ef0;
}
</style>
@section('onderwerp')
 Er is feedback gesloten
@endsection

@section('bericht')

<h4 class="page-header" >Beste klant,</h4>

 <div class="table-responsive">
     <table class="table">
         <thead>
         <th>Status</th>
         <th>Prioriteit</th>
         <th>Soort</th>
         <th>Feedbacknummer</th>
         </thead>
         <tbody>
            <tr>
                <td>{{$status}}</td>
                <td>
                @if($prioriteit == 1)
                <span class="label label-success">Laag</span>
                @elseif($prioriteit == 2)
                <span class="label label-warning">Gem.</span>
                @elseif($prioriteit == 3)
                <span class="label label-danger">Hoog</span>
                @else
                <span class="label label-purple">Krit.</span>
                @endif
                </td>
                <td>{{$soort}}</td>
                <td>{{$id}}</td>
            </tr>
         </tbody>
     </table>
 </div>
<a style="text-decoration: none;" href="http://helpdesk.moodles.nl/bugchat/{{$id}}">
<button class="btn btn-success center-block" >
    Zie feedback op Moodles Helpdesk.
</button>
</a>
<br>
<br>

<h5 class="page-header">
Met vriendelijke groet,<br><br>
Moodles helpdesk
</h5>

@endsection



@section('footer')
<p class="text-center" style="opacity:0.4;font-size:10px;border-top:1px solid black;" >
Dit is een geautomatiseerd bericht die wordt verzonden zodra er feedback wordt gesloten. </p>
@endsection

