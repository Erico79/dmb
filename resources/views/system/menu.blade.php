@extends('layouts.nestable')
@section('title', 'Manage Menu')
@section('page-title', 'Manage Menu')
@section('breadcrumbs')
    <li>
        <i class="icon-home"></i>
        <a href="index.php">Home</a>
        <span class="icon-right-angle"></span>
    </li>
    <li>
        System
        <span class="icon-right-angle"></span>
    </li>
    <li><a href="{{ url('menu') }}">Menu</a></li>
@endsection

@push('js')
    <script src="{{ URL::asset('src_js/system/menu.js') }}"></script>
@endpush

@section('content')
    <div class="row-fluid">
        <div class="span12">
            <div class="margin-bottom-10" id="nestable_list_menu">
                <button type="button" class="btn" data-action="expand-all">Expand All</button>
                <button type="button" class="btn" data-action="collapse-all">Collapse All</button>
            </div>
        </div>
    </div>
    {{--<div class="row-fluid">--}}
        {{--<div class="span12">--}}
            {{--<h3>Serialised Output (per list)</h3>--}}
            {{--<textarea id="nestable_list_1_output" class="m-wrap span12"></textarea>--}}
            <form action="{{ url('arrange-menu') }}" method="post" id="menu-form">
                {{ csrf_field() }}
                <input type="hidden" name="menu_params" id="nestable_list_2_output" class="m-wrap span12"/>
            </form>
        {{--</div>--}}
    {{--</div>--}}

    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-title">
                    <h4><i class="icon-list"></i> Side Menu</h4>
                    <span class="actions">
                        <button class="btn btn-primary btn-small" data-toggle="modal" data-target="#add-menu-item"><i class="icon-plus"></i> Add Item</button>
                        <button class="btn btn-success btn-small" id="save-menu"><i class="icon-save"></i> Save</button>
                        <button class="btn btn-danger btn-small" id="delete-menu"><i class="icon-trash"></i> Delete</button>
                    </span>
                </div>
                <div class="widget-body">
                    @include('common.success')
                    @include('common.warnings')
                    <div class="dd" id="nestable_list_3">
                        <?php
                            $menu = new \App\Http\Controllers\MenuController;
                            $menu->sideMenu($parent_id = NULL)
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Modals--}}
    <form action="{{ url('/add-menu') }}" method="post">
        {{ csrf_field() }}
        <div id="add-menu-item" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Add Menu Item</h3>
            </div>
            <div class="modal-body">
                <label for="route_name">Route:</label>
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <select name="route" id="routes" class="span12">
                        <option value="">--Chose Route--</option>
                        @if(count($routes))
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="url">Icon:</label>
                    <input type="text" name="icon" class="span12">
                </div>

                <label for="parent">Parent:</label>
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <select name="parent" id="parent_menu" class="span12">
                        <option value=""></option>
                        @if(count($menus))
                            @foreach($menus as $menu)
                                <?php
                                    $route_name = App\Route::find($menu->route_id)->route_name;
                                ?>
                                <option value="{{ $menu->id }}">{{ $route_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="menu_status">Status:</label>
                    <select name="menu_status" class="span12" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </form>

    {{--Edit Modal--}}
    <form action="{{ url('/edit-menu') }}" method="post">
        {{ csrf_field() }}
        <div id="edit-menu-item" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Update Menu Item</h3>
            </div>
            <div class="modal-body">
                <label for="route_name">Route:</label>
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <select name="route" id="ed_routes" class="span12">
                        <option value=""></option>
                        @if(count($routes))
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="url">Icon:</label>
                    <input type="text" name="icon" id="icon" class="span12">
                </div>

                <div class="row-fluid">
                    <label for="menu_status">Status:</label>
                    <select name="menu_status" id="menu_status" class="span12" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            {{--hidden fields--}}
            <input type="hidden" id="edit_id" name="edit_id"/>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </form>
@endsection