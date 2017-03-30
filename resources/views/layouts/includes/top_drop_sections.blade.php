{{--<!-- BEGIN NOTIFICATION DROPDOWN -->--}}
{{--<li class="dropdown" id="header_notification_bar">--}}
    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
        {{--<i class="icon-warning-sign"></i>--}}
        {{--<span class="label label-important">15</span>--}}
    {{--</a>--}}
    {{--<ul class="dropdown-menu extended notification">--}}
        {{--<li>--}}
            {{--<p>You have 14 new notifications</p>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">--}}
                {{--<span class="label label-success"><i class="icon-plus"></i></span>--}}
                {{--New user registered.--}}
                {{--<span class="small italic">Just now</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">--}}
                {{--<span class="label label-important"><i class="icon-bolt"></i></span>--}}
                {{--Server #12 overloaded.--}}
                {{--<span class="small italic">15 mins</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">--}}
                {{--<span class="label label-warning"><i class="icon-bell"></i></span>--}}
                {{--Server #2 not respoding.--}}
                {{--<span class="small italic">22 mins</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">--}}
                {{--<span class="label label-info"><i class="icon-bullhorn"></i></span>--}}
                {{--Application error.--}}
                {{--<span class="small italic">40 mins</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">--}}
                {{--<span class="label label-important"><i class="icon-bolt"></i></span>--}}
                {{--Database overloaded 68%.--}}
                {{--<span class="small italic">2 hrs</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">--}}
                {{--<span class="label label-important"><i class="icon-bolt"></i></span>--}}
                {{--2 user IP addresses blacklisted.--}}
                {{--<span class="small italic">5 hrs</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">See all notifications</a>--}}
        {{--</li>--}}
    {{--</ul>--}}
{{--</li>--}}
{{--<!-- END NOTIFICATION DROPDOWN -->--}}
{{--<!-- BEGIN INBOX DROPDOWN -->--}}
{{--<li class="dropdown" id="header_inbox_bar">--}}
    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
        {{--<i class="icon-envelope-alt"></i>--}}
        {{--<span class="label label-success">5</span>--}}
    {{--</a>--}}
    {{--<ul class="dropdown-menu extended inbox">--}}
        {{--<li>--}}
            {{--<p>You have 12 new messages</p>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">--}}
                {{--<span class="photo"><img src="./assets/img/avatar-mini.png" alt="avatar" /></span>--}}
                {{--<span class="subject">--}}
									{{--<span class="from">Lisa Wong</span>--}}
									{{--<span class="time">Just Now</span>--}}
									{{--</span>--}}
                {{--<span class="message">--}}
									{{--Vivamus sed auctor nibh congue nibh.--}}
									{{--</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">--}}
                {{--<span class="photo"><img src="./assets/img/avatar-mini.png" alt="avatar" /></span>--}}
                {{--<span class="subject">--}}
									{{--<span class="from">Alina Fionovna</span>--}}
									{{--<span class="time">16 mins</span>--}}
									{{--</span>--}}
                {{--<span class="message">--}}
									{{--Vivamus sed auctor nibh congue.--}}
									{{--</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">--}}
                {{--<span class="photo"><img src="./assets/img/avatar-mini.png" alt="avatar" /></span>--}}
                {{--<span class="subject">--}}
									{{--<span class="from">Mila Rock</span>--}}
									{{--<span class="time">2 hrs</span>--}}
									{{--</span>--}}
                {{--<span class="message">--}}
									{{--Vivamus sed auctor nibh congue.--}}
									{{--</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">See all messages</a>--}}
        {{--</li>--}}
    {{--</ul>--}}
{{--</li>--}}
{{--<!-- END INBOX DROPDOWN -->--}}
{{--<li class="divider-vertical hidden-phone hidden-tablet"></li>--}}
{{--<!-- BEGIN USER LOGIN DROPDOWN -->--}}

{{--<li class="dropdown">--}}
    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
        {{--<i class="icon-wrench"></i>--}}
        {{--<b class="caret"></b>--}}
    {{--</a>--}}
    {{--<ul class="dropdown-menu">--}}
        {{--<li><a href="#"><i class="icon-cogs"></i> System Settings</a></li>--}}
        {{--<li><a href="#"><i class="icon-pushpin"></i> Shortcuts</a></li>--}}
        {{--<li><a href="#"><i class="icon-trash"></i> Trash</a></li>--}}
    {{--</ul>--}}
{{--</li>--}}

{{--<li class="divider-vertical hidden-phone hidden-tablet"></li>--}}
<!-- BEGIN USER LOGIN DROPDOWN -->
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="icon-user"></i>
        <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
        <li><a href="{{ url('/settings') }}"><i class="icon-cogs"></i> Settings</a></li>
        <li><a href="{{ url('/profile-settings') }}"><i class="icon-user"></i> Profile</a></li>
        {{--<li><a href="#"><i class="icon-tasks"></i> Tasks</a></li>--}}
        {{--<li><a href="#"><i class="icon-ok"></i> Calendar</a></li>--}}
        <li class="divider"></li>
        <li><a href="{{ url('/logout') }}" id="logout"><i class="icon-key"></i> Log Out</a></li>
        <form id="logout-form" action="{{ url('logout') }}" method="post" style="display: none;">
            {{ csrf_field() }}
        </form>
    </ul>
</li>
<!-- END USER LOGIN DROPDOWN -->
@push('js')
    <script>
        $('a#logout').on('click', function(e){
            e.preventDefault();
            $('#logout-form').submit();
        });
    </script>
@endpush