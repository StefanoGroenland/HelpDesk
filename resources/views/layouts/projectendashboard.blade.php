
 @if(\Auth::user()->bedrijf != 'moodles')
 <div class="col-lg-12">
                 @foreach($projects as $project)
                                         {{-- */$i=0;/* --}}
                                         {{-- */$x=0;/* --}}
                                         {{-- */$y=0;/* --}}
                                         {{-- */$unread=0;/* --}}
                                         {{-- */$crit = '';/* --}}
                                         {{-- */$high = '';/* --}}
                                         {{-- */$avg = '';/* --}}
                                         {{-- */$low = '';/* --}}
                                         {{-- */$panel_type = '';/* --}}
                                        <div class="col-lg-2 col-md-6">
                                        @if($project->bug)
                                        @foreach($project->bug as $bug)

                                          @if($bug->prioriteit == 4 && $bug->status != 'gesloten')
                                          {{-- */$crit='kritisch';/* --}}
                                          @elseif($bug->prioriteit == 3 && $bug->status != 'gesloten')
                                          {{-- */$high='hoog';/* --}}
                                          @elseif($bug->prioriteit == 2 && $bug->status != 'gesloten')
                                          {{-- */$avg='gemiddeld';/* --}}
                                          @elseif($bug->prioriteit == 1 && $bug->status != 'gesloten')
                                          {{-- */$low='laag';/* --}}
                                          @else
                                          @endif
                                        @endforeach
                                        @endif
                                                 @if($crit == 'kritisch')
                                                     {{-- */$panel_type='purple';/* --}}
                                                 @elseif($high == 'hoog')
                                                     {{-- */$panel_type='red';/* --}}
                                                 @elseif($avg == 'gemiddeld')
                                                     {{-- */$panel_type='yellow';/* --}}
                                                 @elseif($low == 'laag')
                                                     {{-- */$panel_type='green';/* --}}
                                                     @else
                                                     {{-- */$panel_type='default';/* --}}
                                                 @endif

                                                 <div class="panel panel-{{$panel_type}}">
                                                <div class="panel-heading" style="padding-left:10px;padding-right:10px;">
                                                <a href="/bugs/{{$project->id}}">
                                                    <div class="row">
                                                    @foreach($bugs_send as $bug)
                                                         @if($bug->last_admin > 0)
                                                             @if($bug->project_id == $project->id)
                                                             {{-- */$unread ++;/* --}}
                                                             @endif
                                                         @endif
                                                    @endforeach
                                                    <div id='notificatie'><div>
                                                        {{$unread}}
                                                        </div></div>
                                                        <div class="col-xs-12 text-right">
                                                        @if($project->prioriteit == 1)
                                                            <span class="label label-success">{{$project->projectnaam}}</span>
                                                        @elseif($project->prioriteit == 2)
                                                            <span class="label label-yellow">{{$project->projectnaam}}</span>
                                                        @elseif($project->prioriteit == 3)
                                                            <span class="label label-danger">{{$project->projectnaam}}</span>
                                                        @elseif($project->prioriteit == 4)
                                                            <span class="label label-purple">{{$project->projectnaam}}</span>
                                                            @else
                                                            <span class="label label-default">{{$project->projectnaam}}</span>
                                                        @endif
                                                            <div><span class="badge">
                                                            @foreach($bugs_send as $bug)

                                                            @if($bug->status == 'open')
                                                                @if($bug->project_id == $project->id)
                                                                    {{-- */$i++/* --}}
                                                                @endif
                                                            @endif
                                                            @endforeach
                                                            {{$i}}
                                                            </span> Openstaand</div>
                                                            <div><span class="badge">
                                                            @foreach($bugs_send as $bug)
                                                            @if($bug->status == 'bezig')
                                                                @if($bug->project_id == $project->id)
                                                                    {{-- */$x++/* --}}
                                                                @endif
                                                            @endif
                                                            @endforeach
                                                            {{$x}}
                                                            </span> Bezig</div>
                                                            <div><span class="badge">
                                                            @foreach($bugs_send as $bug)
                                                            @if($bug->status == 'gesloten')
                                                                @if($bug->project_id == $project->id)
                                                                    {{-- */$y++/* --}}
                                                                @endif
                                                            @endif
                                                            @endforeach
                                                            {{$y}}
                                                            </span> Gesloten</div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                                <a href="/bugs/{{$project->id}}">
                                        <div class="panel-footer">
                                            <span class="pull-left">Bekijk</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                                </div>
                            @endforeach
@else
                @if(count($projects) > 0)
                                @foreach($projects as $pro)
                                {{-- */$unread=0;/* --}}
                                 {{-- */$i=0;/* --}}
                                 {{-- */$x=0;/* --}}
                                 {{-- */$y=0;/* --}}
                                 {{-- */$krit=0;/* --}}
                                 {{-- */$hoog=0;/* --}}
                                 {{-- */$gem=0;/* --}}
                                 {{-- */$laag=0;/* --}}
                                 {{-- */$crit = '';/* --}}
                                 {{-- */$high = '';/* --}}
                                 {{-- */$avg = '';/* --}}
                                 {{-- */$low = '';/* --}}
                                 {{-- */$panel_type = '';/* --}}
                                <div class="col-lg-2 col-md-6">

                                @foreach($pro->bug as $bug)

                                @if($bug->prioriteit == 4 && $bug->status != 'gesloten')
                                {{-- */$crit='kritisch';/* --}}
                                @elseif($bug->prioriteit == 3 && $bug->status != 'gesloten')
                                {{-- */$high='hoog';/* --}}
                                @elseif($bug->prioriteit == 2 && $bug->status != 'gesloten')
                                {{-- */$avg='gemiddeld';/* --}}
                                @elseif($bug->prioriteit == 1 && $bug->status != 'gesloten')
                                {{-- */$low='laag';/* --}}
                                @else
                                @endif
                                @endforeach


                                @if($crit == 'kritisch')
                                       {{-- */$panel_type='purple';/* --}}
                                   @elseif($high == 'hoog')
                                       {{-- */$panel_type='red';/* --}}
                                   @elseif($avg == 'gemiddeld')
                                       {{-- */$panel_type='yellow';/* --}}
                                   @elseif($low == 'laag')
                                       {{-- */$panel_type='green';/* --}}
                                       @else
                                       {{-- */$panel_type='default';/* --}}
                                   @endif

                                        <div class="panel panel-{{$panel_type}}">
                                        <div class="panel-heading" style="padding-left:10px;padding-right:10px;">
                                        <a href="/bugs/{{$pro->id}}">
                                            <div class="row">
                                                @foreach($bugs as $bug)
                                                    @if($bug->last_client > 0)
                                                        @if($bug->project_id == $pro->id)
                                                        {{-- */$unread ++;/* --}}
                                                        @endif
                                                    @endif
                                                    @if($bug->prioriteit == 1)
                                                        @if($bug->project_id == $pro->id)
                                                        {{-- */$laag++;/* --}}
                                                        @endif
                                                    @endif
                                                    @if($bug->prioriteit == 2)
                                                        @if($bug->project_id == $pro->id)
                                                        {{-- */$gem++;/* --}}
                                                        @endif
                                                    @endif
                                                    @if($bug->prioriteit == 3)
                                                        @if($bug->project_id == $pro->id)
                                                        {{-- */$hoog++;/* --}}
                                                        @endif
                                                    @endif
                                                    @if($bug->prioriteit == 4)
                                                        @if($bug->project_id == $pro->id)
                                                        {{-- */$krit++;/* --}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                                <div id='notificatie'><div>
                                                {{$unread}}
                                                </div></div>
                                                <div class="col-xs-12 text-right pull-right">
                                                <span style="border: solid #ffffff 1px;" class="label label-purple pull-left">{{$krit}}</span>

                                                    <small><strong>{{substr($pro->projectnaam,0,15)}}..</strong></small>
                                                    <div>
                                                    <span style="border: solid #ffffff 1px;" class="label label-danger pull-left">{{$hoog}}</span><span class="badge">
                                                    @foreach($bugs as $bug)
                                                    @if($bug->status == 'open')
                                                        @if($bug->project_id == $pro->id )
                                                            {{-- */$i++/* --}}
                                                        @endif
                                                    @endif
                                                    @endforeach
                                                    {{$i}}
                                                    </span> Openstaand</div>
                                                    <span style="border: solid #ffffff 1px;" class="label label-warning pull-left">{{$gem}}</span>
                                                    <div><span class="badge">
                                                    @foreach($bugs as $bug)
                                                    @if($bug->status == 'bezig')
                                                        @if($bug->project_id == $pro->id)
                                                            {{-- */$x++/* --}}
                                                        @endif
                                                    @endif
                                                    @endforeach
                                                    {{$x}}
                                                    </span> Bezig</div>
                                                    <span style="border: solid #ffffff 1px;" class="label label-success pull-left">{{$laag}}</span>
                                                    <div><span class="badge">
                                                    @foreach($bugs as $bug)
                                                    @if($bug->status == 'gesloten')
                                                        @if($bug->project_id == $pro->id)
                                                            {{-- */$y++/* --}}
                                                        @endif
                                                    @endif
                                                    @endforeach
                                                    {{$y}}
                                                    </span> Gesloten</div>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                         <a href="/bugs/{{$pro->id}}">
                                            <div class="panel-footer">
                                                <span class="pull-left">Bekijk</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>

                                    </div>

                                    </div>

                                @endforeach
                                  @endif
@endif