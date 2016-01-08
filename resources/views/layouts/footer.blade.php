    <link href="{{URL::asset('../assets/css/bootstrap.css')}}" rel="stylesheet">
     <!-- Custom CSS -->
     <link href="{{URL::asset('../assets/css/sb-admin.css')}}" rel="stylesheet">
     <!-- Morris Charts CSS -->
     <link href="{{URL::asset('../assets/css/plugins/morris.css')}}" rel="stylesheet">
     <!-- Custom Fonts -->
     <link href="{{URL::asset('../assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">



     <link href="{{URL::asset('../assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">


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
    <!-- Morris Charts JavaScript -->
    <script src="{{URL::asset('../assets/js/plugins/morris/raphael.min.js')}}"></script>
    <script src="{{URL::asset('../assets/js/plugins/morris/morris.js')}}"></script>
    <script src="{{URL::asset('../assets/js/plugins/morris/morris-data.js')}}"></script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({
            selector:'textarea',
             menubar: false
             });</script>


    {{--datatables--}}
        <script src="{{URL::asset('../assets/js/datatables.js')}}"></script>
        <link href="{{URL::asset('../assets/css/datatables.min.css')}}" rel="stylesheet" type="text/css">

        <script type="text/javascript">
                            $(document).ready( function () {
                                $('.data_table').DataTable({
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