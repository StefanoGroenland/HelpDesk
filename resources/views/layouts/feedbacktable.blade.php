
 @if(\Auth::user()->bedrijf != 'moodles')
                    <div class="col-lg-12">
                        <h4>Verstuurde feedback</h4>
                        <div class="table-responsive">
                        <table class="table table-hover data_table">
                                <thead>
                                <th>Gepost op :</th>
                                <th>Start datum</th>
                                <th>Deadline</th>
                                <th>Soort</th>
                                <th>Status</th>
                                <th>Prioriteit</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @foreach($bugs_send as $bug)
                                    <tr style="cursor:pointer;!important;" data-href="/bugchat/{{$bug->id}}">
                                        <td>{{$bug->created_at->format('d-m-Y - H:i')}}</td>
                                        <td>{{date('d-m-Y - H:i',strtotime($bug->start_datum))}}</td>
                                        @if($bug->eind_datum == '0000-00-00 00:00:00')
                                        <td>Geen eind datum.</td>
                                        @else
                                        <td>{{date('d-m-Y - H:i',strtotime($bug->eind_datum))}}</td>
                                        @endif
                                        <td>{{$bug->soort}}</td>
                                        <td>{{$bug->status}}</td>
                                        <td>
                                        @if($bug->prioriteit == 1)
                                        <span class="label label-success">Laag</span>
                                        @elseif($bug->prioriteit == 2)
                                        <span class="label label-warning">Gemiddeld</span>
                                        @elseif($bug->prioriteit == 3)
                                        <span class="label label-danger">Hoog</span>
                                        @elseif($bug->prioriteit == 4)
                                        <span class="label label-purple">Kritisch</span>
                                        @else
                                        <span class="label label-info">Geen prioriteit</span>
                                        @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="/bugchat/{{$bug->id}}">
                                        <button type="submit" class="btn btn-success btn-xs">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @section('scripts')
                                <script type="text/javascript">
                                   $(document).ready(function() {
                                         $('.data_table').on("click",'tr[data-href]',  function() {
                                            window.location.href = $(this).data('href');
                                        });
                                        $('.deleteButton').on("click", function(event) {

                                            var modalId = $(this).data('modal-id');
                                            event.stopPropagation();
                                            jQuery.noConflict()
                                            $('#myModal'+modalId).modal('show');
                                        });
                                   })
                                </script>
                    @endsection
                    @else
                    <div class="col-lg-12">
                                            <h4>Laatst gemelde feedback</h4>
                                            <div class="table-responsive">
                                            <table class="table table-hover data_table">
                                                    <thead>
                                                    <th>Gepost op </th>
                                                    <th>Status </th>
                                                    <th>Startdatum</th>
                                                    <th>Deadline</th>
                                                    <th>Feedback</th>
                                                    <th>Prioriteit</th>
                                                    <th>Klant</th>
                                                    <th>Project</th>
                                                    <th></th>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($bugs) > 0)
                                                    @foreach($bugs as $bug)

                                                        <tr style="cursor:pointer;!important;" data-href="/bugchat/{{$bug->id}}">
                                                            {{--@if($bug->updated_at == '0000-00-00 00:00:00')--}}
                                                            {{--<td>{{$bug->created_at->format('d-m-y - H:i')}}</td>--}}
                                                            {{--@else--}}
                                                            {{--<td>{{$bug->updated_at->format('d-m-y - H:i')}}</td>--}}
                                                            {{--@endif--}}
                                                            <td>{{$bug->created_at->format('d-m-Y - H:i')}}</td>
                                                            <td>{{$bug->status}}</td>
                                                            <td>{{date('d-m-Y - H:i',strtotime($bug->start_datum))}}</td>
                                                            @if($bug->eind_datum == '0000-00-00 00:00:00')
                                                            <td>Geen eind datum.</td>
                                                            @else
                                                            <td>{{date('d-m-Y - H:i',strtotime($bug->eind_datum))}}</td>
                                                            @endif
                                                            <td>{{$bug->titel}}</td>
                                                            <td>
                                                            @if($bug->prioriteit == 1)
                                                            <span class="label label-success">Laag</span>
                                                            @elseif($bug->prioriteit == 2)
                                                            <span class="label label-warning">Gemiddeld</span>
                                                            @elseif($bug->prioriteit == 3)
                                                            <span class="label label-danger">Hoog</span>
                                                            @elseif($bug->prioriteit == 4)
                                                            <span class="label label-purple">Kritisch</span>
                                                            @else
                                                            <span class="label label-info">Geen prioriteit</span>
                                                            @endif
                                                            </td>
                                                            @if($bug->klant)
                                                            <td>{{ucfirst($bug->klant->voornaam) .' '. $bug->klant->tussenvoegsel .' '. ucfirst($bug->klant->achternaam)}}</td>
                                                            @endif
                                                            @if($bug->project)
                                                                <td>{{$bug->project->projectnaam}}</td>
                                                            @endif
                                                            <td class="text-right" >
                                                                <a href="/bugchat/{{$bug->id}}">
                                                            <button type="submit" class="btn btn-success btn-xs">
                                                                <i class="glyphicon glyphicon-search"></i>
                                                            </button>
                                                               </a>
                                                            </td>
                                                        </tr>

                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @section('scripts')
                                                    <script type="text/javascript">
                                                       $(document).ready(function() {
                                                             $('.data_table').on("click",'tr[data-href]',  function() {
                                                                window.location.href = $(this).data('href');
                                                            });
                                                            $('.deleteButton').on("click", function(event) {

                                                                var modalId = $(this).data('modal-id');
                                                                event.stopPropagation();
                                                                jQuery.noConflict()
                                                                $('#myModal'+modalId).modal('show');
                                                            });
                                                       })

                                                    </script>
                                         @endsection

                                        @endif


