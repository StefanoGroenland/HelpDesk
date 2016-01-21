<!DOCTYPE html>
<html lang="en">

@extends('layouts.header')

    @extends('layouts.top-links')

        <div id="page-wrapper">
            <div class="container-fluid">
         <!-- Page Heading -->
          <div class="row">
              <div class="col-lg-12">

                  @if(Auth::user()->bedrijf != 'moodles')
                  <ol class="breadcrumb">
                      @include('layouts.breadcrumbs')
                  </ol>
                  @endif
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
             <div class="col-lg-12">
                 <div class="panel panel-default">
                 <div class="panel-heading">
                   <h3 class="panel-title">Verander medewerker</h3>
                 </div>
                 <div class="panel-body">
                   <form method="POST" action="/updateMedewerker">
                   {!! csrf_field() !!}
                   <input type="hidden" name="_method" value="PUT">
                     <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label for="email">Email address</label>
                              <input type="email" class="form-control" required="true" id="email2" name="email" placeholder="E-Mail" value="{{$medewerker->email}}">
                              <input type="hidden" class="form-control id2" id="id2"  name="id" value="{{$medewerker->id}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="gebruikersnaam">Gebruikersnaam</label>
                            <input type="text" class="form-control" required="true" id="gebruikersnaam2" name="username" placeholder="Gebruikersnaam"  value="{{$medewerker->username}}">
                        </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label for="voornaam">Voornaam</label>
                          <input type="text" class="form-control" required="true" id="voornaam2" name="voornaam" placeholder="Voornaam"  value="{{$medewerker->voornaam}}">
                        </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                         <div class="form-group">
                           <label for="tussenvoegsel">Tussenvoegsel</label>
                           <input type="text" class="form-control" id="tussenvoegsel2" name="tussenvoegsel" placeholder="Tussenvoegsel"  value="{{$medewerker->tussenvoegsel}}">
                         </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label for="achternaam">Achternaam</label>
                          <input type="text" class="form-control" required="true" id="achternaam2" name="achternaam" placeholder="Achternaam"  value="{{$medewerker->achternaam}}">
                        </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label for="achternaam">Geslacht</label>
                        <div class="form-group">
                          <label class="radio-inline">
                            <input type="radio" name="radman" id="radman" @if($medewerker->geslacht == 'man') checked @endif> Man
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="radvrouw" id="radvrouw" @if($medewerker->geslacht == 'vrouw') checked @endif> Vrouw
                          </label>
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
                          <label for="telefoonnummer">Telefoonnummer</label>
                          <input type="text" class="form-control" required="true" id="telefoonnummer2" name="telefoonnummer" placeholder="Telefoonnummer" value="{{$medewerker->telefoonnummer}}">
                        </div>
                        </div>

                     </div>
                    <div class="row">
                        <div class="col-lg-12"><button type="submit" name="veranderGebruiker" class="btn btn-success pull-right"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Opslaan</button></div>
                      </div>
                   </form>
                 </div>
               </div>
             </div>
         </div>
     </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        {{--@section('scripts')--}}

        {{--@stop--}}

    </div>
    <!-- /#wrapper -->
    @section('scripts')
    <script type="text/javascript">
          $("#radvrouw").on("click",function(){
             $('#radman').prop('checked',false)
          });
          $("#radman").on("click",function(){
             $('#radvrouw').prop('checked',false)
          });
    </script>
    @endsection

    @extends('layouts.footer')

</body>

</html>
