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
                 @if (count($errors))
                     <ul class="list-unstyled">
                         @foreach($errors->all() as $error)
                             <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                         @endforeach
                     </ul>
                 @endif
                <div class="row">
                    <div class="col-lg-4">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Profiel</h3>
                        </div>
                        <div class="panel-body">
                          <form method="POST" class="formulier" action="/profiel/upload" files="true" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                          <input type="hidden" name="_method" value="PUT">
                          <input type="hidden" class="form-control id2" id="id2"  name="id" value="{{$user->id}}">
                            <img width="100" height="100" src="
                            @if(!$user->profielfoto)
                            {{"../assets/images/avatar.png"}}
                            @else
                            {{$user->profielfoto}}
                            @endif
                            "
                            alt="gfxuser" class="img-responsive center-block">
                          <button  type="submit" style="margin-left:10px;" class="btn btn-success pull-right sendButton">
                              <i class="fa fa-check"></i> Foto wijzigen
                          </button>
                          <div class="input-group">
                            <span class="input-group-btn">
                              <span class="btn btn-success" data-toggle="tooltip" title="Kies een foto" onclick="$(this).parent().find('input[type=file]').click();">Verkenner</span>
                              <input name="profielfoto" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
                            </span>
                            <span class="form-control"></span>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                    <form method="POST" action="/updateProfiel">
                          {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="PUT">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Mijn gegevens</h3>
                        </div>
                        <div class="panel-body">

                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label for="email">E-mail</label>
                              <input type="hidden" class="form-control id2" id="id2"  name="id" value="{{$user->id}}">
                            <input type="email" class="form-control" required="true" name="email" value="{{$user->email}}">
                          </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <div class="form-group">
                             <label for="gebruikersnaam">Gebruikersnaam</label>
                             <input type="text" class="form-control" required="true" name="username" value="{{$user->username}}">
                           </div>
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label for="wachtwoord">Wachtwoord</label>
                            <input type="password" class="form-control" name="password" >
                          </div>
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label for="wachtwoord">Herhaal wachtwoord</label>
                            <input type="password" class="form-control" name="password_confirmation" >
                          </div>
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <div class="form-group">
                            <label for="voornaam">Voornaam</label>
                            <input type="text" class="form-control" required="true" name="voornaam" value="{{$user->voornaam}}">
                          </div>
                          </div>
                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          <div class="form-group">
                            <label for="voornaam">Tussenvoegsel</label>
                            <input type="text" class="form-control" name="tussenvoegsel" value="{{$user->tussenvoegsel}}">
                          </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label for="achternaam">Achternaam</label>
                            <input type="text" class="form-control" required="true" name="achternaam" value="{{$user->achternaam}}">
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                          <label for="geslacht">Geslacht</label>
                            <select class="form-control" id="geslacht2" required="true" name="geslacht">
                            <option value="man" @if($user->geslacht == 'man') selected @endif >Man</option>
                            <option value="vrouw" @if($user->geslacht == 'vrouw') selected @endif >Vrouw</option>
                            </select>
                          </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label for="bedrijfsnaam">Bedrijfsnaam</label>
                            <input type="text" class="form-control" required="true" name="bedrijf" value="{{$user->bedrijf}}">
                          </div>
                          </div>
                        </div>
                        <div class="row">
                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         @if($errors->has('telefoonnummer'))
                         <div class="form-group has-error">
                         @else
                         <div class="form-group">
                         @endif
                           <label for="bedrijfsnaam">Telefoonnummer</label>
                           <input type="text" class="form-control" required="true" maxlength="11" name="telefoonnummer" value="{{$user->telefoonnummer}}">
                         </div>
                         </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                        </div>
                            <button type="submit" class="btn btn-success pull-right"><span class="fa fa-check" aria-hidden="true"></span> Opslaan</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    @section('scripts')
    <script type="text/javascript">
    $('.sendButton').click(function(e){
         var $this = $(this);
         var form = $('.formulier');
         $this.toggleClass('sendButton');
         if($this.hasClass('sendButton')){
             $this.text('Verstuur')
         }else{
             $this.html("<i class='fa fa-spinner fa-spin' ></i>Versturen..");
             $this.attr("disabled", true);
             e.preventDefault();
             setTimeout(function(){
                 form.submit()
             },2000);
         }
    })
    </script>


    @endsection
    @extends('layouts.footer')

  </body>
</html>
