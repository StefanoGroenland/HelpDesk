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
                    Bug Discussie <small>Bug meldings gesprek</small>
                </h1>
                <ol class="breadcrumb">
                    @if(Auth::user()->bedrijf == 'moodles')
                         @include('layouts.adminbreadcrumbs')
                     @else
                         @include('layouts.breadcrumbs')
                     @endif
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-2">
                <h3>Bug : #168423 <span class="label label-success">Laag</span></h3>
                <div class="row">
                    <div class="col-lg-10">
                        <form>
                            <div class="form-group">
                                <label for="sel1">Verander prioriteit</label>
                                <select class="form-control" id="sel1">
                                    <option>Hoog</option>
                                    <option>Gemiddeld</option>
                                    <option>Laag</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sel1">Verander status</label>
                                <select class="form-control" id="sel1">
                                    <option>Open</option>
                                    <option>Gesloten</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sel1">Koppel medewerker</label>
                                <select class="form-control" id="sel1">
                                    <option>Medewerker 1</option>
                                    <option>Medewerker 2</option>
                                    <option>Medewerker 3</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success center-block"><span class="fa fa-check" aria-hidden="true"></span> Verander</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-10 well">
                <h3>Omschrijving :</h3>
                <p>
                    Volledige beschrijving :
                    s aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Quisque
                    eros quam, ultrices id ipsum non, tempus aliquet turpis.
                    Cras dignissim nisi at nisl feugiat convallis. Curabitur
                    at ligula faucibus, dapibus tortor ultricies, scelerisque justo.
                    Ut turpis dolor, viverra ut sem non, gravida iaculis velit. Sed feugiat,
                    velit ac vestibulum egestas, eros purus fringilla purus, a consequat velit
                    ipsum et quam. Pellentesque sed posuere leo. Etiam in magna in tellus fringilla
                    ornare ut a augue.
                </p>
            </div>
            <h3>Discussie<i class="fa fa-fw fa-weixin"></i></h3>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <ul class="list-unstyled">
                        <!--linker persoon-->
                        <li class="text-left">
                            <div class="panel panel-default">
                                <i class="fa fa-fw fa-group fa-2x"></i><span class="label label-success">Stefano groenland - Ontwikkelaar</span> 16/11/2015 om 15:10
                                <div class="panel-body">
                                    t ac vestibulum egestas, eros purus frin
                                </div>
                            </div>
                        </li>
                        <!--linker persoon-->
                        <!--rechter persoon-->
                        <li class="text-right">

                            <div class="panel panel-default">
                                16/11/2015 om 15:34 <span class="label label-warning">Sjaak - Klant</span><i class="fa fa-fw fa-user fa-2x"></i>
                                <div class="panel-body">
                                    feugiat convallis. Curabitur
                                    at ligula faucibus, dapibus tortor ultricies, scelerisque justo.
                                    Ut turpis dolor, viverra ut sem non
                                    gula faucibus, dapibus tortor ultricies, scelerisque justo.
                                    Ut turpis dolor, viverra ut sem non
                                    gula faucibus, dapibus tortor ultricies, scelerisque justo.
                                    Ut turpis dolor, viverra ut sem non
                                </div>
                            </div>
                        </li>

                    </ul>
                    <form>
                        <div class="form-group">
                            <label for="bericht">Bericht : </label>
                            <textarea class="form-control" rows="6"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-send"></i>
                        </button>
                        <button type="reset" class="btn btn-danger">
                            <i class="fa fa-remove"></i>
                        </button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@extends('layouts.footer')

</body>

</html>
