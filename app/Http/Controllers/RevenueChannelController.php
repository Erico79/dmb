<?php

namespace App\Http\Controllers;

use App\IfmisHeadcode;
use App\IfmisSubcode;
use App\RevenueChannel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class RevenueChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function revenueChannels(){
        $rcs = RevenueChannel::all();
        $ifmis_headcodes = IfmisHeadcode::all();

        return view('revenue_manager.manage_rc', array(
            'rcs' => $rcs,
            'ifmis_headcodes' => $ifmis_headcodes
        ));
    }

    /**
     * @param Request $request
     * Add Revenue Channel
     */
    public function store(Request $request){
        $this->validate($request, array(
            'revenue_channel_name' => 'required|unique:revenue_channels',
            'revenue_channel_code' => 'required|unique:revenue_channels'
        ));

        $headcode_id = NULL;
        if(!empty($request->ifmis_subcode)){
            $ifmis = IfmisSubcode::find($request->ifmis_subcode);
            $headcode_id = $ifmis->ifmis_headcode_id;
        }

        $rev = RevenueChannel::create(array(
            'revenue_channel_name' => Input::get('revenue_channel_name'),
            'revenue_channel_code' => Input::get('revenue_channel_code'),
            'ifmis_headcode_id' => $headcode_id,
            'ifmis_subcode_id' => !empty(Input::get('ifmis_subcode')) ? Input::get('ifmis_subcode') : NULL
        ));
        $rev->save();

        $request->session()->flash('status', 'The revenue channel has been added!');
        return redirect('revenue-channels');
    }

    /**
     * @param Request $request
     * @return mixed
     * Get Revenue Channel Details
     */
    public function getRevData(Request $request){
        $id = $request->id;
        $rev = RevenueChannel::find($id);
        return Response::json($rev);
    }

    public function update(Request $request){
        // validation
        $this->validate($request, array(
            'revenue_channel_name' => 'required|unique:revenue_channels,revenue_channel_name,'.$request->edit_id,
            'revenue_channel_code' => 'required|unique:revenue_channels,revenue_channel_code,'.$request->edit_id,
            'status' => 'required'
        ));

        $headcode_id = NULL;
        if(!empty($request->ifmis_subcode)){
            $ifmis = IfmisSubcode::find($request->ifmis_subcode);
            $headcode_id = $ifmis->ifmis_headcode_id;
        }

        RevenueChannel::where('id', $request->edit_id)
            ->update(array(
                'revenue_channel_name' => $request->revenue_channel_name,
                'revenue_channel_code' => $request->revenue_channel_code,
                'revenue_channel_status' => $request->status,
                'ifmis_subcode_id' => $request->ifmis_subcode,
                'ifmis_headcode_id' => $headcode_id
            ));

        $request->session()->flash('status', 'Revenue Channel has been updated');
        return redirect('revenue-channels');
    }

    public function destroy(Request $request){
        if(RevenueChannel::destroy($request->delete_id)){
            $request->session()->flash('status', 'Revenue Channel has been removed');
        }
        return redirect('revenue-channels');
    }
}
