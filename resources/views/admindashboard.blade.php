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
                            Dashboard <small>Overzicht</small>
                        </h1>
                        {{--Breadcrumbs spot!--}}
                        <ol class="breadcrumb">
                            @include('layouts.adminbreadcrumbs')
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="row">
                    <a href="{{URL::to('/projectmuteren')}}">
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
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                <div id='notificatie'><div>2</div></div>
                                    <div class="col-xs-12 text-right">
                                        <span class="label label-success">Threadstone</span>
                                        <div><span class="badge">4</span> Openstaand</div>
                                        <div><span class="badge">2</span> Bezig</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{URL::to('/bugoverzicht')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                            <div id='notificatie'><div>2</div></div>
                                <div class="col-xs-12 text-right">
                                    <span class="label label-warning">Project X</span>
                                    <div><span class="badge">0</span> Openstaand</div>
                                    <div><span class="badge">4</span> Bezig</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{URL::to('/bugoverzicht')}}">
                            <div class="panel-footer">
                                <span class="pull-left">Bekijk</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                <div id='notificatie'><div>2</div></div>
                                    <div class="col-xs-12 text-right">
                                        <span class="label label-danger">Project Y</span>
                                        <div><span class="badge">4</span> Openstaand</div>
                                        <div><span class="badge">4</span> Bezig</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{URL::to('/bugoverzicht')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                    <div id='notificatie'><div>2</div></div>
                                        <div class="col-xs-12 text-right">
                                            <span class="label label-info">Project Z</span>
                                            <div><span class="badge">4</span> Openstaand</div>
                                            <div><span class="badge">4</span> Bezig</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{URL::to('/bugoverzicht')}}">
                                    <div class="panel-footer">
                                        <span class="pull-left">Bekijk</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-purple">
                            <div class="panel-heading">
                                <div class="row">
                                <div id='notificatie'><div>2</div></div>
                                    <div class="col-xs-12 text-right">
                                        <span class="label label-purple">Project Z</span>
                                        <div><span class="badge">4</span> Openstaand</div>
                                        <div><span class="badge">4</span> Bezig</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{URL::to('/bugoverzicht')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                               </div>
                         </div>
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
                                            <a href="{{URL::to('/bugchat')}}">
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
