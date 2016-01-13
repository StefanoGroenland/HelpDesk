<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moodles - Helpdesk</title>

    <link rel="shortcut icon" type="image/ico" href="./favicon.ico" />
</head>
    @extends('layouts.top-links')

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Feedback melden <small>hier kunt u feedback geven</small>
                        @include('layouts.header-controls')
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
                   @if (count($errors))
                       <ul class="list-unstyled">
                           @foreach($errors->all() as $error)
                               <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                           @endforeach
                       </ul>
                   @endif
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="/addBug/{{$id}}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nieuwe feedback</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="bedrijfsnaam">Feedback</label>
                                <input type="text" class="form-control" id="titel" name="titel" required="true" placeholder="Titel">
                             </div>
                                <div class="form-group">
                                <select data-toggle="tooltip" title="Wat voor prioriteit geeft u voor de fout?" class="form-control" name="prioriteit" required="true">
                                   <option value="1">Laag</option>
                                   <option value="2">Gemiddeld</option>
                                   <option value="3">Hoog</option>
                                   <option value="4">Kritisch</option>
                                </select>
                                </div>
                                <div class="form-group">
                                <select data-toggle="tooltip" title="In wat voor categorie valt de fout te herkennen?" class="form-control" name="soort" required="true">
                                  <option value="lay-out">Lay-out</option>
                                  <option value="seo">SEO</option>
                                  <option value="performance">Performance</option>
                                  <option value="code">Code</option>
                                </select>
                                </div>
                              <div class="form-group">
                               <label for="end_date">Startdatum</label>
                                   <input data-toggle="tooltip" title="Wanneer heeft de fout zich als eerst voorgedaan?" type="text" name="start_datum" class="form_datetime form-control date-picker" placeholder="{{date('d-m-Y H:i')}}" data-rule-maxlength="30">
                               </div>
                               <div class="alert alert-info"><i class="fa fa-info" ></i> Gelieve de fout hieronder zo uitgebreid mogelijk te beschrijven. Indien mogelijk vul ook het webadres waar de fout voorkomt toe.</div>
                               <div class="form-group">
                                  <textarea  class="form-control" rows="7" id="beschrijving"  name="beschrijving"></textarea>
                                </div>
                              <button data-toggle="tooltip" title="Heeft u de fout zo specifiek mogelijk beschreven? indien mogelijk met de locaties / manieren waardoor de fout onstaat?" type="submit" class="btn btn-success center-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Verstuur</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

@section('scripts')
            <script type="text/javascript" src="{{URL::asset('../assets/js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script>
            <script type="text/javascript" src="{{URL::asset('../assets/js/locales/bootstrap-datetimepicker.nl.js')}}" charset="UTF-8"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                       $(".form_datetime").datetimepicker({
                       language: 'nl',
                       weekStart: 1,
                       format: 'd-mm-yyyy hh:ii',
                       autoclose: true
                       });
                });
            </script>
@endsection

@extends('layouts.footer')

</body>

</html>
