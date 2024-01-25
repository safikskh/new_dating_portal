<?php

namespace App\Http\Controllers\frontEnd;

use App\User;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use App\Events\ChatRoomEvent;
use Illuminate\Support\Carbon;
use App\Models\ChatRoomJoinUser;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Sabberworm\CSS\CSSList\Document;
use App\Models\Backend\ChatRoomDetails;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class ChatRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $chatrooms = ChatRoomDetails::where('portal_id', Auth::user()
        ->getportal(Auth::user()->portalJoinUser_id))->get();
        return view('frontEnd.chatRooms',compact('chatrooms'));
    }


    public function chat($id)
    {
        if(auth()->user()->isDeactivate() || auth()->user()->isProfileDisable()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $chatRoomList = ChatRoomDetails::where('portal_id', auth()->user()->portalInfo->portal_id)->get();

        // $chatRoomList = ChatRoomDetails::all();



        //Check User Portal and Room Portal
        if(Auth::user()->isChatRoomUserCurrently($id)){

            if (! auth()->user()->isPaid()) {
                Toastr::error('This feature is only for paid user', 'Error');
                return redirect('/chat-rooms')->with('error', 'This feature is only for paid user');

            }else{
                $chatRoom = ChatRoomDetails::find($id);
                return view('frontEnd.chatRoom',compact('chatRoomList','chatRoom'));
            }

        }else{
            Toastr::error('Sorry ! You are not allowed this chat room', 'Error');
            return redirect('/chat-rooms');
        }
    }

    public function fetchAllMessages($id)
    {
    	return ChatRoom::with('user')->where('chatRoomDetail_id',$id)->get();
    }

    public function sendMessage(Request $request)
    {
        $chr = ChatRoomDetails::find($request->room_id);

    	$chat = auth()->user()->roomchats()->create([
            'message' => $request->message,
            'chatRoomDetail_id' => $request->room_id
        ]);

    	broadcast(new ChatRoomEvent($chat->load('user'),$chr))->toOthers();

    	return ['status' => 'success'];
    }

    public function test()
    {
        $chr = ChatRoomDetails::find(15);

        // $chr = ChatRoomDetail::with('portal')->find($request->room_id);

    	$chat = auth()->user()->roomchats()->create([
            'message' => '555555',
            'chatRoomDetail_id' => '15'
        ]);

    	broadcast(new ChatRoomEvent($chat->load('user'),$chr));

    	return ['status' => 'success'];
    }



}
