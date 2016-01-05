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
                            <button type="submit" class="btn btn-success center-block"><span class="fa fa-check" aria-hidden="true"></span> Verander</button>
                        </form>
                        <br>
                    </div>
                </div>
                @endif
                <div class="row">

                    <div class="col-lg-12">

                            <div id="message"></div>
                           <form id="upload" action="upload" enctype="multipart/form-data">

                               <input type="hidden" name="id" value="{{$bug->id}}">
                                {!! csrf_field() !!}
                               <pre><i class="fa fa-info"></i> Houd <kbd>ctrl</kbd> ingedrukt om meerdere bestanden te kiezen</pre>
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                {{--<input type="file" name="file[]" style="color:transparent;" onchange="this.style.color = 'transparant';"   multiple>--}}
                                <span class="btn btn-success btn-xs btn-file pull-left">
                                    <i class="glyphicon glyphicon-search" ></i> Verkenner <input type="file" name="file[]" style="color:transparent;" onchange="this.style.color = 'transparant';"   multiple>
                                 </span>
                                </div>
                                <div class="col-lg-6"><input type="submit" value="Upload" class="btn btn-success btn-xs pull-right"></div>
                                </div>
                           </form>
                       <br>


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


            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-9">
                <div class="col-lg-12 well well-sm">

                <div class="row">
                    <div class="col-lg-6">
                        <h3>Bug details</h3>
                            <p style="white-space: pre-wrap;"><strong>Bug titel </strong> {!! $bug->titel !!}</p>
                            <p style="white-space: pre-wrap;"><strong>Omschrijving </strong> {!! $bug->beschrijving !!}</p>
                    </div>
                    <div class="col-lg-6">
                    @if(Auth::user()->bedrijf == 'moodles')
                        <h3>Project details</h3>
                            <p style="white-space: pre-wrap;"><strong>Projectnaam </strong> {!! $bug->project->projectnaam !!}</p>
                            <p style="white-space: pre-wrap;"><strong>Omschrijving </strong> {!! $bug->project->omschrijvingproject !!}</p>
                            @endif
                    </div>
                </div>
               </div>
                    <h3>Discussie
                        <button onclick="refresh_feed()" class="btn btn-default btn-xs pull-right">
                           <i class="fa fa-refresh fa-spin"></i>
                           refresh feed
                        </button>

                            <button class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">
                            Bijlages zien
                               <i class="glyphicon glyphicon-camera"></i>
                            </button>


                    </h3>
                    <ul class="list-unstyled" >
                    <li class="text-left">
                         <div class="panel-heading panel-success">
                          <i class="fa fa-fw fa-info fa-2x"></i>
                         <span class="label label-success">
                           Automatisch bericht
                         </span>
                         <div class="panel-heading" style="padding: 10px 50px 10px;">
                            Elke 5 minuten wordt de chat feed ververst. Mocht u handmatig willen verversen,Kunt u rechts boven op :
                             <button class="btn btn-default btn-xs disabled">
                                <i class="fa fa-refresh fa-spin"></i>
                                refresh feed
                             </button>
                             drukken.
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
                                        <img src="{{'../'.$afzender->klant->profielfoto}}" class="img-responsive img-circle pull-left small_avatar" alt="medewerker_ava"/>
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

                    <form method="POST" action="/sendMessage">
                    {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="hidden" name="afzender_id"        value="{{Auth::user()->id}}">
                            @if(Auth::user()->bedrijf == 'moodles')
                                <input type="hidden" name="klant_id"        value="0">
                                <input type="hidden" name="medewerker_id"        value="{{Auth::user()->id}}">
                            @elseif(Auth::user()->bedrijf != 'moodles')
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
                        <button type="submit" class="btn btn-danger disabled" disabled>
                            <i class="fa fa-send"></i> Verstuur
                        </button>
                        @else
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-send"></i> Verstuur
                        </button>
                        @endif
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Bijlages voor Bug : #{{$bug->id}}</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-lg-3">
                <ul class="list-unstyled center-block" id="images">
                @if(count($bug_attachments) > 0)
                @foreach($bug_attachments as $ba)
                    <li name="{{$ba->image}}" style="padding-bottom: 5px;">
                    <button onclick="changeImage({{json_encode($ba->image)}})" class="btn btn-success btn-xs">{{substr($ba->image,31,40)}}</button>
                    </li>
                @endforeach
                @else
                <i class="pull-right fa fa-exclamation fa-3x"></i>
                @endif
                </ul>
            </div>
            <div class="col-lg-9">
            @if(count($bug_attachments) > 0)
            <img id="image" src="{{'../'.$ba->image}}" class="img-responsive img-thumbnail center-block" alt="img_{{$ba->image}}">
            @else
            <h3 class="pull-left">Helaas, er zijn nog geen bijlages toegevoegd!</h3>
            <p class="pull-left">
            Om bijlages te toevoegen moet u dit venster sluiten, En in het linker gedeelte op de knop
            <var>Verkenner</var> drukken.<br>
            Om meerdere bestanden tegelijk te uploaden houd u de knop <kbd>ctrl</kbd> ingedrukt op uw toetsenbord.

            <code>Let erop: u kunt alleen afbeeldingen uploaden.</code>


            </p>
            @endif
            </div>
            </div>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span>sluiten</span></button>
          </div>
        </div>
      </div>
    </div>
<!-- /.container-fluid -->
{{--</div>--}}
<!-- /#page-wrapper -->
         @section('scripts')
            <script type="text/javascript">
                function changeImage(img){
                    var image = document.getElementById('image');
                    image.src = '../'+img;
                }
            </script>

                <script type="text/javascript">
                var form = document.getElementById('upload');
                var request = new XMLHttpRequest();

                form.addEventListener('submit', function(e){
                e.preventDefault();
                var formdata = new FormData(form);

                request.open('post','/upload');
                request.addEventListener("load", transferComplete)
                request.send(formdata);
                });

                function transferComplete(data){
                var something = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                response = JSON.parse(data.currentTarget.response);
                    if(response.success){
                        if ( document.getElementById("message").className.match(/(?:^|\s)alert aler-danger(?!\S)/) ){
                            document.getElementById("message").className =
                            document.getElementById("message").className.replace
                            ( /(?:^|\s)alert alert-danger(?!\S)/g , '' )
                        }else{
                            document.getElementById('message').className += "alert alert-info";
                            document.getElementById('message').innerHTML = "Bestanden uploaden voltooid.";
                            $("#message").append(something);
                        }
                    }else{
                        if( document.getElementById("message").className.match(/(?:^|\s)alert alert-danger(?!\S)/) ){
                            document.getElementById("message").className =
                            document.getElementById("message").className.replace
                            ( /(?:^|\s)alert alert-info(?!\S)/g , '' )
                        }else{
                            document.getElementById('message').className += "alert alert-danger";
                            document.getElementById('message').innerHTML = "Bestanden uploaden mislukt.";
                            $("#message").append(something);
                        }
                    }
                }
                </script>

                <script type="text/javascript">
                function convertDate(inputFormat) {
                  function pad(s) { return (s < 10) ? '0' + s : s; }
                  var d = new Date(inputFormat);
                  return[
                      ("00" + d.getDate()).slice(-2) + "-" +
                      ("00" + (d.getMonth() + 1)).slice(-2) + "-" +
                      d.getFullYear() + " " +
                      ("00" + d.getHours()).slice(-2) + ":" +
                      ("00" + d.getMinutes()).slice(-2) + ":" +
                      ("00" + d.getSeconds()).slice(-2)];
                }

                function refresh_feed(){
                $.ajax({
                    url: '/refreshChat/'+ {{$bug->id}},
                    data: {},
                    type: 'GET',
                    _token: "{{ csrf_token() }}",
                    success: function (data) {
                        var count = 0;
                        var div = '<li class="text-left">';
                        var div = '<input type="hidden" id="counted_rows" value="+ count +">';


                        $.each(data, function(index, elem) {
                            if (elem.medewerker) {
                            div += '<div class="panel-heading panel-default">';
                            {{--<img src="{{'../'.$afzender->medewerker->profielfoto}}" class="img-responsive img-circle pull-left" alt="medewerker_ava"--}}
                            div += '<img class="img-responsive img-circle pull-left small_avatar" alt="medewerker_ava" src=" '+ '../'+ elem.medewerker.profielfoto +' " />';
                            div += '<span class="label label-default">'+ elem.medewerker.voornaam +' '+ elem.medewerker.tussenvoegsel +' '+ elem.medewerker.achternaam + '</span>';
                            div += '<span class="pull-right label label-default"><i class="fa fa-clock-o"></i> ' + convertDate(elem.created_at)+ '</span>' ;
                            div += '<div class="panel-heading">';
                            div +=  elem.bericht;
                            div += '</div>';
                            div += '</div>';
                            }
                            else {
                            div += '<div class="panel-heading panel-info">';
                            div += '<img class="img-responsive img-circle pull-left small_avatar" alt="klant_ava" src=" '+ '../'+ elem.klant.profielfoto +' " />';
                            div += '<span class="label label-info">' + elem.klant.voornaam +' '+ elem.klant.tussenvoegsel +' '+ elem.klant.achternaam + '</span>';
                            div +=  ' <span class="pull-right label label-default"><i class="fa fa-clock-o"></i> ' + convertDate(elem.created_at)+ '</span>' ;
                            div += '<div class="panel-heading">'
                            div +=  elem.bericht;
                            div += '</div>';
                            div += '</div>';
                            }
                            count++;

                        });

                        div += '</li>';
                        $("#display").html(div);
                    }
                });
              }setInterval(function(){check_feed_count()}, 300000);

                </script>
        @endsection
     @extends('layouts.footer')
   </body>
 </html>
