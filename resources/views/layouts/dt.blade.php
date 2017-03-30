<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.css')  }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/style.css')  }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/style-responsive.css')  }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/themes/default.css')  }}" rel="stylesheet" id="style_color" />
    <link href="{{ URL::asset('assets/plugins/uniform/css/uniform.default.css')  }}" rel="stylesheet" type="text/css" />
    {{--<link href="#" rel="stylesheet" id="style_metro" />--}}
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ URL::asset('assets/css/pages/profile.css')  }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('src/datatables/media/css/demo_table.css')  }}" rel="stylesheet" />
    <link href="{{ URL::asset('src/datatables/extras/TableTools/media/css/TableTools.css')  }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/chosen-bootstrap/chosen/chosen.css')  }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')  }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/select2/select2.css')  }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/bootstrap-datepicker/css/datepicker.css')  }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/jquery-tags-input/jquery.tagsinput.css')  }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')  }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/jquery-nestable/jquery.nestable.css') }}" />
    {{--<link href="{{ URL::asset('src/datatables/media/css/jquery.dataTables.css')  }}" rel="stylesheet"/>--}}
    {{--<link href="{{ URL::asset('src/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet"/>--}}
{{--    <link href="{{ URL::asset('src/datatables/media/css/jquery.dataTables_themeroller.css')  }}" rel="stylesheet"/>--}}
    @stack('css')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="129x129" href="favicon-2.png">
    {{--<link rel="shortcut icon" href="favicon-2.png" />--}}
</head>
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
    <div id="body" data-height="800" style="">
        <div class="container-fluid">
            <!-- BEGIN PAGE TITLE -->
            <h3 class="page-title"> @yield('page-title') <small>@yield('page-title-small')</small> </h3>
            <!-- END PAGE TITLE -->

            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">
                @yield('breadcrumbs')
            </ul>
            <!-- END BREADCRUMBS -->
            @yield('filter')
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i>
                                @yield('widget-title')
                            </h4>
                                <span class="actions"> @yield('actions')</span>

                        </div>
                        <div class="widget-body form">
                            @yield('content')
                            <div class="clearfix"></div>
                            @yield('modals')
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('layouts.includes.footer')
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ URL::asset('assets/plugins/jquery-1.8.3.min.js') }}"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!--[if lt IE 9]>
<script src="{{ URL::asset('assets/plugins/excanvas.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/respond.js') }}"></script>
<![endif]-->
<script src="{{ URL::asset('assets/plugins/breakpoints/breakpoints.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.blockui.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.cookie.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/uniform/jquery.uniform.min.js') }}" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ URL::asset('assets/scripts/app.js') }}"></script>
<script> jQuery(document).ready(function() { App.init(); }); </script>
<script src="{{ URL::asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js') }}"></script>
<script src="{{ URL::asset('src/datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('src/datatables/extras/TableTools/media/js/TableTools.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script src="{{ URL::asset('src/js/parking_sessions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/date.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/select2/select2.min.js') }}"></script>

<script src="{{ URL::asset('assets/scripts/form-components.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/dropzone/dropzone.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-nestable/jquery.nestable.js') }}"></script>
<script src="{{ URL::asset('assets/scripts/ui-nestable.js') }}"></script>
<script>
    $(document).ready(function(){
        $('ul ul').addClass('sub');
        $('ul.sub .paro').hide();
        $('li.active').parent().css('display','block').addClass('live-active');
        $('.live-active').parent().addClass('active');
        $('ul.sub:empty').hide();
        FormComponents.init();
        UINestable.init();
    });
</script>

{{--initialize datatable--}}
<script>
    $(document).ready(function(){
        $('#table1 .live_table').dataTable();

    });
</script>

{{--initialise nestable--}}
<script>
    $(document).ready(function(){
        UINestable.init();
    });
</script>

@stack('js')
<!-- END PAGE LEVEL PLUGINS -->
</body>
</html>

