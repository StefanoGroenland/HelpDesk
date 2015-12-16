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
                            Project wijzigen <small>Hier kan een project worden veranderd/aangemaakt worden</small>
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
                    <div class="col-lg-4">
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <h3 class="panel-title">Verander project</h3>
                          </div>
                          <div class="panel-body">
                            <form method="POST" action="/updateProject">
                                               {!! csrf_field() !!}
                                               <input type="hidden" name="_method" value="PUT">
                                                 <div class="form-group">
                                                   <div class="input-group">
                                                     <input type="text"  id="zoeknaam" name="zoeknaam" class="form-control" placeholder="Projectnaam">
                                                     <span class="input-group-btn">
                                                       <button class="btn btn-default" id="zoekKnop2" name="zoekProject" type="button">Zoek project</button>
                                                     </span>
                                                   </div>
                                                 </div>
                            <div class="form-group">
                                <label for="bedrijfsnaam">Project</label>
                               <input type="text" class="form-control titel2" id="titel2" required="true" name="titel" placeholder="Titel">
                               <input type="hidden" class="form-control id2" id="id2"  name="id">
                             </div>
                             <div class="form-group">
                                 <select class="form-control status2" id="status2" name="status" required="true">
                                   <option value="open">Open</option>
                                   <option value="bezig">Bezig</option>
                                   <option value="gesloten">Gesloten</option>
                                 </select>
                               </div>
                               <div class="form-group">
                                 <select class="form-control prioriteit2" id="prioriteit2" required="true" name="prioriteit">
                                   <option value="laag">Laag</option>
                                   <option value="gemiddeld">Gemiddeld</option>
                                   <option value="hoog">Hoog</option>
                                   <option value="kritisch">Kritisch</option>
                                 </select>
                               </div>
                               <div class="form-group">
                                <select class="form-control soort2" id="soort2" required="true" name="soort">
                                  <option value="lay-out">Lay-out</option>
                                  <option value="seo">SEO</option>
                                  <option value="performance">Performance</option>
                                  <option value="code">Code</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control projectnaam2" required="true" id="projectnaam2" name="projectnaam" placeholder="Projectnaam" value="">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control projecturl2" required="true" id="projecturl2" name="projecturl" placeholder="Project URL" value="">
                              </div>
                                <div class="form-group">
                                <label for="bedrijfsnaam">Beheer account</label>
                                <input type="text" class="form-control gebruikersnaam2" required="true" id="gebruikersnaam2" name="gebruikersnaam" placeholder="Gebruikersnaam" value="">
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control wachtwoord2"  required="true"id="wachtwoord2" name="wachtwoord" placeholder="Wachtwoord" value="">
                              </div>


                              <div class="form-group">
                                 <textarea class="form-control omschrijving2" rows="5" id="omschrijving2" name="omschrijvingproject" value="" ></textarea>
                               </div>

                              <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Verander</button>

                            </div>
                           </div>
                        </form>
                         </div>
                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <th>Project</th>
                                <th>URL</th>
                                <th>Klantnummer</th>
                                <th></th>
                                <th></th>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                      <tr>
                                      <td>{{$project->projectnaam}}</td>
                                      <td>{{$project->projecturl}}</td>
                                      <td>{{$project->gebruiker_id}}</td>
                                      <td>
                                         {{--<input type="hidden" class="zoeknaam2" value="{{$project->projectnaam}}"  name="zoeknaam2" class="form-control" placeholder="Projectnaam">--}}
                                           <button class="btn btn-success btn-xs wijzigKnop2" name="zoekProject" type="button" data-project="{{$project->projectnaam}}">
                                                  <i class="glyphicon glyphicon-pencil"></i>
                                           </button>
                                      </td>
                                        <td>
                                        <a href="/verwijderProject/{{$project->id}}" class="">
                                            <button type="submit" class="btn btn-danger btn-xs">
                                               <i class="glyphicon glyphicon-remove"></i>
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
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
            @section('scripts')
                    <script type="text/javascript">
                        $("#zoekKnop2").on("click",function(){

                                var email = $('#zoeknaam').val();
                                $('#titel2').val('');
                                $('#id2').val('');
                                $('#status2').val('');
                                $('#prioriteit2').val('');
                                $('#type2').val('');
                                $('#projectnaam2').val('');
                                $('#projecturl2').val('');
                                $('#gebruikersnaam2').val('');
                                $('#wachtwoord2').val('');
                                $('#omschrijving2').val('');

                                $.ajax({
                                  method: "POST",
                                  url: "/updateProjectData",
                                  data: {   input: email ,
                                            _token: "{{ csrf_token() }}"
                                        }
                                })
                                  .done(function( msg ) {
                                    $('#titel2').val(msg[0].titel);
                                    $('#id2').val(msg[0].id);
                                    $('#status2').val(msg[0].status);
                                    $('#prioriteit2').val(msg[0].prioriteit);
                                    $('#soort2').val(msg[0].soort);
                                    $('#projectnaam2').val(msg[0].projectnaam);
                                    $('#projecturl2').val(msg[0].projecturl);
                                    $('#gebruikersnaam2').val(msg[0].gebruikersnaam);
                                    $('#wachtwoord2').val(msg[0].wachtwoord);
                                    $('#omschrijving2').val(msg[0].omschrijvingproject);
                                  });
                        });
                    </script>
                    <script type="text/javascript">
                    $(".wijzigKnop2").on("click",function(){



                    var email2 = $(this).data('project');
                     $('.titel2').val('');
                     $('#id2').val('');
                     $('.status2').val('');
                     $('.prioriteit2').val('');
                     $('.type2').val('');
                     $('.projectnaam2').val('');
                     $('.projecturl2').val('');
                     $('.gebruikersnaam2').val('');
                     $('.wachtwoord2').val('');
                     $('.omschrijving2').val('');

                     $.ajax({
                       method: "POST",
                       url: "/updateProjectData",
                       data: {   input: email2 ,
                                 _token: "{{ csrf_token() }}"
                             }
                     })
                       .done(function( msg ) {
                        console.log(msg);
                         $('.titel2').val(msg[0].titel);
                         $('.id2').val(msg[0].id);
                         $('.status2').val(msg[0].status);
                         $('.prioriteit2').val(msg[0].prioriteit);
                         $('.soort2').val(msg[0].soort);
                         $('.projectnaam2').val(msg[0].projectnaam);
                         $('.projecturl2').val(msg[0].projecturl);
                         $('.gebruikersnaam2').val(msg[0].gebruikersnaam);
                         $('.wachtwoord2').val(msg[0].wachtwoord);
                         $('.omschrijving2').val(msg[0].omschrijvingproject);
                       });

                     });
                    </script>


                    @stop
    </div>
    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
