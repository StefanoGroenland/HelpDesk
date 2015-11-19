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

</head>

<body>

    <div id="page-wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Moodles Helpdesk</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{URL::to('/profiel')}}"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Project bugs <small>alle bugs</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Project bugs
                            </li>
                        </ol>
                    </div>
                </div>
                
                
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <th>ID</th>
                        <th>Samenvatting</th>
                        <th>Status</th>
                        <th>Prioriteit</th>
                        <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#3465412</td>
                                <td>De bug berekening bij het gedeelte....</td>
                                <td>Bezig</td>
                                <td><span class="label label-danger">Hoog</span></td>
                                <td>
                                    <a href="{{URL::to('/bugchat')}}" class="">
                                        <button type="submit" class="btn btn-success">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </a>
                                <button class="btn btn-danger">
                                        <i class="fa fa-remove"></i>
                                </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#3465413</td>
                                <td>Help!! webserver loopt vast na 10 bezoekers!..</td>
                                <td>Bezig</td>
                                <td><span class="label label-danger">Hoog</span></td>
                                <td>
                                    <a href="{{URL::to('/bugchat')}}" class="">
                                        <button type="submit" class="btn btn-success">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </a>
                                <button class="btn btn-danger">
                                        <i class="fa fa-remove"></i>
                                </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#3465414</td>
                                <td>Website is trager als normaal</td>
                                <td>Openstaand</td>
                                <td><span class="label label-warning">Laag</span></td>
                                <td>
                                    <a href="{{URL::to('/bugchat')}}" class="">
                                        <button type="submit" class="btn btn-success">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </a>
                                <button class="btn btn-danger">
                                        <i class="fa fa-remove"></i>
                                </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#3465415</td>
                                <td>Logo footer ontbreekt zonder foutmelding</td>
                                <td>Openstaand</td>
                                <td><span class="label label-success">Gemiddeld</span></td>
                                <td>
                                    <a href="{{URL::to('/bugchat')}}" class="">
                                        <button type="submit" class="btn btn-success">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </a>
                                <button class="btn btn-danger">
                                        <i class="fa fa-remove"></i>
                                </button>
                                </td>
                            </tr>
                            
                        </tbody>
                      </table>
                    </div>
                    </div>
                    
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   @extends('layouts.footer')

</body>

</html>
