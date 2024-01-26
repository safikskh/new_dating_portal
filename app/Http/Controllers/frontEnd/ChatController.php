<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VideoChatRoom;
use App\Models\VideoRoomJoinUser;
use App\User;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getWebRoom($id)
    {
        $room = VideoChatRoom::where('id', $id)->first();

        $accountSid = config('constant.TWILIO_ACCOUNT_SID');
        $authToken = config('constant.TWILIO_AUTH_TOKEN');
        $apiKeySid = config('constant.TWILLIO_SID');
        $apiKeySecret = config('constant.TWILLIO_SECRET_KEY');
        if(empty($room)) {
            $roomName = '';
            $roomID = '';
            $param['room_id'] = '';
            $no_of_participants ='';
        } else {
            $roomName = $room->room_name;
            $roomID = $room->id;
            $param['room_id'] = $room->id;
            $no_of_participants = $room->no_of_participants;
        }
        $param['user_id'] = \Auth::id();
        // dd($accountSid, $apiKeySid, $apiKeySecret, 3600, 'admin');
        // $this->joinRoom($param);
        $accessToken = new AccessToken($accountSid, $apiKeySid, $apiKeySecret, 3600, \Auth::user()->email);

        $videoGrant = new VideoGrant();
        $accessToken->addGrant($videoGrant);
        $videoGrant->setRoom($roomName);
        // Return the view with the access token
        return view('frontEnd.memberships.webcam', [
            'accessToken' => $accessToken->toJWT(), 'roomID' => $roomID, 'roomName' => $roomName, 'participants' => $no_of_participants, 'identity' => \Auth::user()->email
        ]);
    }

    public function createChatRoom()
    {
        // $accountSid = config('constant.TWILIO_ACCOUNT_SID');
        // $authToken = config('constant.TWILIO_AUTH_TOKEN');
        // $twilio = new Client($accountSid, $authToken);
        // $rooms = $twilio->video->v1->rooms->read(["status" => "in-progress"]);
        // $roomNames = [];
        // foreach ($rooms as $record) {
        //     if (auth()->user()->email != $record->uniqueName) {
        //         $roomNames[] = $record->uniqueName;
        //     }
        // }
        // dd($roomNames);
        $roomlist = User::where("is_chat_online", 1)->where('id', '!=', \Auth::id())->get();
        return view('frontEnd.memberships.createChatRoom', compact("roomlist"));
    }

    public function createChat(Request $request)
    {
        $param = \Input::all();
        $this->validate($request, [
            'room_name' => 'required',
            'participant' => 'required',
            'gender' => 'required',
        ]);

        $param['user_id'] = \Auth::id();
        $is_chat_online = User::where('id',\Auth::id())->first();
        $is_chat_online->is_chat_online = 1;
        $is_chat_online->save();
        $room = self::addWebRoom($param);

        return redirect("chatroom/$room");
        // Return the view with the access token
    }

    public function addWebRoom($param)
    {
        $room = VideoChatRoom::where("room_name", $param['room_name'])->first();
        if (!$room) {
            $room = new VideoChatRoom;
        }

        $room->room_name = $param['room_name'];
        $room->no_of_participants = $param['participant'];
        $room->gender = $param['gender'];
        $room->creator_id = $param['user_id'];
        $room->type = 1;
        $room->save();

        $param['room_id'] = $room->id;
        $joinUser = VideoRoomJoinUser::joinParticipant($param);
        return $room->id;
    }

    public function chatChangeStatus()
    {
        $is_chat_online = User::where('id',\Auth::id())->first();
        $is_chat_online->is_chat_online = 0;
        $is_chat_online->save();
        $res['msg'] = 'success';
        $res['flag'] = 1;
        return $res;
    }
    
}
