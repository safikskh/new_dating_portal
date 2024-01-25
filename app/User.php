<?php

namespace App;

use App\Models\AdvanceSearch;
use App\UserChat;
use Carbon\Carbon;
use File;
use App\Models\Block;
use App\Models\Blogs;
use App\Models\Events;
use App\Models\Groups;
use App\Models\Portal;
use App\Models\Rating;
use App\Models\Region;
use App\Models\Status;
use App\Models\ChatRoom;
use App\Models\EventPost;
use App\Models\Favourite;
use App\Models\CoupleInfo;
use App\Models\Membership;
use App\Models\UserReport;
use App\Models\Subscription;
use App\Models\EventJoinUser;
use Laravel\Cashier\Billable;
use App\Models\PortalJoinUser;
use App\Models\UserPromotation;
use App\Models\ChatRoomJoinUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\ChatRoomDetails;
use App\Models\VideoRoom;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','portalJoinUser_id','status',
    ];

    protected $appends = ['userName','portalInfo','promotionInfo','profilePicture','chatSidebarColor'];

    /**
     * Relationship with `advance_searches` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function advanceSearch()
    {
        return $this->hasOne(AdvanceSearch::class)->where('portal_id', auth()->user()->portalInfo->portal_id);
    }

    public function roomchats(){

        return $this->hasMany(ChatRoom::class);
        
    }

    public function videoChats(){

        return $this->hasMany(VideoRoom::class,'creator_id');
        
    }

    public function isRegularChatEmpty(){
        $chatList = UserChat::where([['user_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])
            ->whereNotIn('sender_id', auth()->user()->getFavUserListByAuth())
            ->whereNotIn('sender_id', auth()->user()->deactivateUserList())
            ->whereNotIn('sender_id', auth()->user()->getBlockUserListByAuth())
            ->orWhere([['sender_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])
            ->whereNotIn('user_id', auth()->user()->getFavUserListByAuth())
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->count();
            if ($chatList == 0) {
                return 1;
            } else {
               return 0;
            }

    }
    public function isFavChatEmpty(){
        $chatList = UserChat::where([['user_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])
            ->whereIn('sender_id', auth()->user()->getFavUserListByAuth())
            ->whereNotIn('sender_id', auth()->user()->deactivateUserList())
            ->whereNotIn('sender_id', auth()->user()->getBlockUserListByAuth())
            ->orWhere([['sender_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])
            ->whereIn('user_id', auth()->user()->getFavUserListByAuth())
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->count();
            if ($chatList == 0) {
                return 1;
            } else {
               return 0;
            }
    }
    public function getFavUserListByAuth(){
        $favList = Favourite::where([['favourite_by', auth()->id()],['portal_id',auth()->user()->portalInfo->portal_id],['favourite_status', 0]])
        ->whereNotIn('favourite_to', auth()->user()->deactivateUserList())
        ->whereNotIn('favourite_to', auth()->user()->getBlockUserListByAuth())
        ->get();
        $favIds = [];
        foreach ($favList as $key => $value) {
            $favIds[$key] = $value->favourite_to;
        }
        return array_unique($favIds);
    }
    public function getOnlineUserListByAuth(){
        $userList = User::where('status', 'online')->get();
        $userIds = [];
        foreach ($userList as $key => $value) {
            $userIds[$key] = $value->id;
        }
        return array_unique($userIds);
    }
    public function getChatRoomsByAuth(){
        $chatRooms = ChatRoomDetails::where('portal_id',auth()->user()->portalInfo->portal_id)
        ->get();
        $chatRoomIds = [];
        foreach ($chatRooms as $key => $value) {
            $chatRoomIds[$key] = $value->id;
        }
        return array_unique($chatRoomIds);
    }
    public function getBlogListByAuth(){
        $blogs = Blogs::where('type',auth()->user()->portalInfo->portal_id)
        ->get();
        $blogIds = [];
        if($blogs)
            foreach ($blogs as $key => $value) {
                $blogIds[$key] = $value->id;
            }
        return array_unique($blogIds);
    }
    public function getEventListByAuth(){
        $events = Events::where('type',auth()->user()->portalInfo->portal_id)
        ->get();
        $eventIds = [];
        if($events)
            foreach ($events as $key => $value) {
                $eventIds[$key] = $value->id;
            }
        return array_unique($eventIds);
    }

    public function getGroupListByAuth(){
        $groups = Groups::where('type',auth()->user()->portalInfo->portal_id)
        ->get();
        $groupIds = [];
        if($groups)
            foreach ($groups as $key => $value) {
                $groupIds[$key] = $value->id;
            }
        return array_unique($groupIds);
    }
    public function formatDateTime($date){
        return Carbon::parse($date)->format('d-M-Y H:i:s');
    }
    public function totalShowPromotion($i){
        $count = 0;
        for($i; $i < sizeof(auth()->user()->promotionInfo); $i+=4){
            $count++;
        }
        return  $count;
    }

    public function getAllPortalUserByAuth(){
        $userIds = [];
        $userAll = PortalJoinUser::where([['user_id','!=', Auth::id()],['portal_id', auth()->user()->portalInfo->portal_id]])->get();
        foreach($userAll as $key => $value){
            $userIds[$key] = $value->user_id;
        }
        return array_unique($userIds);
    }
    public function isEligibleForRating($id){
       $checkRating = Rating::where([['from_user_id', auth()->id()],['to_user_id', $id],['portal_id', auth()->user()->portalInfo->portal_id]])->first();
         if($checkRating == null) {
             return true;
         }else {
             if($checkRating->updated_at <= Carbon::now()->subDays(14)){
                 return true;
             }else{
                 return false;
             }
         }
    }
    public function getCurrentPortalbyAuth(){
        return Portal::find(PortalJoinUser::find(auth()->user()->portalJoinUser_id)->portal_id);
    }

    public function deactivateUserList(){
        return PortalJoinUser::where([['portal_id', auth()->user()->portalInfo->portal_id],['isDeactivate', 1]])->pluck('user_id');
    }

    /**
     * Get the list of disabled profile users.
     *
     * @return mixed
     */
    public function disableUserList()
    {
        return PortalJoinUser::where([['portal_id', auth()->user()->portalInfo->portal_id],['profile_disable', 1]])->pluck('user_id');
    }

    public function isDeactivateUser($id){
        if(PortalJoinUser::where([['user_id', $id],['portal_id', auth()->user()->portalInfo->portal_id],['isDeactivate', 1]])->count() > 0){
            return true;
        }
    }
    public function isPortalUserByAuth($id){
        if(PortalJoinUser::where([['user_id', auth()->id()],['portal_id', $id]])->count() == 1){
            return true;
        }
    }
    public function isDeactivate(){
        if(PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])->count() != 0){
            return PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])->first()->isDeactivate;
    }
    }

    /**
     * Check whether a the current user's profile is disabled.
     *
     * @return mixed
     */
    public function isProfileDisable()
    {
        if (PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])->count() != 0) {
            return PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->portalInfo->portal_id]])->first()->profile_disable;
        }

        return false;
    }

    public function getBlockUserListByAuth(){
        $blockIds = [];
        $blockAl = Block::where([['block_by', Auth::id()],['portal_id', auth()->user()->portalInfo->portal_id],['block_status', 0]])
                ->orWhere([['block_to', Auth::id()],['portal_id', auth()->user()->portalInfo->portal_id],['block_status', 0]])
                ->get();
        foreach($blockAl as $key => $value){
            if($value->block_by == auth()->id()){
                $blockIds[$key] = $value->block_to;
            }else {
                 $blockIds[$key] = $value->block_by;
            }

        }
        return array_unique($blockIds);
    }
    public function isVisible($id){
        if(PortalJoinUser::where([['user_id', $id],['portal_id', auth()->user()->portalInfo->portal_id]])->count() != 0){
            return PortalJoinUser::where([['user_id', $id],['portal_id', auth()->user()->portalInfo->portal_id]])->first()->isvisible;
        }else {
            return 0;
        }
    }
    public function isPaid(){
        if(PortalJoinUser::where([['user_id', $this->attributes['id']],['portal_id', auth()->user()->portalInfo->portal_id],['membership_id','!=', 1]])->count() != 0){
            if(PortalJoinUser::where([['user_id', $this->attributes['id']],['portal_id', auth()->user()->portalInfo->portal_id],['membership_id','!=', 1]])->first()->membership_ends_at > Carbon::now()){
                return 1;
            }else {
                return 0;
            }

        }else {
            return 0;
        }
    }

    public function isStatus(){
        if(PortalJoinUser::where([['user_id', $this->attributes['id']],['portal_id', auth()->user()->portalInfo->portal_id],['membership_id','!=', 1]])->count() != 0){
            if(PortalJoinUser::where([['user_id', $this->attributes['id']],['portal_id', auth()->user()->portalInfo->portal_id],['membership_id','!=', 1]])->first()->membership_ends_at > Carbon::now()){
                return 1;
            }else {
                return 2;
            }

        }else {
            return 0;
        }
    }
    public function isEnableAutoPayment(){
        $subscriptionObj = Subscription::where([['user_id', auth()->id()],['name',auth()->user()->portalInfo->portal_id]])->whereIn('stripe_plan',["24hr","weekends","weekly","2week","monthly","monthly2nd","monthly3rd","3month","6month","1year"])->orderBy('created_at', 'DESC')->first();
        if($subscriptionObj){
            if($subscriptionObj->ends_at == null){
                return 1;
            }else{
                return 0;
            }
        }else {
            return 0;
        }
    }
    public function isFavBroadcastUser($id){
        if(Favourite::where([['favourite_to', auth()->id()],['favourite_by', $id],['portal_id',auth()->user()->portalInfo->portal_id]])->count() == 0){
            return 1;
        }else {
            return 2; //if favorite notification
        }
    }
    public function isFavUser($id){
        if(Favourite::where([['favourite_by', auth()->id()],['favourite_to', $id],['portal_id',auth()->user()->portalInfo->portal_id]])->count() == 0){
            return false;
        }else {
            return true;
        }
    }

    public function isFavorite(){
        if(Favourite::where([['favourite_by', auth()->id()],['favourite_to', $this->attributes['id']],['portal_id',auth()->user()->portalInfo->portal_id]])->count() == 0){
            return false;
        }else {
            return true;
        }
    }
    public function inboxUnreadNotifications(){
        $userList = [];
        $regularNotifList = new Collection();
        $regularUnreadNotifications = new Collection();
        $notificationList =  auth()->user()->unreadNotifications->sortBy('created_at');
        foreach ($notificationList as $key => $value) {
            $notificationType = $value->data['thread']['notificationType'];
            $portalId = $value->data['thread']['portal_id'];
            $userId = $value->data['user']['id'];
            if($notificationType == 1 || $notificationType == 2)
                if(auth()->user()->portalInfo->portal_id == $portalId){
                    if(Favourite::where([['favourite_to', $userId],['favourite_by',auth()->id()],['portal_id',auth()->user()->portalInfo->portal_id]])->count() == 0){
                        $userList[$key] = $value->data['user']['id'];
                        $regularNotifList->push($value);

                    }
                }
        }

        $userList =  array_unique($userList);

        $temp = null;
        foreach ($userList as $key1 => $user) {
            foreach ($regularNotifList as $key => $notif) {
                $userId = $notif->data['user']['id'];
                if($user == $userId){
                    $temp = $notif;
                }
            }
            $regularUnreadNotifications->push($temp);
        }
        return  $regularUnreadNotifications;
    }
    public function favoriteUnreadNotifications(){
        $userList = [];
        $regularNotifList = new Collection();
        $regularUnreadNotifications = new Collection();
        $notificationList =  auth()->user()->unreadNotifications->sortBy('created_at');
        foreach ($notificationList as $key => $value) {
            $notificationType = $value->data['thread']['notificationType'];
            $portalId = $value->data['thread']['portal_id'];
            $userId = $value->data['user']['id'];
            if($notificationType == 1 || $notificationType == 2)
                if(auth()->user()->portalInfo->portal_id == $portalId){
                    if(Favourite::where([['favourite_to', $userId],['favourite_by',auth()->id()],['portal_id',auth()->user()->portalInfo->portal_id]])->count() > 0){
                        $userList[$key] = $value->data['user']['id'];
                        $regularNotifList->push($value);

                    }
                }
        }

        $userList =  array_unique($userList);

        $temp = null;
        foreach ($userList as $key1 => $user) {
            foreach ($regularNotifList as $key => $notif) {
                $userId = $notif->data['user']['id'];
                if($user == $userId){
                    $temp = $notif;
                }
            }
            $regularUnreadNotifications->push($temp);
        }
        return  $regularUnreadNotifications;
    }
    public function othersUnreadNotifications(){
        $othersUnreadNotifications = new Collection();
        forEach(auth()->user()->unreadNotifications as $unread){
            if($unread->data['thread']['notificationType'] == 3 && $unread->notifiable_id == auth()->id() && $unread->data['thread']['portal_id'] == auth()->user()->portalInfo->portal_id){
                $othersUnreadNotifications->push($unread);

            }
        }
        return $othersUnreadNotifications;
    }
    public function blogs(){
        return $this->hasMany(Blogs::class);
    }
    public function chatRoomJoinUsers(){
        return $this->hasMany(ChatRoomJoinUser::class);
    }
    public function memberOfPortals(){
        $portalList = new Collection();
        foreach (PortalJoinUser::where('user_id', Auth::user()->id)->get() as $value) {
            $portal = Portal::find($value['portal_id']);
             $portalList->push($portal);
        }
        return $portalList;
    }
    public function portalType($id){
        return Portal::find(PortalJoinUser::find($id)->portal_id)->portalType;
    }
    public function getPortalDetail($userID, $portalId){
        return PortalJoinUser::where([['user_id', $userID],['portal_id', $portalId]])->first()->profile_detail;
    }
    public function getportal($id){
        return PortalJoinUser::find($id)->portal_id;
    }

    public function portalName($id){
        return Portal::find($id)->portalType;
    }

    public function getmembership($id){
        return PortalJoinUser::find($id)->membership_id;
    }
    public function events(){
        return $this->hasMany(Events::class);
    }
    public function portalJoinUsers(){
        return $this->hasMany(PortalJoinUser::class);
    }
    public function isPortalUser($userId, $portalId){
        if(PortalJoinUser::where([['user_id', $userId],['portal_id', $portalId]])->count() == 1){
            return true;
        }else{
            return false;
        }
    }
    public function portals(){
        return $this->hasMany(Portal::class);
    }
    public function eventJoinUser(){
        return $this->hasMany(EventJoinUser::class);
    }

    public function receivedChat() {
        return $this->hasMany(\App\UserChat::class);
    }

    public function sendChat()
    {
        return $this->hasMany(\App\UserChat::class, 'sender_id');
    }

    public function reportFromUsers() {
        return $this->hasMany(UserReport::class);
    }
    public function reportToUsers() {
        return $this->hasMany(UserReport::class);
    }

    public function chatRooms() {
        return $this->hasMany(ChatRoom::class);
    }

    public function isChatRoomUser($chatRoomDetail_id){
        if(ChatRoomJoinUser::where([['user_id', Auth::id()],
        ['chatRoomDetail_id', $chatRoomDetail_id]])->count() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function isChatRoomUserCurrently($chatRoomDetail_id){
        if(ChatRoomDetails::where([['portal_id', auth()->user()->portalInfo->portal_id],
       ])->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getmeMbershipFromPortalJoinUserId(){
       return Membership::find(PortalJoinUser::find(Auth::user()->portalJoinUser_id)->membership_id);
    }

    public function chatRoomUserList($chatRoomDetailsId){
             $chatRoomUserList = new Collection();
            foreach (ChatRoomJoinUser::where('chatRoomDetail_id', $chatRoomDetailsId)->get(['user_id']) as $key => $value) {
                $chatRoomUserList->push($value->user_id);
            }
            return User::whereIn('id',$chatRoomUserList)->get();
    }

    public function userblockBy(){
        return $this->hasMany('App\Models\Block', 'id');
    }

    public function region(){
        return Region::find(1)->region_name;
    }

    public function getProfilePictureAttribute(){

        return $profilePicture = portalJoinUser::where([['user_id', $this->attributes['id']],['portal_id', auth()->user()->portalInfo->portal_id]])->first()->profilePicture;

    }


    public function getPortalInfoAttribute(){
        // return "portal Info";
        if (auth()->check()) {
            return portalJoinUser::where([['user_id', $this->attributes['id']],['portal_id', auth()->user()->getCurrentPortalbyAuth()->id]])
            ->first();
        }else {
            return portalJoinUser::where([['user_id', $this->attributes['id']],['portal_id', 1]])
            ->first();
        }
    }

    public function getPromotionInfoAttribute(){
        return UserPromotation::where([['promotion_ends_at', '>' ,Carbon::now()],['portal_type',auth()->user()->portalInfo->portal_id]])
        ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth()) ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->get();
    }

    public function getUserNameAttribute(){
        if(PortalJoinUser::where('user_id', $this->attributes['id'])->count() > 1){
            if( PortalJoinUser::find($this->attributes['portalJoinUser_id'])->username == null){
                return PortalJoinUser::where([['user_id', $this->attributes['id']]])->first()->username;
            }
        }
        return PortalJoinUser::find($this->attributes['portalJoinUser_id'])->username;
    }

    public function getChatSidebarColorAttribute(){
        if (auth()->user()->portalInfo->portal_id ==  1) {
           return "date-chat-background";

        } elseif(auth()->user()->portalInfo->portal_id == 2) {
            return "sugar-chat-background";

        }elseif(auth()->user()->portalInfo->portal_id == 3) {
            return "fræk-chat-background";

        }elseif(auth()->user()->portalInfo->portal_id == 4) {
            return "Affære-chat-background";

        }elseif(auth()->user()->portalInfo->portal_id == 5) {
            return "senior-chat-background";

        }elseif(auth()->user()->portalInfo->portal_id == 6) {
            return "regnbue-chat-background";
        }

    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
