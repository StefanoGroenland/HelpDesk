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

    <!--<div id="wrapper">-->
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profiel.html"><i class="fa fa-fw fa-user"></i> Profiel</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<!--            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        <a href="klantMuteren.html"><i class="fa fa-fw fa-users"></i> Klant muteren</a>
                    </li>
                </ul>
            </div>-->
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Overzicht</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="row">
                    <a href="projectMuteren.html">
                    <div class="col-lg-12 col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <i class="fa fa-plus fa-4x"></i>
                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <h3>Nieuw Project</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                    </div>
                </div>
                    <div class="col-lg-3">
                        <div class="row">
                    <a href="klantMuteren.html">
                    <div class="col-lg-12 col-md-6">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <i class="fa fa-pencil fa-4x"></i>
                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <h3>Klanten muteren</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                    </div>
                </div>
                    <div class="col-lg-3">
                        <div class="row">
                    <a href="medewerkerMuteren.html">
                    <div class="col-lg-12 col-md-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <i class="fa fa-pencil fa-4x"></i>
                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <h3>Medewerker muteren</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                    </div>
                </div>
                    <div class="col-lg-3">
                        <div class="row">
                    <a href="bugMuteren.html">
                    <div class="col-lg-12 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <i class="fa fa-bell fa-4x"></i>
                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <h3>Bug melden</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                    </div>
                </div>
                </div>


                <div class="row">
                    <div class="col-lg-3 col-md-6"><h3>Recent actief</h3></div>
                    <div class="col-lg-3 col-md-6"></div>
                    <div class="col-lg-3 col-md-6"></div>
                    <div class="col-lg-3 col-md-6"></div>
                </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6 text-right">
                                        <span class="label label-success">Threadstone</span>
                                        <div><span class="badge">4</span> Openstaand</div>
                                        <div><span class="badge">2</span> Bezig</div>
                                    </div>
                                    <div class="col-xs-6">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="projectBugs.html">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6 text-right">
                                        <span class="label label-warning">Project X</span>
                                        <div><span class="badge">0</span> Openstaand</div>
                                        <div><span class="badge">4</span> Bezig</div>
                                    </div>
                                    <div class="col-xs-6">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="projectBugs.html">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6 text-right">
                                        <span class="label label-danger">Project Y</span>
                                        <div><span class="badge">4</span> Openstaand</div>
                                        <div><span class="badge">4</span> Bezig</div>
                                    </div>
                                    <div class="col-xs-6">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="projectBugs.html">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6 text-right">
                                        <span class="label label-info">Project Z</span>
                                        <div><span class="badge">4</span> Openstaand</div>
                                        <div><span class="badge">4</span> Bezig</div>
                                    </div>
                                    <div class="col-xs-6">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="projectBugs.html">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4>Laatst gemelde bugs</h4>
                        <div class="table-responsive">
                        <table class="table table-hover">
                                <thead>
                                <th>Datum</th>
                                <th>Tijd</th>
                                <th>Project</th>
                                <th>Prioriteit</th>
                                <th>Klantnummer</th>
                                <th>Bedrijfsnaam</th>
                                <th></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>15-10-2015</td>
                                        <td>14:13</td>
                                        <td>Threadstone</td>
                                        <td><span class="label label-danger">Hoog</span></td>
                                        <td>#21341</td>
                                        <td>Google</td>
                                        <td>
                                            <a href="bekijkenBug.html">
                                        <button type="submit" class="btn btn-success btn-xs">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                 </div>
                </div>




            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<!--</div>-->

    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
