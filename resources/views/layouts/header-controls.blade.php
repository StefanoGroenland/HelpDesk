@if(Auth::user()->bedrijf == 'moodles')
<small class="pull-right">
  <a href="../newproject" class="">
      <button type="submit" class="btn btn-success btn-xs">
         <i class="glyphicon glyphicon-plus"></i>
         Project
      </button>
  </a>
  <a href="../newmedewerker" class="">
      <button type="submit" class="btn btn-warning btn-xs">
         <i class="glyphicon glyphicon-plus"></i>
         Medewerker
      </button>
  </a>
  <a href="../newklant" class="">
      <button type="submit" class="btn btn-info btn-xs">
         <i class="glyphicon glyphicon-plus"></i>
         Klant
      </button>
  </a>
</small>
@else

@endif