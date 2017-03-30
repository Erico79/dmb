@extends('layouts.dt')
@section('title','Masterfile Profile')
@section('page-title','Masterfile Profile')
@section('page-title-small', 'My Profile')

@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <span href="#">Masterfile</span>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="{{ url('all_mfs') }}">All Mastefile</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span href="#">Mastefile Profile</span></li>
@endsection

@section('widget-title', '<span style="color: green;"> '.$mf->surname.' '.$mf->firstname.' '.$mf->middlename.' </span>')

@section('content')
    @include('layouts.includes._messages')
        <form enctype="multipart/form-data" class="form-horizontal" method="post" id= "" class="widget">
                <div class="row-fluid">
                    <div class="span12">
                        <!--BEGIN TABS-->
                        <div class="tabbable tabbable-custom">
                            <ul class="nav nav-tabs">
                                <?php
                                $tab1 = '';
                                $tab2 = '';
                                if(isset($_SESSION['status'])){
                                    $tab2 = 'active';
                                }else{
                                    $tab1 = 'active';
                                }
                                ?>
                                <li class="<?php echo $tab1 ?>"><a href="#tab_1_1" data-toggle="tab"><i class="icon-user"></i> Account Details</a></li>
                                <li class="<?php echo $tab2 ?>"><a href="#tab_1_2" data-toggle="tab"><i class="icon-map-marker"></i> Manage Addresses</a></li>
                                <?php
                                    if($mf['b_role'] == 'Client'){
                                ?>
                                <li class=""><a href="#tab_1_3" data-toggle="tab"><i class="icon-dashboard"></i> My Bids</a></li>
                                {{--<li class=""><a href="#tab_1_4" data-toggle="tab"><i class="icon-credit-card"></i> My Purchase</a></li>--}}
                                <li class=""><a href="#tab_1_5" data-toggle="tab"><i class="icon-trophy"></i> My Wins</a></li>
                                <li class=""><a href="#tab_1_7" data-toggle="tab"><i class="icon-folder-open"></i> Bid Tokens</a></li>
                                <?php
                                    }
                                if($mf['b_role'] == 'Supplier'){
                                ?>
                                <li class=""><a href="#tab_1_8" data-toggle="tab"><i class="icon-table"></i> All Items</a></li>
                                <?php } ?>
                            </ul>
                            {{-- tabs panes --}}
                            <div class="tab-content">
                                <div class="tab-pane profile-classic row-fluid active"  id="tab_1_1">
                                    @include('masterfile.profile_info')
                                </div>

                                <div class="tab-pane profile-classic row-fluid" id="tab_1_2">
                                    @include('masterfile.address_info')
                                </div>

                                <div class="tab-pane profile-classic row-fluid" id="tab_1_3">
                                    @include('masterfile.my_bids_info')
                                </div>

                                {{--<div class="tab-pane profile-classic row-fluid" id="tab_1_4">--}}
                                    {{--@include('masterfile.my_purchase_info')--}}
                                {{--</div>--}}

                                <div class="tab-pane profile-classic row-fluid" id="tab_1_5">
                                    @include('masterfile.my_wins')
                                </div>

                                <div class="tab-pane profile-classic row-fluid" id="tab_1_7">
                                    @include('masterfile.my_bid_wallet_info')
                                </div>

                                <div class="tab-pane profile-classic row-fluid" id="tab_1_8">
                                    @include('masterfile.supplier_items_info')
                                </div>
                            </div>

                        </div>
                        <!--END TABS-->
                    </div>
                </div>
            </form>
@endsection