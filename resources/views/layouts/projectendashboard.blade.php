@if(\Auth::user()->rol != 'medewerker')
<div class="col-lg-12" style="padding-left:0px;!important;padding-right:0px;!important;" >
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
      <div class="panel panel-{{$panel_type}}" style="margin-top:-20px;!important;">
         <div class="panel-heading ph-top" style="padding-left:10px;padding-right:10px;">
            <a href="/bugs/{{$project->id}}">
               <div class="row">
                  @foreach($bugs_send as $bug)
                  @if($bug->last_admin > 0)
                  @if($bug->project_id == $project->id)
                  {{-- */$unread ++;/* --}}
                  @endif
                  @endif
                  @endforeach
                  @if($unread > 0)
                  <div id='notificatie'>
                     <div>
                        {{$unread}}
                     </div>
                  </div>
                  @endif
                  <div class="col-xs-12 text-right">
                     {{--<span class="label label-{{$panel_type}}">   </span>--}}
                     <div><span class="badge">
                        @foreach($bugs_send as $bug)
                            @if($bug->status == 'open')
                                @if($bug->project_id == $project->id)
                                {{-- */$i++/* --}}
                                @endif
                            @endif
                        @endforeach
                        {{$i}}
                        </span> Openstaand
                     </div>
                     <div><span class="badge">
                        @foreach($bugs_send as $bug)
                            @if($bug->status == 'bezig')
                                @if($bug->project_id == $project->id)
                                {{-- */$x++/* --}}
                                @endif
                            @endif
                        @endforeach
                        {{$x}}
                        </span> Bezig
                     </div>
                     <div><span class="badge">
                        @foreach($bugs_send as $bug)
                            @if($bug->status == 'gesloten')
                                @if($bug->project_id == $project->id)
                                {{-- */$y++/* --}}
                                @endif
                            @endif
                        @endforeach
                        {{$y}}
                        </span> Gesloten
                     </div>
                  </div>
               </div>
            </a>
         </div>
         <a href="/bugs/{{$project->id}}">
            <div class="panel-footer">
               <span class="pull-left" style="color:#aaaaaa;" >{{substr($project->projectnaam,0,20)}}</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
               <div class="clearfix"></div>
            </div>
         </a>
      </div>
   </div>
   @endforeach
</div>
@else
<div class="col-lg-12" style="padding-left:0px;!important;padding-right:0px;!important;" >
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
<div class="col-lg-2 col-md-6" style="padding-top:10px;" >
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
   <div class="panel panel-{{$panel_type}}" style="margin-top:-20px;!important;" >
      <div class="panel-heading ph-top" style="padding-left:10px;!important;padding-right:10px;!important;">
         <a href="/bugs/{{$pro->id}}">
            <div class="row">
               @foreach($bugs as $bug)
                    @if($bug->last_client > 0)
                         @if($bug->project_id == $pro->id)
                         {{-- */$unread ++;/* --}}
                         @endif
                    @endif
                    @if($bug->prioriteit == 1 && $bug->status != 'gesloten')
                         @if($bug->project_id == $pro->id)
                         {{-- */$laag++;/* --}}
                         @endif
                    @endif
                    @if($bug->prioriteit == 2 && $bug->status != 'gesloten')
                         @if($bug->project_id == $pro->id)
                         {{-- */$gem++;/* --}}
                         @endif
                    @endif
                    @if($bug->prioriteit == 3 && $bug->status != 'gesloten')
                         @if($bug->project_id == $pro->id)
                         {{-- */$hoog++;/* --}}
                         @endif
                    @endif
                    @if($bug->prioriteit == 4 && $bug->status != 'gesloten')
                         @if($bug->project_id == $pro->id)
                         {{-- */$krit++;/* --}}
                         @endif
                    @endif
               @endforeach
               @if($unread > 0)
               <div id='notificatie'>
                  <div>
                     {{$unread}}
                  </div>
               </div>
               @endif
               <div class="col-xs-12 text-right pull-right">
                  <span style="border: solid #ffffff 1px;" class="label label-purple pull-left">{{$krit}}</span>
                  {{--<small><strong>{{substr($pro->projectnaam,0,15)}}..</strong></small>--}}
                  <span class="badge pull-right">
                                       @foreach($bugs as $bug)
                                          @if($bug->status == 'open')
                                             @if($bug->project_id == $pro->id )
                                             {{-- */$i++/* --}}
                                             @endif
                                          @endif
                                       @endforeach
                                       {{$i}}
                                       </span> <span style="padding-right:5px;" >Openstaand</span>
                  <div>
                     <span style="border: solid #ffffff 1px;" class="label label-danger pull-left">{{$hoog}}</span>
                        <div><span class="badge pull-right">
                                             @foreach($bugs as $bug)
                                                @if($bug->status == 'bezig')
                                                   @if($bug->project_id == $pro->id)
                                                   {{-- */$x++/* --}}
                                                   @endif
                                                @endif
                                             @endforeach
                                             {{$x}}
                                             </span> <span style="padding-right:5px;">Bezig</span>
                                          </div>
                  </div>
                  <span style="border: solid #ffffff 1px;" class="label label-warning pull-left">{{$gem}}</span>
                    <div><span class="badge pull-right">
                     @foreach($bugs as $bug)
                        @if($bug->status == 'gesloten')
                           @if($bug->project_id == $pro->id)
                           {{-- */$y++/* --}}
                           @endif
                        @endif
                     @endforeach
                     {{$y}}
                     </span> <span style="padding-right:5px;">Gesloten</span>
                  </div>
                  <span style="border: solid #ffffff 1px;" class="label label-success pull-left">{{$laag}}</span>

               </div>
            </div>
         </a>
      </div>
      <a href="/bugs/{{$pro->id}}">
         <div class="panel-footer">
            <span class="pull-left" style="color:#aaaaaa;" >{{substr($pro->projectnaam,0,20)}}</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
         </div>
      </a>
   </div>
</div>
@endforeach
@endif
@endif