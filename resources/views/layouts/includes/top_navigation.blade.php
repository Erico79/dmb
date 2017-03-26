<div class="navbar-inner">
    <div class="container-fluid">
        <!-- BEGIN LOGO -->
        @include('layouts.includes.logo')
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="arrow"></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <div class="top-nav">
            <!-- BEGIN QUICK SEARCH FORM -->
            @include('layouts.includes.quick_search')
            <!-- END QUICK SEARCH FORM -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav pull-right" id="top_menu">
                @include('layouts.includes.top_drop_sections')
            </ul>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>
</div>