<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moodles - Helpdesk</title>

    <link rel="shortcut icon" type="image/ico" href="./favicon.ico" />
</head>

    @extends('layouts.top-links')

        <div id="page-wrapper">

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Overzicht</small>
                            @include('layouts.header-controls')
                        </h1>
                        {{--Breadcrumbs spot!--}}
                         <ol class="breadcrumb">
                         @if(\Auth::user()->bedrijf == 'moodles')
                         @include('layouts.adminbreadcrumbs')
                         @else
                         @include('layouts.breadcrumbs')
                         @endif
                         </ol>
                    </div>
                </div>
                <div class="row">

                <div class="col-lg-12">
                <h4 class="page-header">
                Mijn projecten
                </h4>
                </div>
                       @include('layouts.projectendashboard')
                </div>

                <div class="row">
                        @extends('layouts.feedbacktable')
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<!--</div>-->

    <!-- /#wrapper -->

    @extends('layouts.footer')

</body>

</html>
