@extends('layouts.dt')
@section('title','Manage Sub Categories')
@section('page-title','Manage sub categories')
@section('page-title-small', 'Item sub category')
@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">Inventory</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">Manage sub categories</a></li>
@endsection
@section('widget-title', 'Manage sub categories')
@section('actions')
    <a href="#add_subcategory" class="btn btn-primary btn-small" data-toggle="modal">Add a SubCategory</a>
@endsection
@section('content')
    @include('layouts.includes._messages')
    <table class="table table-bordered" id="table1" >
        <thead>
            <tr>
                <th>Id</th>
                <th>Sub Category name</th>
                <th>Belongs to</th>
                <th>Sub Category code</th>
                <th>Sub Category status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
        <tbody>
        @if(count($subcategories))
            @foreach($subcategories as $subcategory)
                <?php
                    $cat = App\Category::find($subcategory->category_id );
                ?>

                <tr>
                    <td>{{ $subcategory->id }}</td>
                    <td>{{ $subcategory->sub_category_name }}</td>
                    <td>{{ $cat->category_name }}</td>
                    <td>{{ $subcategory->sub_category_code }}</td>
                    <td>{{ ($subcategory->sub_category_status == 1) ? 'Active':'Inactive' }}</td>
                    <td><a href="#edit-subcategory" action="{{ url('update-subcategory/'.$subcategory->id ) }}" edit-id="{{ $subcategory->id }}" class="btn btn-success btn-small edit_subcat" data-toggle="modal">Edit</a> </td>
                    <td><a href="#delete-subcategory" data-toggle="modal" action="{{ url('delete-subcategory/'.$subcategory->id ) }}" delete-id="{{ $subcategory->id }}"class="btn btn-danger delete-sub-cat">Delete</a> </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection
@section('modals')
    {{--modal for add--}}

    <form action="{{ url('/add-subcategory') }}" method="post">
        {{ csrf_field() }}
        <div id="add_subcategory" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Add sub Category</h3>
            </div>
            <div class="modal-body">
                <label for="group_name">Sub Category name:</label>
                <div class="row-fluid">
                    <select class="span12 " name="category_id" select2>
                        <option value="">--Select a category--</option>
                    @if(count($categories))
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                            @endif

                    </select>
                </div>
                <div class="row-fluid">
                    <label for="group_name">Sub Category name:</label>
                    <input type="text" name="sub_category_name" value="" class="span12" required>
                </div>
                <div class="row-fluid">
                    <label for="group_name">Sub Category code:</label>
                    <input type="text" name="sub_category_code" class="span12" required>
                </div>
                <label for="group_name">Sub Category status:</label>
                <div class="row-fluid">
                    <select name="sub_category_status" class="span12" required>
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

    {{--modal for edit--}}
    <form id="edit-sub-cat-form" method="post">
        {{ csrf_field() }}
        <div id="edit-subcategory" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Edit sub category</h3>
            </div>
            <div class="modal-body">
                <label for="group_name">Category:</label>
                <div class="row-fluid">
                    <select class="span12 " id="sub-cat-id" name="category_id" select2>
                        <option value="">--Select a category--</option>
                        @if(count($categories))
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
                <div class="row-fluid">
                    <label for="group_name">Sub Category name:</label>
                    <input type="text" id="sub-cat-name" name="sub_category_name" value="" class="span12" required>
                </div>
                <div class="row-fluid">
                    <label for="group_name">Sub Category code:</label>
                    <input type="text" id="sub-cat-code" name="sub_category_code" class="span12" required>
                </div>
                <label for="group_name">Sub Category status:</label>
                <div class="row-fluid">
                    <select name="sub_category_status" id="sub-cat-status" class="span12" required>
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

    {{--modal for delete--}}
    <form id="delete-sub-cat-form" method="post">
        {{ csrf_field() }}
        <div id="delete-subcategory" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Delete Category</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the sub category?</p>
            </div>
            <div class="modal-footer">
                {{ method_field('DELETE') }}
                <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
                <input type="submit" class="btn btn-primary" value="Yes">
            </div>
        </div>
    </form>

@endsection
@push('js')
<script src="{{ URL::asset('src_js/inventory/sub-category.js') }}"></script>
@endpush

