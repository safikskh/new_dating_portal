<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use App\Models\VideoChatRoom;
use App\Models\VideoRoomJoinUser;
use App\Models\VideoChat;
use App\User;
use Response;

class VideoRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getRoom($id)
    {
        $room = VideoChatRoom::where('id', $id)->first();
        // dd($room);
        $accountSid = config('constant.TWILIO_ACCOUNT_SID');
        $authToken = config('constant.TWILIO_AUTH_TOKEN');
        $apiKeySid = config('constant.TWILLIO_SID');
        $apiKeySecret = config('constant.TWILLIO_SECRET_KEY');
        if (empty($room)) {
            $roomName = '';
            $roomID = '';
            $param['room_id'] = '';
            $no_of_participants = '';
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
        return view('frontEnd.memberships.video2', [
            'accessToken' => $accessToken->toJWT(), 'roomID' => $roomID, 'roomName' => $roomName, 'participants' => $no_of_participants, 'identity' => \Auth::user()->email
        ]);
    }

    public function webCam(Request $request)
    {
        $accountSid = config('constant.TWILIO_ACCOUNT_SID');
        $authToken = config('constant.TWILIO_AUTH_TOKEN');
        $twilio = new Client($accountSid, $authToken);
        $rooms = $twilio->video->v1->rooms->read(["status" => "in-progress"]);
        $roomNames = [];
        foreach ($rooms as $record) {
            $roomNames[] = $record->uniqueName;
        }
        $roomlist = VideoChatRoom::whereIn("room_name", $roomNames)->with("creator")->get();
        dd($roomlist);
    }
    public function createRoom(Request $request)
    {
    //    dd($request->all());
        $param = \Input::all();
       
        $this->validate($request, [
            'room_name' => 'required',
            'participant' => 'required',
            'gender' => 'required',
        ]);

        $param['user_id'] = \Auth::id();
        $is_webcam_online = User::where('id', \Auth::id())->first();
        $is_webcam_online->is_webcam_online = 1;
        $is_webcam_online->save();
        $room = self::addRoom($param);

        $data['msg'] = 'Save successfully';
        $data['status'] = true;

        return $data;

        // return redirect("room/$room");

        // $accountSid = config('constant.TWILIO_ACCOUNT_SID');
        // $authToken = config('constant.TWILIO_AUTH_TOKEN');
        // $apiKeySid = config('constant.TWILLIO_SID');
        // $apiKeySecret = config('constant.TWILLIO_SECRET_KEY');
        // $roomName = $param['room_name'];

        // $accessToken = new AccessToken($accountSid, $apiKeySid, $apiKeySecret, 3600, 'admin');
        // $accessToken = new AccessToken(
        //     config('constant.TWILIO_ACCOUNT_SID'),
        //     config('constant.TWILIO_API_KEY'),
        //     config('constant.TWILIO_API_SECRET')
        // );
        // $client = new Client($accountSid, $authToken);
        // $room = $client->video->rooms->create([
        //     'uniqueName' => 'my-room-name'
        // ]);
        // dd($room);
        // Generate a Twilio access token
        // $accessToken = new AccessToken(
        //     $accountSid,
        //     // $apiKeySid,
        //     $authToken,
        //     $apiKeySecret,
        // );

        // $videoGrant = new VideoGrant();
        // $accessToken->addGrant($videoGrant);
        // $videoGrant->setRoom($roomName);
        // dd($room->id);

        // Return the view with the access token

    }

    // public function getRoom(){
    //     return view('frontEnd\memberships\video', [
    //         'accessToken' => $accessToken->toJWT(),'roomName'=>$roomName,'identity'=>'admin','participants'=>$param['participant']
    //     ]);
    // }

    public function getVideoRoom()
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
        $roomlist = User::where("is_webcam_online", 1)->where('set_age',auth()->user()->set_age)->where('set_gender',auth()->user()->set_gender)->where('id', '!=', \Auth::id())->get();
        return view('frontEnd.memberships.createVideo', compact("roomlist"));
    }

    public function genderFilter(Request $request)
    {
        $gender = $request->gender;
        if ($request->chat_type == 0) {
            $list = User::where("is_webcam_online", 1)->where('id', '!=', \Auth::id())->with('portalJoinUsers')->get();
            $roomlist = [];
            foreach ($list as $record) {
                if ($request->gender == $record->portalJoinUsers[0]->sex) {
                    $roomlist[] = $record;
                }
            }
            return view('frontEnd.memberships.createVideo', compact("roomlist", 'gender'));
        } else {
            $list = User::where("is_chat_online", 1)->where('id', '!=', \Auth::id())->with('portalJoinUsers')->get();
            $roomlist = [];
            foreach ($list as $record) {
                if ($request->gender == $record->portalJoinUsers[0]->sex) {
                    $roomlist[] = $record;
                }
            }
            return view('frontEnd.memberships.createChatRoom', compact("roomlist", 'gender'));
        }
    }

    // public function joinRoom($id,$name){


    //     // Return the view with the access token
    //     return view('frontEnd\memberships\joinVideo', [
    //         'accessToken' => $id,"roomName"=>$name
    //     ]);

    // }

    public function joinRoom($param)
    {

        $accountSid = config('constant.TWILIO_ACCOUNT_SID');
        $authToken = config('constant.TWILIO_AUTH_TOKEN');
        $apiKeySid = config('constant.TWILLIO_SID');
        $apiKeySecret = config('constant.TWILLIO_SECRET_KEY');
        $roomName = 'Room1';
        // Generate an access token with Video grant
        // $accessToken = new AccessToken(
        //     $accountSid,
        //     $apiKeySid,
        //     $apiKeySecret,
        // );
        $accessToken = new AccessToken($accountSid, $apiKeySid, $apiKeySecret, 3600, 'user');
        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName);
        $accessToken->addGrant($videoGrant);

        // Return the access token to the client
        // return response()->json([
        //     'access_token' => $accessToken->toJwt()
        // ]);
        return view('frontEnd.memberships.video', [
            'accessToken' => $accessToken->toJwt(), 'roomName' => $roomName, 'identity' => 'user'
        ]);
    }

    public function addChat()
    {
    }


    public function addRoom($param)
    {
        $room = VideoChatRoom::where("room_name", $param['room_name'])->first();
        if (!$room) {
            $room = new VideoChatRoom;
        }

        $room->room_name = $param['room_name'];
        $room->no_of_participants = $param['participant'];
        $room->gender = $param['gender'];
        $room->creator_id = $param['user_id'];
        $room->save();

        $param['room_id'] = $room->id;
        $joinUser = VideoRoomJoinUser::joinParticipant($param);
        return $room->id;
    }

    public function doChat()
    {
        $param = \Input::all();

        $chat = new VideoChat;
        $chat->user_id = \Auth::id();
        $chat->room_id = $param['room_id'];
        $chat->msg = $param['msg'];
        $chat->save();

        $pusher = new \Pusher\Pusher(config('constant.PUSHER_APP_KEY'), config('constant.PUSHER_APP_SECRET'), config('constant.PUSHER_APP_ID'), array('cluster' => config('constant.PUSHER_APP_CLUSTER')));
        $pusher->trigger('chat', 'new_chat', []);

        return array('flag' => 1, 'msg' => 'success');
    }

    public function allChat()
    {
        $param = \Input::all();

        $chat['data'] = VideoChat::with('user')->where('room_id', $param['room_id'])->get()->toArray();
        $res['flag'] = 1;
        // dd($chat);
        $res['blade'] = view("frontEnd.memberships.videoChat", $chat)->render();
        $res['msg'] = 'success';
        return $res;
    }

    public function webChangeStatus()
    {
        $is_webcam_online = User::where('id', \Auth::id())->first();
        $is_webcam_online->is_webcam_online = 0;
        $is_webcam_online->save();
        $res['msg'] = 'success';
        $res['flag'] = 1;
        return $res;
    }

    public function streamData(Request $request)
    {
        $user = User::where('id', \Auth::id())->first();
        $user->set_gender = $request->gender;
        $user->set_age = $request->age;
        $user->save();

        $room = VideoChatRoom::latest()->first();

        $route = "room/$room->id";
        return Response::json([
            "status" => true,
            "message" => "Save successfully",
            "route" => $route
        ]);

        // $data['msg'] = 'Save successfully';
        // $data['status'] = true;
        // $data['room_id'] = $room->id;

        // // return redirect("room/$room");

       
    }
}
