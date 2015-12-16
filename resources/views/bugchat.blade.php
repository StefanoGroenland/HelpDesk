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
                    @include(Auth::user()->bedrijf == 'moodles' ? 'layouts.adminbreadcrumbs' : 'layouts.breadcrumbs')
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-2">
                <h3>Bug : # {{$bug->id}}

                @if($bug->prioriteit == 'laag')
                <span class="label label-success">Laag</span>
                @elseif($bug->prioriteit == 'gemiddeld')
                <span class="label label-warning">Gem.</span>
                @elseif($bug->prioriteit == 'hoog')
                <span class="label label-danger">Hoog</span>
                @elseif($bug->prioriteit == 'kritisch')
                <span class="label label-purple">Krit.</span>
                @else
                <span class="label label-info">Geen prioriteit</span>
                @endif
                </h3>

                @if(Auth::user()->bedrijf == 'moodles')
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="/updateBug/{{$bug->id}}">
                           {!! csrf_field() !!}
                           <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="sel1">Verander prioriteit</label>
                                <select class="form-control" id="prioriteit" name="prioriteit">
                                    <option value="kritisch"  @if($bug->prioriteit == 'kritisch') selected @endif >Kritisch</option>
                                    <option value="hoog" @if($bug->prioriteit == 'hoog') selected @endif >Hoog</option>
                                    <option value="gemiddeld"  @if($bug->prioriteit == 'gemiddeld') selected @endif >Gemiddeld</option>
                                    <option value="laag" @if($bug->prioriteit == 'laag') selected @endif >Laag</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sel2">Verander soort</label>
                                <select class="form-control" id="soort" name="soort">
                                    <option value="lay-out" @if($bug->soort == 'lay-out') selected @endif >Lay-out</option>
                                    <option value="seo" @if($bug->soort == 'seo') selected @endif >SEO</option>
                                    <option value="performance" @if($bug->soort == 'performance') selected @endif >Performance</option>
                                    <option value="code" @if($bug->soort == 'code') selected @endif >Code</option>
                                </select>
                            </div>
                         <div class="form-group">
                                <label for="sel3">Verander status</label>
                                   <select class="form-control" id="status" name="status">
                                       <option value="open" @if($bug->status == 'open') selected @endif >Open</option>
                                       <option value="bezig" @if($bug->status == 'bezig') selected @endif >Bezig</option>
                                       <option value="gesloten" @if($bug->status == 'gesloten') selected @endif >Gesloten</option>
                                   </select>
                          </div>
                            <div class="form-group">
                                <label for="sel4">Koppel medewerker</label>
                                <select class="form-control" id="medewerker" name="medewerker">
                                    @foreach($medewerkers as $mw)
                                    <option value="{{$mw->id}}"
                                    @if($bug->user)
                                     @if($bug->user->id == $mw->id) selected @endif
                                     @endif
                                     >
                                    {{$mw->voornaam .' '. $mw->achternaam }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success center-block"><span class="fa fa-check" aria-hidden="true"></span> Verander</button>
                        </form>
                        <br>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                       @if($bug->prioriteit == 'laag')
                       <div class="panel panel-success">
                       @elseif($bug->prioriteit == 'gemiddeld')
                       <div class="panel panel-yellow">
                       @elseif($bug->prioriteit == 'hoog')
                       <div class="panel panel-red">
                       @elseif($bug->prioriteit == 'kritisch')
                       <div class="panel panel-purple">
                       @else
                       <div class="panel panle-info">
                       @endif
                         <div class="panel-heading">
                           <h3 class="panel-title">{{$bug->titel}}</h3>
                         </div>
                         <div class="panel-body">
                         <div class="row">
                         <div class="col-lg-6 pull-left">
                            <h6><strong>Aangemaakt</strong> :</h6>
                            <h6><strong>Gewijzigd</strong> :</h6>
                            <h6><strong>Deadline</strong> :</h6>
                            <h6><strong>Klant nr.</strong> :</h6>
                            <h6><strong>Status</strong> :</h6>
                            <h6><strong>Soort</strong> :</h6>
                         </div>
                         <div class="col-lg-6 pull-right">
                            <h6>{{$bug->created_at->format('d-m-y')}}</h6>
                            <h6>{{$bug->updated_at->format('d-m-y')}}</h6>
                            <h6>{{date('d-m-y',strtotime($bug->eind_datum))}}</h6>
                            <h6>{{$bug->klant_id}}               </h6>
                            <h6>{{$bug->status}}                 </h6>
                            <h6>{{$bug->soort}}                  </h6>
                         </div>
                         </div>

                         </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 well">
                <h3>Omschrijving :</h3>
                <p>
                    {{$bug->beschrijving}}
                </p>
            </div>

            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">

                    <h3>Discussie<i class="fa fa-fw fa-weixin"></i></h3>
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
{{--</div>--}}
<!-- /#page-wrapper -->

@extends('layouts.footer')
</body>

</html>
