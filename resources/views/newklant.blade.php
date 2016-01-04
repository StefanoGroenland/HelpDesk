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
                     Klant aanmaken <small>maak een nieuwe klant aan</small>
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
                          @if (count($errors))
                              <ul class="list-unstyled">
                                  @foreach($errors->all() as $error)
                                      <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                                  @endforeach
                              </ul>
                          @endif
         <div class="row">
         <div class="col-lg-4"></div>
             <div class="col-lg-4">

               <div class="panel panel-info">
                 <div class="panel-heading">
                   <h3 class="panel-title">Nieuwe klant</h3>

                 </div>
                 <div class="panel-body">
                   <form method="POST" action="/addUser" >
                   {!! csrf_field() !!}
                     <div class="form-group">
                       <label for="email">Email address</label>
                       <input type="email" class="form-control" required="true" id="email" name="email" placeholder="Email">
                     </div>
                     <div class="form-group">
                       <label for="gebruikersnaam">Gebruikersnaam</label>
                       <input type="text" class="form-control" required="true" id="gebruikersnaam" name="username" placeholder="Gebruikersnaam">
                     </div>
                      @if($errors->has('password'))
                       <div class="form-group has-error">
                       @else
                       <div class="form-group">
                       @endif
                       <label for="wachtwoord">Wachtwoord</label>
                       <input type="password" class="form-control" required="true" id="wachtwoord" name="password" placeholder="Wachtwoord">
                     </div>
                      @if($errors->has('password'))
                          <div class="form-group has-error">
                          @else
                          <div class="form-group">
                          @endif
                         <label for="wachtwoord">Herhaal wachtwoord</label>
                         <input type="password" class="form-control" required="true" id="wachtwoord" name="password_confirmation" placeholder="Wachtwoord">
                       </div>
                       <div class="form-group">
                       <label for="voornaam">Voornaam</label>
                       <input type="text" class="form-control" required="true" id="voornaam" name="voornaam" placeholder="Voornaam">
                     </div>
                     <div class="form-group">
                        <label for="tussenvoegsel">Tussenvoegsel</label>
                        <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel" placeholder="Tussenvoegsel"  value="">
                      </div>
                     <div class="form-group">
                       <label for="achternaam">Achternaam</label>
                       <input type="text" class="form-control" required="true" id="achternaam" name="achternaam" placeholder="Achternaam">
                     </div>
                     @if($errors->has('bedrijf'))
                       <div class="form-group has-error">
                       @else
                       <div class="form-group">
                       @endif
                       <label for="achternaam">Bedrijf</label>
                       <input type="text" class="form-control" required="true" id="bedrijf" name="bedrijf" placeholder="Bedrijf">
                     </div>
                    @if($errors->has('telefoonnummer'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                        <label for="telefoonnummer">Telefoonnummer</label>
                        <input type="text" class="form-control" required="true" id="telefoonnummer" maxlength="11" name="telefoonnummer" placeholder="Telefoonnummer">
                      </div>
                      <div class="form-group">
                      <label for="geslacht">Geslacht</label>
                        <select class="form-control" id="geslacht" required="true" name="geslacht">
                          <option value="man">Man</option>
                          <option value="vrouw">Vrouw</option>
                        </select>
                      </div>
                     <div class="row">
                           <div class="col-lg-12"><button type="submit" class="btn btn-info center-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Maak klant</button></div>
                       </div>
                   </form>
                 </div>
               </div>

             </div>
             <div class="col-lg-4"></div>
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
                      data: {   email: email ,
                                _token: "{{ csrf_token() }}"
                            }
                    })
                      .done(function( msg ) {
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
