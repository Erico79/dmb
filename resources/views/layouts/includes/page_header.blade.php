<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN STYLE CUSTOMIZER-->
        <div id="styler" class="hidden-phone">
            <i class="icon-cog"></i>
            <span class="settings">
                 <span class="text">Style:</span>
                 <span class="colors">
                 <span class="color-default" data-style="default">
                 </span>
                 <span class="color-grey" data-style="grey">
                 </span>
                 <span class="color-navygrey" data-style="navygrey">
                 </span>
                 <span class="color-red" data-style="red">
                 </span>
                 </span>
                 <span class="layout">
                 <label class="hidden-phone">
                 <input type="checkbox" class="header" checked value="" />Sticky Header
                 </label><br />
                 <label><input type="checkbox" class="metro" value="" />Metro Style</label>
                 </span>
             </span>
        </div>
        <!-- END STYLE CUSTOMIZER-->
        <h3 class="page-title">
            @yield('page-title')
            <small>@yield('page-subtitle')</small>
        </h3>
        <ul class="breadcrumb">
            {{--<li>--}}
                {{--<i class="icon-home"></i>--}}
                {{--<a href="index.html">Home</a>--}}
                {{--<span class="icon-angle-right"></span>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">Form Stuff</a>--}}
                {{--<span class="icon-angle-right"></span>--}}
            {{--</li>--}}
            {{--<li><a href="#">Form Wizard</a></li>--}}
            @yield('breadcrumb')
        </ul>
    </div>
</div>