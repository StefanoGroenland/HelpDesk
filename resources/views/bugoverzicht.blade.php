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
                            Feedback<small>feedback pagina waar bugs worden verdeeld/getoond</small>
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
                
                
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                    <h3 class="page-header">
                        Gekoppelde bugs <small>aan mij gekoppelde bugs</small>
                    </h3>
                    <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                        <th>ID</th>
                        <th>Samenvatting</th>
                        <th>Status</th>
                        <th>Soort</th>
                        <th>Prioriteit</th>
                        <th></th>
                        </thead>
                        <tbody>
                           @foreach($bugs_related as $bug)
                                <tr>
                                    <td># {{$bug->id}}</td>
                                    <td>{{substr($bug->beschrijving,0,15)}}...</td>
                                    <td>{{$bug->status}}</td>
                                    <td>{{$bug->soort}}</td>
                                    <td>
                                    @if($bug->prioriteit == 'laag')
                                    <span class="label label-success">Laag</span>
                                    @elseif($bug->prioriteit == 'gemiddeld')
                                    <span class="label label-warning">Gemmideld</span>
                                    @elseif($bug->prioriteit == 'hoog')
                                    <span class="label label-danger">Hoog</span>
                                    @elseif($bug->prioriteit == 'kritisch')
                                    <span class="label label-purple">Kritisch</span>
                                    @else
                                    <span class="label label-info">Geen prioriteit</span>
                                    @endif
                                    </td>
                                    <td>
                                        <a href="/bugchat/{{$bug->id}}" class="">
                                            <button type="submit" class="btn btn-success">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </a>
                                        @if(Auth::user()->bedrijf == 'moodles')
                                        <a href="/verwijderBug/{{$bug->id}}" class="">
                                            <button class="btn btn-danger">
                                                    <i class="fa fa-remove"></i>
                                            </button>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
                    
                    
                </div>
                @if(Auth::user()->bedrijf == 'moodles')
                <div class="row">
                    <div class="col-lg-12">
                    <h3 class="page-header">
                        Alle bugs <small>een lijst van alle bugs</small>
                    </h3>
                    <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                        <th>ID</th>
                        <th>Samenvatting</th>
                        <th>Status</th>
                        <th>Soort</th>
                        <th>Prioriteit</th>
                        <th></th>
                        </thead>
                        <tbody>

                           @foreach($bugs_all as $bug)
                                <tr>
                                    <td># {{$bug->id}}</td>
                                    <td>{{substr($bug->beschrijving,0,15)}}</td>
                                    <td>{{$bug->status}}</td>
                                    <td>{{$bug->soort}}</td>
                                    <td>
                                    @if($bug->prioriteit == 'laag')
                                    <span class="label label-success">Laag</span>
                                    @elseif($bug->prioriteit == 'gemiddeld')
                                    <span class="label label-warning">Gemmideld</span>
                                    @elseif($bug->prioriteit == 'hoog')
                                    <span class="label label-danger">Hoog</span>
                                    @elseif($bug->prioriteit == 'kritisch')
                                    <span class="label label-purple">Kritisch</span>
                                    @else
                                    <span class="label label-info">Geen prioriteit</span>
                                    @endif
                                    </td>
                                    <td>
                                        <a href="/bugchat/{{$bug->id}}" class="">
                                            <button type="submit" class="btn btn-success">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </a>
                                        <a href="/verwijderBug/{{$bug->id}}" class="">
                                            <button class="btn btn-danger">
                                                    <i class="fa fa-remove"></i>
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
                  @else
                                              @endif
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
