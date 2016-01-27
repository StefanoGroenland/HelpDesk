<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

    @extends('layouts.top-links')

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
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
                    <form method="POST" action="/wijzigFeedback/{{$bug->id}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Wijzig feedback</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="bedrijfsnaam">Feedback</label>
                                        <input type="text" class="form-control" id="titel" name="titel" required="true" placeholder="Titel" value="{{$bug->titel}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    <label for="bedrijfsnaam">Prioriteit</label>
                                    <select data-toggle="tooltip" title="Wat voor prioriteit geeft u voor de fout?" class="form-control" name="prioriteit" required="true">

                                       <option value="1" @if($bug->prioriteit == 1) selected @endif>Laag</option>
                                       <option value="2" @if($bug->prioriteit == 2) selected @endif>Gemiddeld</option>
                                       <option value="3" @if($bug->prioriteit == 3) selected @endif>Hoog</option>
                                       <option value="4" @if($bug->prioriteit == 4) selected @endif>Kritisch</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    <label for="bedrijfsnaam">Categorie</label>
                                        <select data-toggle="tooltip" title="In wat voor categorie valt de fout te herkennen?" class="form-control" name="soort" required="true">
                                          <option value="lay-out"     @if($bug->soort == 'lay-out')     selected @endif>Lay-out</option>
                                          <option value="seo"         @if($bug->soort == 'seo')         selected @endif>SEO</option>
                                          <option value="performance" @if($bug->soort == 'performance') selected @endif>Performance</option>
                                          <option value="code"        @if($bug->soort == 'code')        selected @endif>Code</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                 @if(old('start_datum') == "" && old('titel'))
                                 <div class="form-group has-error">
                                 @else
                                 <div class="form-group">
                                 @endif
                                 <label for="end_date">Startdatum</label>
                                     <input data-toggle="tooltip" title="Wanneer heeft de fout zich als eerst voorgedaan?" type="text" name="start_datum" class="form_datetime form-control date-picker" value="{{date('d-m-Y H:i',strtotime($bug->start_datum))}}" data-rule-maxlength="30">
                                 </div>
                                </div>
                            </div>
                               <div class="alert alert-info"><i class="fa fa-info" ></i> Gelieve de fout hieronder zo uitgebreid mogelijk te beschrijven. Indien mogelijk vul ook het webadres waar de fout voorkomt toe.</div>
                               <div class="form-group">
                                  <textarea  class="form-control" rows="7" id="beschrijving"  name="beschrijving">{{$bug->beschrijving}}</textarea>
                                </div>
                              <button type="submit" class="btn btn-success pull-right"><span class="fa fa-check" aria-hidden="true"></span> Opslaan</button>
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
