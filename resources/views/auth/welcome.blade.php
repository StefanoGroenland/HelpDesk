<!DOCTYPE html>
<html lang="en">
<style>
.light-opacity{
        /*border: 2px solid #ffffff;!important;*/
        background-color: rgba(255,255,255,0.6);!important;
}
</style>
@include('layouts.header')

    @include('layouts.top-links')
    
    		<img src="{{URL::asset('../assets/images/logo.png')}}" class="img-responsive center-block" alt="Responsive image">
            <br />
    
            <div class="container">
                    <form method="POST" action="/auth/login">
                     {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 well light-opacity">
                                
                                <div class="form-group">
                                @if (count($errors))
                                    <ul class="list-unstyled">
                                        @foreach($errors->all() as $error)
                                            <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                    <label for="gebruikersnaam">Gebruikersnaam</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Gebruikersnaam" value="{{old('username')}}">
                                </div>
                                <div class="form-group">
                                    <label for="wachtwoord">Wachtwoord</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord">
                                </div>
                                <button type="submit" class="btn btn-default pull-right">Inloggen</button>
                                
                                
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                        
                        <div class="row">
                         <div class="col-md-4"></div>
                         <div class="col-md-4"><a class="pull-right" href="auth/email" style="color:#fff;font-size:11px;margin-top:-10px;">Wachtwoord vergeten?</a></div>
                         <div class="col-md-4"></div>
                        </div>
                        
                  </form>
            </div>
            <!-- /.container-fluid -->

        @extends('layouts.footer')

</body>

</html>
