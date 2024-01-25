<?php

namespace App\Http\Controllers\frontEnd;

use Carbon\Carbon;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use App\Models\ChatRoomJoinUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\ChatRoomDetails;

class ChatRoomJoinUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $request['user_id'] = Auth::id();
        $portalUser = PortalJoinUser::find(Auth::user()->portalJoinUser_id);
        if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1 && Carbon::now() < $portalUser->membership_ends_at)
        {if($chatRoomUser = ChatRoomJoinUser::create(
            $request->all()
        )){
            return redirect()->back()
            ->with('successs', 'congratulation now you want to access '. ChatRoomDetails::find($chatRoomUser->chatRoomDetail_id)->chatroom_name. ' click "Going Here"');

        }}else{
            return redirect()->route('plans.index')->with('error','Update membership to access!' );
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return "called";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
