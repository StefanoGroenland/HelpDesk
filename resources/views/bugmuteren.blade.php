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
                        Bug melden <small>meld een bug</small>
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
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">

                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nieuwe bug</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="/addBug" >
                             {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="bedrijfsnaam">Project</label>
                                <input type="text" class="form-control" id="titel" name="titel" required="true" placeholder="Titel">
                             </div>
                              <div class="form-group">
                                <select class="form-control" name="project" required="true">
                                  @foreach($projecten as $project)
                                        <option value="{{$project->id}}">{{$project->titel}}</option>
                                  @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                <select class="form-control" name="prioriteit" required="true">
                                   <option value="laag">Laag</option>
                                   <option value="gemiddeld">Gemiddeld</option>
                                   <option value="hoog">Hoog</option>
                                   <option value="kritisch">Kritisch</option>
                                </select>
                                </div>
                                <div class="form-group">
                                <select class="form-control" name="soort" required="true">
                                  <option value="lay-out">Lay-out</option>
                                  <option value="seo">SEO</option>
                                  <option value="performance">Performance</option>
                                  <option value="code">Code</option>
                                </select>
                                </div>
                              <div class="form-group">
                              <label for="start_date">Startdatum</label>
                                <input type="date" class="form-control" name="start_datum" required="true" value="{{date('Y-m-d')}}" id="start_datum">
                              </div>
                              <div class="form-group">
                              <label for="end_date">Einddatum</label>
                                <input type="datetime-local" required="true" name="eind_datum" class="form-control" id="einddatum">
                              </div>
                               <div class="form-group">
                                  <textarea class="form-control" rows="5" id="beschrijving" required="true" name="beschrijving" value="" ></textarea>
                                </div>
                              <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Maak</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

@extends('layouts.footer')

</body>

</html>
