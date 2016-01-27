<!DOCTYPE html>
<html lang="en">

<style>
.clickable:hover{
    cursor:pointer;
}
</style>
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
        <!-- /.row -->
        <div class="row">

            @if(Auth::user()->rol == 'medewerker')
            <div class="col-lg-2">
                <h3><i class="fa fa-hashtag"></i>{{$bug->id}}
                @if($bug->prioriteit == 1)
                <span class="label label-success pull-right">Laag</span>
                @elseif($bug->prioriteit == 2)
                <span class="label label-warning pull-right">Gem.</span>
                @elseif($bug->prioriteit == 3)
                <span class="label label-danger pull-right">Hoog</span>
                @elseif($bug->prioriteit == 4)
                <span class="label label-purple pull-right">Krit.</span>
                @else
                <span class="label label-info pull-right">Geen</span>
                @endif
                <a type="button" style="margin-right:20px;!important;"  class="pull-right clickable" data-toggle="modal" data-target="#projectDetails">
                  <i class="fa fa-flask fa-2x"></i>
                </a>
                </h3>
                @endif

                {{--controls--}}
                @if(Auth::user()->rol == 'medewerker')
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="/updateBug/{{$bug->id}}">
                           {!! csrf_field() !!}
                           <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="sel1">Verander prioriteit</label>
                                <select class="form-control" id="prioriteit" name="prioriteit">
                                    <option value="4"  @if($bug->prioriteit == 4) selected @endif >Kritisch</option>
                                    <option value="3" @if($bug->prioriteit == 3) selected @endif >Hoog</option>
                                    <option value="2"  @if($bug->prioriteit == 2) selected @endif >Gemiddeld</option>
                                    <option value="1" @if($bug->prioriteit == 1) selected @endif >Laag</option>
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
                            <label for="end_date">Einddatum</label>
                              {{--<input type="text"  name="eind_datum" class="form-control" id="einddatum">--}}
                              <input type="text" name="eind_datum" class="form_datetime form-control date-picker" placeholder="@if($bug->eind_datum != '0000-00-00 00:00:00'){{date('d-m-Y H:i',strtotime($bug->eind_datum))}}
                              @else {{date('d-m-Y H:i')}} @endif
                              " data-rule-maxlength="30">
                            </div>
                            <button type="submit" class="btn btn-success center-block"><span class="fa fa-check" aria-hidden="true"></span> Opslaan</button>
                        </form>
                        <br>

                        <table class="table table-bordered table-responsive"  >
                            <tr>
                                <td>
                                <strong>Feedback titel</strong><br>
                                {{ $bug->titel }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <strong>Omschrijving</strong><br>
                                {!! $bug->beschrijving !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <strong>Start datum</strong><br>
                                {{date('d-m-Y - H:i',strtotime($bug->start_datum))}}
                                </td>
                            </tr>
                            <tr>
                                @if($bug->eind_datum == '0000-00-00 00:00:00')
                                    <td>
                                    <strong>Eind datum</strong><br>
                                    Geen deadline
                                    </td>
                                @else
                                    <td>
                                    <strong>Eind datum</strong><br>
                                    {{date('d-m-Y - H:i',strtotime($bug->eind_datum))}}
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td>
                                <strong>Soort</strong><br>
                                {{ $bug->soort }}
                                </td>
                            </tr>
                            @if(Auth::user()->rol == 'medewerker')
                            <tr>
                                <td>
                                <strong><i class="fa fa-user"></i> Contactpersoon</strong><br>
                                @if($bug->klant->geslacht == 'man'){{" Dhr. "}}@else{{" Mevr. "}}@endif{{ucfirst($bug->klant->voornaam) . ' ' . $bug->klant->tussenvoegsel .' '. $bug->klant->achternaam}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <strong><i class="fa fa-envelope-o"></i> E-mail</strong><br>
                                {{' '.$bug->klant->email}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <strong><i class="fa fa-mobile-phone fa-2x"></i> Telefoonnummer</strong><br>
                                {{$bug->klant->telefoonnummer}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong><i class="fa fa-building"></i> Bedrijf</strong><br>
                                    {{$bug->klant->bedrijf}}
                                </td>
                            </tr>
                        </table>
                    </div>
                  @endif
                  </div>
                </div>
                @endif
                {{--endcontrol--}}



            <div class="row">


                <div class="col-lg-2"></div>
                <div class="col-lg-9">
                <div class="col-lg-12">

                <div class="row">
                @if(Auth::user()->rol != 'medewerker')
                    <div class="col-lg-12">
                    <h3><i class="fa fa-hashtag"></i>{{$bug->id}}
                    @if($bug->prioriteit == 1)
                    <span class="label label-success ">Laag</span>
                    @elseif($bug->prioriteit == 2)
                    <span class="label label-warning ">Gem.</span>
                    @elseif($bug->prioriteit == 3)
                    <span class="label label-danger ">Hoog</span>
                    @elseif($bug->prioriteit == 4)
                    <span class="label label-purple ">Krit.</span>
                    @else
                    <span class="label label-info ">Geen</span>
                    @endif
                    </h3>
                    @endif

                </div>
                @if(Auth::user()->rol != 'medewerker')
                <table class="table table-bordered table-responsive">
                    <tr>
                        <td><strong>Feedback titel</strong></td>
                        <td>{{ $bug->titel }}</td>
                    </tr>
                    <tr>
                        <td><strong>Omschrijving</strong></td>
                        <td>{!! $bug->beschrijving !!}</td>
                    </tr>
                    <tr>
                        <td><strong>Start datum</strong></td>
                        <td>{{date('d-m-Y - H:i',strtotime($bug->start_datum))}}</td>
                    </tr>
                    <tr>
                        <td><strong>Eind datum</strong></td>
                        @if($bug->eind_datum == '0000-00-00 00:00:00')
                            <td>Geen deadline</td>
                        @else
                            <td>{{date('d-m-Y - H:i',strtotime($bug->eind_datum))}}</td>
                        @endif
                    </tr>
                    <tr>
                        <td><strong>Soort</strong></td>
                        <td>{{ $bug->soort }}</td>
                    </tr>
                </table>
                <hr>
                @endif
               </div>

                    <h3>Discussie</h3>
                    <ul class="list-unstyled" >
                    <li class="text-left">
                         <div class="panel-heading panel-success">
                          <i class="fa fa-fw fa-info fa-2x"></i>
                            <span class="label label-success">
                              Automatisch bericht
                            </span>
                            <div class="panel-heading" style="padding: 10px 50px 10px;">
                               U kunt hier een discussie voeren met een medewerker van Moodles. U kunt eventueel ook bijlages toevoegen aan uw bericht.
                            </div>
                         </div>
                        </li>
                      </ul>
                    <ul class="list-unstyled" id="display">
                    <li class="text-left">
                        @foreach($afzenders as $afzender)
                                        {{--mw--}}
                                       @if($afzender->medewerker)
                                       <div class="panel-heading panel-default">
                                       <img src="{{'../'.$afzender->medewerker->profielfoto}}" class="img-responsive img-circle pull-left small_avatar" alt="medewerker_ava"/>
                                      <span class="label label-default">
                                        {{$afzender->medewerker->voornaam.' '.$afzender->medewerker->tussenvoegsel.' '. $afzender->medewerker->achternaam}}
                                      </span>
                                        @elseif($afzender->klant)
                                        <div class="panel-heading panel-info">
                                        {{--klant--}}
                                        <img src="{{'../'.$afzender->klant->profielfoto}}" class="img-responsive img-circle pull-left small_avatar" alt="klant_ava"/>
                                      <span class="label label-info">
                                        {{$afzender->klant->voornaam .' '.$afzender->klant->tussenvoegsel.' '. $afzender->klant->achternaam}}
                                      </span>
                                      @endif
                                    <span class="pull-right label label-default"><i class="fa fa-clock-o"></i> {{$afzender->created_at->format('d-m-Y H:i:s')}}</span>

                                <div class="panel-heading">
                                    {!! $afzender->bericht !!}
                                </div>
                            </div>
                            @endforeach
                        </li>
                    </ul>

                    <form method="POST" class="formulier" action="/sendMessage" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="hidden" name="afzender_id"        value="{{Auth::user()->id}}">
                            @if(Auth::user()->rol == 'medewerker')
                                <input type="hidden" name="klant_id"        value="0">
                                <input type="hidden" name="medewerker_id"        value="{{Auth::user()->id}}">
                            @elseif(Auth::user()->rol != 'medewerker')
                                <input type="hidden" name="klant_id"        value="{{Auth::user()->id}}">
                                <input type="hidden" name="medewerker_id"        value="0">
                            @endif
                            <input type="hidden" name="bug_id"          value="{{$bug->id}}">
                            <input type="hidden" name="project_id"      value="{{$bug->project_id}}">

                            @if($bug->status == 'gesloten')
                            <div class="panel-heading panel-success">
                             <i class="fa fa-fw fa-info fa-2x"></i>
                            <span class="label label-success">
                              Automatisch bericht
                            </span>
                            <div class="panel-heading">
                                De discussie is gesloten. Bedankt voor uw medewerking!
                            </div>
                            </div>
                            <label for="bericht">Bericht : </label>
                            <span class="label label-danger">De discussie is gesloten</span>
                            <textarea class="form-control" name="bericht" id="bericht" disabled rows="6">
                            <h3>De discussie is gesloten</h3>
                            </textarea>
                            @else
                            <textarea class="form-control" name="bericht" id="bericht" rows="6"></textarea>
                            @endif
                        </div>
                        @if($bug->status == 'gesloten')

                        @elseif($bug->status != 'gesloten')
                        <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <button data-toggle="tooltip" title="U kunt ook bijlages mee versturen! Klik op 'Bijlages kiezen'!" type="submit" style="margin-left:10px;" class="btn btn-success pull-right sendButton">
                                <i class="fa fa-send"></i> Verstuur
                            </button>
                            <div class="input-group">
                              <span class="input-group-btn">
                                <span class="btn btn-success" data-toggle="tooltip" title="Hier kunt u een bestand kiezen als bijlage" onclick="$(this).parent().find('input[type=file]').click();"><i class="fa fa-search" ></i> Bijlage kiezen</span>
                                <input name="file[]" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
                              </span>
                              <span class="form-control"></span>
                            </div>
                            @if(Auth::user()->rol == 'medewerker')
                            <label class="checkbox-inline"><input type="checkbox" name="checkboxMsg" value="checked">Stuur e-mail notificatie naar klant</label>
                            @endif
                        </div>
                       </div>

                        @else
                        @endif
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="projectDetails" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title">Project details</h4>
                                        </div>
                                        <div class="modal-body">
                                          <table class="table table-bordered table-responsive">
                                              <tr>
                                                  <td><strong>Project naam</strong></td>
                                                  <td>{{ $bug->project->projectnaam }}</td>
                                              </tr>
                                              <tr>
                                                  <td><strong>Omschrijving</strong></td>
                                                  <td>{!! $bug->project->omschrijvingproject !!}</td>
                                              </tr>
                                              <tr>
                                                  <td><strong>Live url</strong></td>
                                                  <td><a style="text-decoration: underline;" target="_blank" href="http://{{$bug->project->liveurl }}">{!! $bug->project->liveurl !!}</a></td>
                                              </tr>
                                              <tr>
                                                  <td><strong>Development url</strong></td>
                                                  <td><a style="text-decoration: underline;" target="_blank" href="http://{{ $bug->project->developmenturl }}">{!! $bug->project->developmenturl !!}</a></td>
                                              </tr>

                                              <tr>
                                                  <td><strong>Admin</strong></td>
                                                  <td>{{ $bug->project->gebruikersnaam }}</td>
                                              </tr>
                                              <tr>
                                                  <td><strong>Password</strong></td>
                                                  <td><i data-toggle="tooltip" title="Wachtwoord : {!! \Crypt::decrypt($bug->project->wachtwoord) !!}" class="fa fa-eye" ></i></td>
                                              </tr>


                                          </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                                        </div>
                                      </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                  </div><!-- /.modal -->
<!-- /.container-fluid -->
{{--</div>--}}
<!-- /#page-wrapper -->
         @section('scripts')
            {{--<script type="text/javascript">--}}
                {{--function changeImage(img){--}}
                    {{--var image = document.getElementById('image');--}}
                    {{--image.src = '../'+img;--}}
                {{--}--}}
            {{--</script>--}}
            <script type="text/javascript" src="{{URL::asset('../assets/js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script>
            <script type="text/javascript" src="{{URL::asset('../assets/js/locales/bootstrap-datetimepicker.nl.js')}}" charset="UTF-8"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                       $(".form_datetime").datetimepicker({
                       language: 'nl',
                       weekStart: 1,
                       format: 'd-m-yyyy hh:ii',
                       autoclose:true
                       });
                       $('.sendButton').click(function(e){
                            var $this = $(this);
                            var form = $('.formulier');
                            $this.toggleClass('sendButton');
                            if($this.hasClass('sendButton')){
                                $this.text('Verstuur')
                            }else{
                                $this.html("<i class='fa fa-spinner fa-spin' ></i>Versturen..");
                                $this.attr("disabled", true);
                                e.preventDefault();
                                setTimeout(function(){
                                    form.submit()
                                },2000);
                            }
                       })
                });
            </script>

        @endsection
     @extends('layouts.footer')
   </body>
 </html>