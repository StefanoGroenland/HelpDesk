<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moodles - Helpdesk</title>

    <!-- Bootstrap Core CSS -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        @extends('...layouts.top-links')
</head>

<body>
            <div class="container">
                    <form method="POST" action="/auth/login">
                     {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 well">
                                <img src="{{URL::asset('../assets/images/logo.png')}}" class="img-responsive center-block" alt="Responsive image">
                                <div class="form-group">
                                    <label for="klantnummer">Klantnummer</label>
                                    <input type="number" class="form-control" id="klantnummer" name="klantnummer" placeholder="Klantnummer" value="{{old('klantnummer')}}">
                                </div>
                                <div class="form-group">
                                    <label for="gebruikersnaam">Gebrukersnaan</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Gebrukersnaam" value="{{old('username')}}">
                                </div>
                                <div class="form-group">
                                    <label for="wachtwoord">Wachtwoord</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord">
                                </div>
                                <button type="submit" class="btn btn-success">Aanmelden</button>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>


                  </form>
            </div>
            <!-- /.container-fluid -->

        @extends('...layouts.footer')

</body>

</html>
