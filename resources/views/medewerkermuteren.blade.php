<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moodles - Helpdesk</title>

    @extends('layouts.top-links')

        <div id="page-wrapper">

            <div class="container-fluid">

         <!-- Page Heading -->
         <div class="row">
             <div class="col-lg-12">
                 <h1 class="page-header">
                     Medewerker aanpassen <small>Verander medewekers</small>
                     @include('layouts.header-controls')
                 </h1>
                 <ol class="breadcrumb">
                     @include(Auth::user()->bedrijf == 'moodles' ? 'layouts.adminbreadcrumbs' : 'layouts.breadcrumbs')
                 </ol>
             </div>
         </div>
                         @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                           @if(Session::has('alert-' . $msg))
                             <div class="row">
                                 <div class="col-lg-12">
                                     <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                 </div>
                             </div>
                           @endif
                         @endforeach
         <div class="row">

             <div class="col-lg-4">
                 <div class="panel panel-warning">
                 <div class="panel-heading">
                   <h3 class="panel-title">Verander medewerker</h3>
                 </div>
                 <div class="panel-body">
                   <form method="POST" action="/updateMedewerker">
                   {!! csrf_field() !!}
                   <input type="hidden" name="_method" value="PUT">
                     <div class="form-group">
                       <div class="input-group">
                         <input type="text" id="zoekmail" name="zoekmail" class="form-control" placeholder="E-mail">
                         <span class="input-group-btn">
                           <button class="btn btn-default" id="zoekKnop" name="zoekGebruiker" type="button">Zoek persoon</button>
                         </span>
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="email">Email address</label>
                       <input type="email" class="form-control" required="true" id="email2" name="email" placeholder="E-Mail" value="">
                       <input type="hidden" class="form-control id2" id="id2"  name="id">
                     </div>
                     <div class="form-group">
                       <label for="gebruikersnaam">Gebruikersnaam</label>
                       <input type="text" class="form-control" required="true" id="gebruikersnaam2" name="username" placeholder="Gebruikersnaam"  value="">
                     </div>
                     {{--<div class="form-group">--}}
                       {{--<label for="wachtwoord">Wachtwoord</label>--}}
                       {{--<input type="password" class="form-control" required="true" id="wachtwoord2" name="password" placeholder="Wachtwoord">--}}
                     {{--</div>--}}
                       <div class="form-group">
                       <label for="voornaam">Voornaam</label>
                       <input type="text" class="form-control" required="true" id="voornaam2" name="voornaam" placeholder="Voornaam"  value="">
                     </div>
                     <div class="form-group">
                        <label for="tussenvoegsel">Tussenvoegsel</label>
                        <input type="text" class="form-control" id="tussenvoegsel2" name="tussenvoegsel" placeholder="Tussenvoegsel"  value="">
                      </div>
                     <div class="form-group">
                       <label for="achternaam">Achternaam</label>
                       <input type="text" class="form-control" required="true" id="achternaam2" name="achternaam" placeholder="Achternaam"  value="">
                     </div>
                     <div class="form-group">
                       <label for="telefoonnummer">Telefoonnummer</label>
                       <input type="text" class="form-control" required="true" id="telefoonnummer2" name="telefoonnummer" placeholder="Telefoonnummer">
                     </div>
                     <div class="form-group">
                     <label for="geslacht">Geslacht</label>
                       <select class="form-control" id="geslacht2" required="true" name="geslacht">
                         <option value="man">Man</option>
                         <option value="vrouw">Vrouw</option>
                       </select>
                     </div>
                      <div class="row">
                        <div class="col-lg-12"><button type="submit" name="veranderGebruiker" class="btn btn-warning center-block"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Verander</button></div>
                      </div>
                   </form>
                 </div>
               </div>
             </div>
             <div class="col-lg-6">
                 <div class="table-responsive">
                     <table class="table table-hover">
                         <thead>
                         <th>Volledige naam</th>
                         <th>E-mail</th>
                         <th></th>
                         <th></th>
                         </thead>
                         <tbody>
                             @foreach($medewerkers as $medewerker)
                             <tr>
                             <td>{{$medewerker->voornaam . ' ' . substr($medewerker->tussenvoegsel,0,5) . ' ' . $medewerker->achternaam}}</td>
                             <td>{{$medewerker->email}}</td>
                             <td>
                                {{--<input type="hidden" class="zoeknaam2" value="{{$project->projectnaam}}"  name="zoeknaam2" class="form-control" placeholder="Projectnaam">--}}
                                  <button class="btn btn-success btn-xs wijzigKnop2" name="zoekProject" type="button" data-project="{{$medewerker->email}}">
                                         <i class="glyphicon glyphicon-pencil"></i>
                                  </button>
                             </td>
                               <td>
                               <a href="/verwijderGebruiker/{{$medewerker->id}}" class="">
                                   <button type="submit" class="btn btn-danger btn-xs">
                                      <i class="glyphicon glyphicon-remove"></i>
                                   </button>
                               </a>
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

        @section('scripts')
        <script type="text/javascript">
            $("#zoekKnop").on("click",function(){


                    var email = $('#zoekmail').val();
                    $('#id2').val('');
                    $('#email2').val('');
                    $('#gebruikersnaam2').val('');
                    $('#voornaam2').val('');
                    $('#tussenvoegsel2').val('');
                    $('#achternaam2').val('');
                    $('#telefoonnummer2').val('');
                    $('#geslacht2').val('');

                    $.ajax({
                      method: "POST",
                      url: "/updateData",
                      data: {   input: email ,
                                _token: "{{ csrf_token() }}"
                            }
                    })
                      .done(function( msg ) {
                        $('.id2').val(msg[0].id);
                        $('#email2').val(msg[0].email);
                        $('#gebruikersnaam2').val(msg[0].username);
                        $('#voornaam2').val(msg[0].voornaam);
                        $('#tussenvoegsel2').val(msg[0].tussenvoegsel);
                        $('#achternaam2').val(msg[0].achternaam);
                        $('#telefoonnummer2').val(msg[0].telefoonnummer);
                        $('#geslacht2').val(msg[0].geslacht);
                      });
            });
        </script>
           <script type="text/javascript">
                        $(".wijzigKnop2").on("click",function(){

                        var email2 = $(this).data('project');
                         $('#id2').val('');
                         $('#email2').val('');
                         $('#gebruikersnaam2').val('');
                         $('#voornaam2').val('');
                         $('#tussenvoegsel2').val('');
                         $('#achternaam2').val('');
                         $('#telefoonnummer2').val('');
                         $('#geslacht2').val('');

                         $.ajax({
                           method: "POST",
                           url: "/updateData",
                           data: {   input: email2 ,
                                     _token: "{{ csrf_token() }}"
                                 }
                         })
                           .done(function( msg ) {
                            console.log(msg);
                             $('.id2').val(msg[0].id);
                             $('#email2').val(msg[0].email);
                             $('#gebruikersnaam2').val(msg[0].username);
                             $('#voornaam2').val(msg[0].voornaam);
                             $('#tussenvoegsel2').val(msg[0].tussenvoegsel);
                             $('#achternaam2').val(msg[0].achternaam);
                             $('#telefoonnummer2').val(msg[0].telefoonnummer);
                             $('#geslacht2').val(msg[0].geslacht);

                           });

                         });
                </script>

        @stop

    </div>
    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
