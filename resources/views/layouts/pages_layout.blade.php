<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Madeals</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/themes/default.css') }}" rel="stylesheet" id="style_color" />
    <link href="{{ URL::asset('assets/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <link href="#" rel="stylesheet" id="style_metro" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ URL::asset('assets/css/pages/error.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    @stack('css')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
<!-- BEGIN HEADER -->
<div id="header" class="navbar navbar-inverse navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    @include('layouts.includes.top_navigation')
    <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div id="container" class="row-fluid">
    <!-- BEGIN SIDEBAR -->
    @include('layouts.includes.sidebar')
    <!-- END SIDEBAR -->
    <!-- BEGIN PAGE -->
    <div id="body">
        <!-- BEGIN SAMPLE widget CONFIGURATION MODAL FORM-->
        <div id="widget-config" class="modal hide">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"></button>
                <h3>Widget Settings</h3>
            </div>
            <div class="modal-body">
                <p>Here will be a configuration form</p>
            </div>
        </div>
        <!-- END SAMPLE widget CONFIGURATION MODAL FORM-->
        <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            @include('layouts.includes.page_header')
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                @yield('content')
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- BEGIN PAGE -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('layouts.includes.footer')
<!-- END FOOTER -->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ URL::asset('assets/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="{{ URL::asset('assets/plugins/excanvas.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/respond.js') }}"></script>
<![endif]-->
<script src="{{ URL::asset('assets/plugins/breakpoints/breakpoints.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! jquery.slimscroll.min.js depends on jquery-ui-1.10.1.custom.min.js -->
<script src="{{ URL::asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/jquery.blockui.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/data-tables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/data-tables/DT_bootstrap.js') }}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ URL::asset('assets/scripts/app.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
    });
</script>
<!-- END JAVASCRIPTS-->
@stack('js')
</body>
<!-- END BODY -->
</html>