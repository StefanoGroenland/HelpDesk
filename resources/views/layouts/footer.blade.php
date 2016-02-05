<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- jQuery -->
<script src="{{URL::asset('../assets/js/jquery.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{URL::asset('../assets/js/bootstrap.min.js')}}"></script>

<script src="{{URL::asset('../assets/js/jquery.fancybox.pack.js')}}"></script>
<script src="{{URL::asset('../assets/js/jquery.fancybox-buttons.js')}}"></script>
<script src="{{URL::asset('../assets/js/jquery.fancybox-media.js')}}"></script>
<script src="{{URL::asset('../assets/js/jquery.fancybox-thumbs.js')}}"></script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
{{--<script src="{{URL::asset('../assets/js/tinymce.js')}}"></script>--}}

<script>
var $j = jQuery.noConflict();

$j(document).ready(function(){


    $j('.fancybox').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        helpers : {
            media : {}
        }
    });

});
</script>


<script>tinymce.init({
   selector:'textarea',
    menubar: false
    });
</script>
<script>
   jQuery( document ).ready(function( $ ) {
      $('[data-toggle="tooltip"]').tooltip();
   
      $('input').on('click', function() {
          $(this).tooltip('hide');
      });
      $('select').on('click', function() {
          $(this).tooltip('hide');
      });
   });
</script>
{{--datatables--}}
<script src="{{URL::asset('../assets/js/datatables.js')}}"></script>
<script type="text/javascript">
   $(document).ready( function () {
       $('.data_table').DataTable({
       "sDom": "Rlfrtip",
       "order": [[ 0, "desc" ]],
           "oLanguage" : {
               "sInfo" : "Toon _START_ tot _END_ van _TOTAL_ records" ,
               "sInfoEmpty" : "Geen resultaten gevonden" ,
               "sInfoEmptyTable" : "Geen resultaten gevonden" ,
               "sInfoFiltered" : "(Gezocht in _MAX_ records)" ,
               "sZeroRecords" : "Geen resultaten gevonden",
               "sLengthMenu" : "Toon _MENU_ rijen",
               "sSearch" : "Zoek : ",

                   "oPaginate" : {
                       "sNext" : "Volgende",
                       "sPrevious" : "Vorige"
                   }
           }
       });
   } );

</script>


@yield('scripts')