<?php

namespace App\Http\Controllers;

use App\User;
use App\UserChat;
use App\Models\Portal;
use App\Jobs\SendEmailJob;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Events\UserChatEvent;
use App\Models\PortalJoinUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Notifications\TemplateEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\RepliedToThread;

class ChatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $plans = Membership::where([['slug', 'chat']])->get();
        return view('frontEnd.memberships.chatPromotion.index', compact('plans'));
    }
    public function userChat(Request $request, UserChat $chat)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $request->validate([
            'user_id' => 'required',

        ]);

        $receiverInfo = PortalJoinUser::where('user_id', $request->user_id)->where('portal_id', auth()->user()->portalInfo->portal_id)->first();

        if (is_null($receiverInfo)) {
            return abort(404);
        }

        $negative_matchwords = [];

        // Detect match word.
        $nMatchWords = json_decode($receiverInfo->nMatchWords);

        if ($nMatchWords[0] != '') {
            foreach ($nMatchWords as $word) {
                if (! is_null($word)) {
                    if (strpos(strtolower($request->message), strtolower($word)) !== false) {
                        array_push($negative_matchwords, $word);
                    }
                }
            }
        }

        if ($request->send == 'free') {
            if(auth()->user()->isPaid() || $request->ajax()){
                return $this->sentMessage($request, $negative_matchwords, $request->send, $request->ajax());
            }else {
                return redirect()->back();
            }
        }elseif ($request->send == 'paid') {
            $imagePath = '';
            if($file =$request->file('file')){
                    $name = uniqid().$file->getClientOriginalName();          
                    $file->move('uploads/singleChat', $name );
                    $imagePath = "/uploads/singleChat/". $name;        
            }
            session()->put('paidMessage',[
                'user_id' => $request->user_id,
                'message' => $request->message,
                'imagePath' => $imagePath,
                'type' => $request->send,
            ]);
            $plans = Membership::where([['slug', 'chat']])->get();
            return view('frontEnd.memberships.chatPromotion.index', compact('plans'));
        }
    }

    public function sentMessage($request, $negative_matchwords, $type, $isAjax){
        $chat = new UserChat();
        $withPath = "";
        if($type == "free"){
            $name = "";
            if($file =$request->file('file')){
                $name = uniqid().$file->getClientOriginalName();          
                $chat->file = $file->move('uploads/singleChat', $name );
                $withPath = "/uploads/singleChat/". $name;            
            }       
        }else {
            $chat->file = $request['imagePath'];
            $withPath = $request['imagePath'];
        }    
        $chat->sender_id = Auth::id();
        $chat->user_id = $request['user_id'];
        $chat->detail = $request['message'];
        if($type == "paid"){
            $chat->isPromoted = true;   
        } 
        $chat->portal_id = auth()->user()->portalInfo->portal_id;   
            $chat->save();
            if(UserChat::where([['user_id', auth()->id()],['sender_id', $request['user_id']],['isPromoted', 1]])->count() > 0){
               $starMessages = UserChat::where([['user_id', auth()->id()],['sender_id', $request['user_id']],['isPromoted', 1]])->orderBy('id', 'desc')->get();
               foreach($starMessages as $item){
                   $item->isPromoted = 0;
                   $item->save();
               }
            }
            $chat->file = $withPath;
            broadcast(new UserChatEvent($request['user_id'], [
                'message' => $request['message'],
                'file' => $withPath,
                'user'    => Auth::id(),
                'portal_id'  => auth()->user()->portalInfo->portal_id
            ]))->toOthers();

            $notifyUser = User::find($request['user_id']);
            $notifyThread = UserChat::find($chat->id);
            $notifyThread->notificationType = auth()->user()->isFavBroadcastUser($request['user_id']);
            $notifyThread->isDisablePushNotif = $notifyUser->portalInfo->isDisablePushNotif;
            $notifyUser->notify(new RepliedToThread($notifyThread));

            // if(!$notifyUser->portalInfo->isDisableEmailNotif && $notifyUser->status == "offline" &&
            // $notifyUser->portalInfo->portal_id == auth()->user()->portalInfo->portal_id){                
            //     $notifyUser->notify(new TemplateEmail($notifyThread));
            // }

            if (count($negative_matchwords) > 0) {
                $chat['negative_matchwords'] = $negative_matchwords;
            }

            if($isAjax) return response()->json($chat);
           return redirect('home');
    }

    public function chatplan(Membership $plan, Request $request){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        return view('frontEnd.memberships.chatPromotion.show', compact('plan'));
    }
    public function chatplancreate(Request $request, Membership $plan){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $plan = Membership::findOrFail($request->get('plan')); 
        if($request->user()
            ->newSubscription(auth()->user()->portalInfo->portal_id, $plan->stripe_plan)
            ->create($request->stripeToken)){
                if (auth()->user()->subscription((string)auth()->user()->portalInfo->portal_id)->cancel()) {                
                    return $this->sentMessage(session()->get('paidMessage'), session()->get('paidMessage')['type'], false);              
                }
            }
    }

    public function chat()
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $portalList = new Collection();
        $portalUsers = PortalJoinUser::where('user_id', Auth::user()->id)->get();
        foreach ($portalUsers as $value) {
            $portal = Portal::find($value['portal_id']);
             $portalList->push($portal);
        }
        return view('frontEnd.chat',compact('portalList'));
    }
    public function favchat()
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $portalList = new Collection();
        $portalUsers = PortalJoinUser::where('user_id', Auth::user()->id)->get();
        foreach ($portalUsers as $value) {
            $portal = Portal::find($value['portal_id']);
             $portalList->push($portal);
        }
        return view('frontEnd.favchat',compact('portalList'));
    }
    public function latestMessage()
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
            $latestChat = UserChat::where([['user_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])
                ->whereNotIn('sender_id', auth()->user()->deactivateUserList())
                ->whereNotIn('sender_id', auth()->user()->getBlockUserListByAuth())
                ->orderBy('id','desc')
                ->first();
                if($latestChat){
                $latestChat->isfav = User::find($latestChat->sender_id)->isFavorite();
                $latestChat->username = User::find($latestChat->sender_id)->portalInfo->userName;
                $latestChat->sex = User::find($latestChat->sender_id)->portalInfo->sex;
                $latestChat->region = User::find($latestChat->sender_id)->portalInfo->regionName;
                $latestChat->profilePicture = User::find($latestChat->sender_id)->portalInfo->profilePicture;
                $latestChat->age = User::find($latestChat->sender_id)->portalInfo->humanTime;
                $latestChat->userNameColor = User::find($latestChat->sender_id)->portalInfo->userNameColor;

            return $latestChat;
                }
    }

    public function getLastMessage(Request $request, $id){
        
        $chat = UserChat::where([['user_id', auth()->id()],['sender_id',$id],['portal_id', auth()->user()->portalInfo->portal_id]])
        ->orderBy('id','DESC')
        ->first();
        if($chat){
        $lastMessage = '';
        foreach(User::find(auth()->id())->notifications->sortKeysDesc() as $notification){

            $notificationType = $notification->data['thread']['notificationType'];
            if($notificationType == 1 || $notificationType == 2){
                $portalId = $notification->data['thread']['portal_id'];
                $senderId = $notification->data['thread']['sender_id'];

                if($senderId == $id && $portalId == auth()->user()->portalInfo->portal_id)
                    $lastMessage = $notification;
            }
        }
        if($request->ajax()) return response()->json($lastMessage);
        return $lastMessage;
        }else {
            return 'not found';
        }
    }

    public function readMessages(Request $request,$id){

        foreach(auth()->user()->unreadNotifications as $unreadNotification){
            
            $notificationType = $unreadNotification->data['thread']['notificationType'];
            
            if($notificationType == 1 || $notificationType == 2){
                $senderId = $unreadNotification->data['thread']['sender_id'];
                $portalId = $unreadNotification->data['thread']['portal_id'];
                $promotionStatus = (int)$unreadNotification->data['thread']['isPromoted'];
                if($senderId == $id && $portalId == auth()->user()->portalInfo->portal_id){
                    $unreadNotification->markAsRead();
                    if ($promotionStatus) {
                        $this->removeStar($id);
                    }
                }
            }
        }

        if($request->ajax()) return response()->json('success',200);
    }

    public function readMessageshome($type,$id){

       

        foreach(auth()->user()->unreadNotifications as $unreadNotification){
            
            $notificationType = $unreadNotification->data['thread']['notificationType'];
            
            if($notificationType == 1 || $notificationType == 2){
                $senderId = $unreadNotification->data['thread']['sender_id'];
                $portalId = $unreadNotification->data['thread']['portal_id'];
                $promotionStatus = (int)$unreadNotification->data['thread']['isPromoted'];
                if($senderId == $id && $portalId == auth()->user()->portalInfo->portal_id){
                    $unreadNotification->markAsRead();
                    if ($promotionStatus) {
                        $this->removeStar($id);
                    }
                }
            }
        }
        
         if($type == "favmsg"){
        return redirect("favchat?id=$id");
        }else{
            return redirect("chat?id=$id");
        }

        
        
    }

    public function removeStar($id){
        if(UserChat::where([['user_id', auth()->id()],['sender_id', $id],['isPromoted', 1]])->count() > 0){
            $starMessages = UserChat::where([['user_id', auth()->id()],['sender_id', $id],['isPromoted', 1]])->get();
            foreach($starMessages as $item){
                $item->isPromoted = 0;
                $item->save();
            }
        }
    }

    public function getMessageInfo($id){
        return (int)UserChat::find($id)->isPromoted;
    }

    public function getMessages($user)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $auth = Auth::user()->id;
        $messages = new Collection();
        $messageList = UserChat::where([['sender_id', Auth::user()->id],['user_id', $user],['portal_id',auth()->user()->portalInfo->portal_id]])
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
        ->orWhere([['sender_id',  $user],['user_id',  Auth::user()->id],['portal_id',auth()->user()->portalInfo->portal_id]])
        ->whereNotIn('sender_id', auth()->user()->getBlockUserListByAuth())
        ->get();
        return response()->json($messageList);
    }

     public function userList(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
       
        $chatList = userChat::where([['user_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])
            ->whereNotIn('sender_id', auth()->user()->deactivateUserList())
            ->whereNotIn('sender_id', auth()->user()->getBlockUserListByAuth())
            ->orWhere([['sender_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->orderBy('created_at', 'DESC')->get();
        
        $chatUsers = [];
       
        foreach ($chatList as $key => $value) {
            if($value->sender_id == auth()->id()){
                $chatUsers[$key] = $value->user_id;

            }else {
                $chatUsers[$key] = $value->sender_id;

            }
        }
        $chatUsers = array_unique($chatUsers);
        $newUserList = new Collection();
        $favUsers = new Collection();
        $users = new Collection();
        $promotedUsers = new Collection();
        $favPromotedUsers = new Collection();
                foreach ($chatUsers as $item) {
                    $user = User::find($item);
                    if($user){
                         if(UserChat::where([['sender_id', auth()->id()],['user_id', $user->id],['isPromoted', true],['portal_id',auth()->user()->portalInfo->portal_id]])
                        ->orWhere([['sender_id',  $user->id],['user_id',  auth()->id()],['isPromoted', true],['portal_id',auth()->user()->portalInfo->portal_id]])->count() > 0){
                            if ($user->isFavorite()) {

                                // $user->isPromoted = 1;
                                $favPromotedUsers->push($user);
                            }else {
                                // $user->isPromoted = 1;
                                $promotedUsers->push($user);
                            }
                           
                        }elseif(UserChat::where([['sender_id', Auth::user()->id],['user_id', $user->id],['isPromoted', false],['portal_id',auth()->user()->portalInfo->portal_id]])
                        ->orWhere([['sender_id',  $user->id],['user_id',  Auth::user()->id],['isPromoted', false],['portal_id',auth()->user()->portalInfo->portal_id]])->count() > 0){
                            if ($user->isFavorite()) {
                                // $user->isPromoted = 0;
                                $favUsers->push($user);
                            }else {
                                // $user->isPromoted = 0;
                                $users->push($user);
                            }
                        }
                        
                    }
                }
        if ($request->isFav) {
            $newUserList->push($favPromotedUsers);
            $newUserList->push($favUsers);       
        }else {
            $newUserList->push($promotedUsers);
            $newUserList->push($users);       
        }
        return response()->json($newUserList->collapse());
    }

    public function getAuth()
    {
        return response()->json(
            User::find(Auth::user()->id)
        );
    }

    public function deleteAllByUser(Request $request){
        // return $request->id;
       return UserChat::where([['user_id', auth()->id()],['sender_id', $request->id],['portal_id', auth()->user()->portalInfo->portal_id]])
        ->orWhere([['user_id', $request->id],['sender_id',auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])
        ->delete();

    }
    public function deleteById(Request $request){
        // return $request->id;
       if(UserChat::find($request->message_id)->delete())
            return 1;

    }
}
