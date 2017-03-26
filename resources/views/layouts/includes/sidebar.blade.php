<div id="sidebar" class="nav-collapse collapse">
    <div class="sidebar-toggler hidden-phone"></div>
    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
    <div class="navbar-inverse">
        <form class="navbar-search visible-phone">
            <input type="text" class="search-query" placeholder="Search" />
        </form>
    </div>
    <!-- END RESPONSIVE QUICK SEARCH FORM -->
    <!-- BEGIN SIDEBAR MENU -->
    <?php
        $menu = new \App\Http\Controllers\MenuController;
        $menu->getSideMenu(NULL);
    ?>
    <!-- END SIDEBAR MENU -->
    @push('js')
        <script>
            $('li.active').parent().parent().addClass('active');
        </script>
    @endpush
</div>