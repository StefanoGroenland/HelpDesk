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
                            Project aanpassen <small> hier kan een project gewijzigd worden </small>
                            @include('layouts.header-controls')
                        </h1>
                        {{--breadcrumbs layout spot!--}}
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
                <div class="row">
                <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <h3 class="panel-title">Verander project</h3>
                          </div>
                          <div class="panel-body">
                            <form method="POST" action="/updateProject">
                                               {!! csrf_field() !!}
                                               <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="bedrijfsnaam">Project</label>
                               <input type="text" class="form-control titel2" id="titel2" required="true" name="titel" placeholder="Titel" value="{{$project->titel}}">
                               <input type="hidden" class="form-control id2" id="id2"  name="id" value="{{$project->id}}">
                             </div>
                             <div class="form-group">
                                 <select class="form-control status2" id="status2" name="status" required="true">
                                   <option value="open" @if($project->status == 'open') selected @endif >Open</option>
                                   <option value="bezig" @if($project->status == 'bezig') selected @endif >Bezig</option>
                                   <option value="gesloten" @if($project->status == 'gesloten') selected @endif >Gesloten</option>
                                 </select>
                               </div>
                               <div class="form-group">
                                 <select class="form-control prioriteit2" id="prioriteit2" required="true" name="prioriteit">
                                   <option value="kritisch"  @if($project->prioriteit == 'kritisch') selected @endif >Kritisch</option>
                                   <option value="hoog" @if($project->prioriteit == 'hoog') selected @endif >Hoog</option>
                                   <option value="gemiddeld"  @if($project->prioriteit == 'gemiddeld') selected @endif >Gemiddeld</option>
                                   <option value="laag" @if($project->prioriteit == 'laag') selected @endif >Laag</option>
                                 </select>
                               </div>
                               <div class="form-group">
                                <select class="form-control soort2" id="soort2" required="true" name="soort">
                                  <option value="lay-out" @if($project->soort == 'lay-out') selected @endif >Lay-out</option>
                                  <option value="seo" @if($project->soort == 'seo') selected @endif >SEO</option>
                                  <option value="performance" @if($project->soort == 'performance') selected @endif >Performance</option>
                                  <option value="code" @if($project->soort == 'code') selected @endif >Code</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control projectnaam2" required="true" id="projectnaam2" name="projectnaam" placeholder="Projectnaam" value="{{$project->projectnaam}}">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control projecturl2" required="true" id="projecturl2" name="projecturl" placeholder="Project URL" value="{{$project->projecturl}}">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Beheer account</label>
                                <input type="text" class="form-control gebruikersnaam2" required="true" id="gebruikersnaam2" name="gebruikersnaam" placeholder="Gebruikersnaam" value="{{$project->gebruikersnaam}}">
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control wachtwoord2"  required="true"id="wachtwoord2" name="wachtwoord" placeholder="Wachtwoord" value="{{$project->wachtwoord}}">
                              </div>
                              <div class="form-group">
                                 <textarea class="form-control omschrijving2" rows="5" id="omschrijving2" name="omschrijvingproject" value="" >{{$project->omschrijvingproject}}</textarea>
                               </div>
                              <button type="submit" class="btn btn-success center-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Verander</button>
                            </div>
                           </div>
                        </form>
                         </div>
                    <div class="col-lg-4"></div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
            {{--@section('scripts')--}}
                    {{--@stop--}}
    </div>
    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
