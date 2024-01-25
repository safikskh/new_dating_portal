<?php

namespace App\Http\Controllers\frontEnd;

use App\User;
use DateTime;
use App\UserChat;
use App\Enums\Sex;
use App\Models\Block;
use App\Models\Blogs;
use App\Models\Events;
use App\Models\Groups;
use App\Models\Rating;
use App\Models\Status;
use App\Models\ChatRoom;
use App\Models\EventPost;
use App\Models\Favourite;
use App\Models\CoupleInfo;
use App\Models\FileUpload;
use App\Models\Membership;
use App\Models\BlogComments;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\EventJoinUser;
use App\Models\GroupJoinUser;
use App\Models\PortalJoinUser;
use App\Models\VisitedProfile;
use App\Models\UserPostOnGroup;
use App\Models\UserPromotation;
use App\Models\EventPostComment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UserLikesOnGroupPost;
use App\Models\UserCommentsOnGroupPost;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $isVisible = PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->getPortal(auth()->user()->portalJoinUser_id)]])->first()->isvisible;
        return view('frontEnd.settings.profile_privacy',compact('isVisible'));
    }
    public function pushnotificationShow()
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $isDisablePushNotif = PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->getPortal(auth()->user()->portalJoinUser_id)]])->first()->isDisablePushNotif;
        return view('frontEnd.settings.push_notification',compact('isDisablePushNotif'));
    }
    
    public function updatePrivacy(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $portalUser = PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->getPortal(auth()->user()->portalJoinUser_id)]])->first();
        if(isset($request->isvisible)){
            $portalUser->isvisible = 1;
            $portalUser->save();
        }else {
            $portalUser->isvisible = 0;
            $portalUser->save();
        }
        return redirect()->back()->with('successs', 'status change successfully');
    }
    public function updatePushnotification(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $portalUser = PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->getPortal(auth()->user()->portalJoinUser_id)]])->first();
        if(isset($request->isDisablePushNotif)){
            $portalUser->isDisablePushNotif = 0;
            $portalUser->save();
        }else {
            $portalUser->isDisablePushNotif = 1;
            $portalUser->save();
        }
        return redirect()->back()->with('successs', 'status change successfully');
    }
    public function security()
    {
        $portal = PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->getPortal(auth()->user()->portalJoinUser_id)]])->first();
        $isDeactivate = $portal->isDeactivate;
        $profile_disable = $portal->profile_disable;

        return view('frontEnd.settings.profile_security',compact('isDeactivate', 'profile_disable'));
    }
    
    public function updateSecurityy(Request $request)
    {
        $portalJoinUser = auth()->user()->portalInfo;
       
        DB::beginTransaction();
        if(Block::where([['block_by', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
        ->orWhere([['block_to', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->exists()){
            Block::where([['block_by', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
        ->orWhere([['block_to', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->delete();
        }
        if(Rating::where([['from_user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
        ->orWhere([['to_user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->exists()){
            Rating::where([['from_user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
        ->orWhere([['to_user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->delete();
        }

        if(BlogComments::where('user_id', auth()->id())->whereIn('blog_id',auth()->user()->getblogListByAuth())->exists())
            BlogComments::where('user_id', auth()->id())->whereIn('blog_id',auth()->user()->getblogListByAuth())->delete();
        if(Blogs::where([['user_id', auth()->id()],['type',$portalJoinUser->portal_id]])->exists())
            Blogs::where([['user_id', auth()->id()],['type',$portalJoinUser->portal_id]])->delete();
            
        if(EventPostComment::where('user_id', auth()->id())->whereIn('event_post_id',$this->geteventPostListByAuth())->exists())
            EventPostComment::where('user_id', auth()->id())->whereIn('event_post_id',$this->geteventPostListByAuth())->delete();
        if(EventPost::where('user_id', auth()->id())->whereIn('event_id',auth()->user()->getEventListByAuth())->exists())
            EventPost::where('user_id', auth()->id())->whereIn('event_id',auth()->user()->getEventListByAuth())->delete();
        if(EventJoinUser::where('user_id', auth()->id())->whereIn('event_id',auth()->user()->getEventListByAuth())->exists())
            EventJoinUser::where('user_id', auth()->id())->whereIn('event_id',auth()->user()->getEventListByAuth())->delete();
        if(Events::where([['user_id', auth()->id()],['type',$portalJoinUser->portal_id]])->exists())
            Events::where([['user_id', auth()->id()],['type',$portalJoinUser->portal_id]])->delete();
        
        if(UserLikesOnGroupPost::where('user_id', auth()->id())->whereIn('post_id',$this->getGroupPostListByAuth())->exists())
            UserLikesOnGroupPost::where('user_id', auth()->id())->whereIn('post_id',$this->getGroupPostListByAuth())->delete();
        if(UserCommentsOnGroupPost::where('user_id', auth()->id())->whereIn('post_id',$this->getGroupPostListByAuth())->exists())
            UserCommentsOnGroupPost::where('user_id', auth()->id())->whereIn('post_id',$this->getGroupPostListByAuth())->delete();
        if(UserPostOnGroup::where('user_id', auth()->id())->whereIn('group_id',auth()->user()->getGroupListByAuth())->exists())
            UserPostOnGroup::where('user_id', auth()->id())->whereIn('group_id',auth()->user()->getGroupListByAuth())->delete();
        if(GroupJoinUser::where('user_id', auth()->id())->whereIn('group_id',auth()->user()->getGroupListByAuth())->exists())
            GroupJoinUser::where('user_id', auth()->id())->whereIn('group_id',auth()->user()->getGroupListByAuth())->delete();
        if(Groups::where([['user_id', auth()->id()],['type',$portalJoinUser->portal_id]])->exists())
            Groups::where([['user_id', auth()->id()],['type',$portalJoinUser->portal_id]])->delete();

        if(Status::where([['user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->exists())
            Status::where([['user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->delete();
        if(UserPromotation::where([['user_id', auth()->id()],['portal_type',$portalJoinUser->portal_id]])->exists())
            UserPromotation::where([['user_id', auth()->id()],['portal_type',$portalJoinUser->portal_id]])->delete();

        if(VisitedProfile::where([['user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
        ->orWhere([['visited_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->exists())
            VisitedProfile::where([['user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
            ->orWhere([['visited_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->delete();

        if(UserChat::where([['user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
        ->orWhere([['sender_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->exists())
            UserChat::where([['sender_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
            ->orWhere([['user_id', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->delete();

        if(Favourite::where([['favourite_to', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
        ->orWhere([['favourite_by', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->exists())
            Favourite::where([['favourite_to', auth()->id()],['portal_id',$portalJoinUser->portal_id]])
            ->orWhere([['favourite_by', auth()->id()],['portal_id',$portalJoinUser->portal_id]])->delete();

        if(FileUpload::where([['user_id', auth()->id()],['user_type',$portalJoinUser->portal_id]])->exists())
            FileUpload::where([['user_id', auth()->id()],['user_type',$portalJoinUser->portal_id]])->delete();

        if(ChatRoom::where('user_id', auth()->id())->whereIn('chatRoomDetail_id',auth()->user()->getChatRoomsByAuth())->exists())
            ChatRoom::where('user_id', auth()->id())->whereIn('chatRoomDetail_id',auth()->user()->getChatRoomsByAuth())->delete();
       
       
        if($portalJoinUser->sex == Sex::getValue('Par')){
            if(CoupleInfo::where('portalJoinUser_id', $portalJoinUser->id)->exists())
                CoupleInfo::where('portalJoinUser_id', $portalJoinUser->id)->delete();
        }

        if(auth()->user()->isEnableAutoPayment()){
            $subscriptionObj = Subscription::where([['user_id', auth()->id()],['name',auth()->user()->portalInfo->portal_id]])->whereIn('stripe_plan',["24hr","weekends","weekly","2week","monthly","monthly2nd","monthly3rd","3month","6month","1year"])->orderBy('created_at', 'DESC')->first();
                $plan = Membership::where('stripe_plan',$subscriptionObj->stripe_plan)->first(); 
                \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
                $subscription = \Stripe\Subscription::retrieve($subscriptionObj->stripe_id);
                if($subscription->cancel()){
                    $subscriptionObj->ends_at = (new \DateTime())->modify('+'.$plan->duration);
                    $subscriptionObj->save();
            }
        }
        
        if(PortalJoinUser::where('user_id', auth()->id())->count() > 1){
          $firstPortalJoinUser = PortalJoinUser::where('user_id', auth()->id())
            ->where('id','!=',$portalJoinUser->id)
            ->first();
            if(PortalJoinUser::where('id', $portalJoinUser->id)->exists())
                PortalJoinUser::where('id', $portalJoinUser->id)->delete();
            $user = User::find(auth()->id());
            $user->portalJoinUser_id = $firstPortalJoinUser->id;
            $user->save();        
        }else {
            if(PortalJoinUser::where('id', $portalJoinUser->id)->exists())
                PortalJoinUser::where('id', $portalJoinUser->id)->delete();
            if(User::where('id', auth()->id())->exists())
                User::where('id', auth()->id())->delete();
        }
        DB::commit();
        auth()->logout();
        return redirect('/');

    }

    /**
     * Enable or disable the current user's profile for the specified portal.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function profileAction(Request $request)
    {
        $request->input('profile_disable') == 1 ? $disable = true : $disable = false;
        $portal = PortalJoinUser::where([['user_id', auth()->id()],['portal_id', auth()->user()->getPortal(auth()->user()->portalJoinUser_id)]]);

        if ($disable) {
            $portal->update([
                'profile_disable' => 1
            ]);

            // auth()->logout();
            // return redirect('/');
            return redirect()->back();
        }

        $portal->update([
            'profile_disable' => 0
        ]);

        return redirect()->back();
    }

    public function transationHistory()
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $subscriptions = Subscription::where('user_id', auth()->id())->get();
        return view('frontEnd.settings.transation',compact('subscriptions'));
    }

    public function cardInsert()
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $plan = Membership::where([['slug', 'status']])->first();
        return view('frontEnd.settings.card_insert',compact('plan'));
    }

    public function cardUpdate(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        
        if ($request->user()->hasCardOnFile()){
            $request->user()->updateCard($request->stripeToken);
        }else {
            $request->user()->createAsStripeCustomer();
            $request->user()->updateCard($request->stripeToken);
        }
        
        return redirect('/transations')->with('successs', 'card updated');
    }

    public function updateMembership(Request $request){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        if(isset($request->isFreeMembership)){
            $subscriptionObj = Subscription::where([['user_id', auth()->id()],['name',auth()->user()->portalInfo->portal_id]])->whereIn('stripe_plan',["24hr","weekends","weekly","2week","monthly","monthly2nd","monthly3rd","3month","6month","1year"])->orderBy('created_at', 'DESC')->first();
            $plan = Membership::where('stripe_plan',$subscriptionObj->stripe_plan)->first(); 
            \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
            $subscription = \Stripe\Subscription::retrieve($subscriptionObj->stripe_id);
            if($subscription->cancel()){
                $subscriptionObj->ends_at = (new \DateTime())->modify('+'.$plan->duration);
                $subscriptionObj->save();
                return redirect()->back()->with('successs', 'membership updated');
            }
        }
        return redirect()->route('plans.index');
    }

    public function emailSettingShow(){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $isDisableEmailNotif = auth()->user()->portalInfo->isDisableEmailNotif;
        return view('frontEnd.settings.email_notification', compact('isDisableEmailNotif'));
    }
    public function emailSettingUpdate(Request $request){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $currentPortalId = auth()->user()->portalJoinUser_id;
        $currentPortal = PortalJoinUser::find($currentPortalId);
        if(isset($request->isDisableEmailNotif)){            
            $currentPortal->isDisableEmailNotif = 0;
            $currentPortal->save();
        }else{
            $currentPortal->isDisableEmailNotif = 1;
            $currentPortal->save();
        }
        return redirect()->back()->with('successs', 'status change successfully');
        
    }

    public function getEventPostListByAuth(){
        $lists = EventPost::whereIn('event_id',auth()->user()->getEventListByAuth())->get();
        $ids = [];
        if($lists)
            foreach ($lists as $key => $value) {
                $ids[$key] = $value->id;
            }
        return array_unique($ids);
    }

    public function getGroupPostListByAuth(){
        $lists = UserPostOnGroup::whereIn('group_id',auth()->user()->getgroupListByAuth())->get();
        $ids = [];
        if($lists)
            foreach ($lists as $key => $value) {
                $ids[$key] = $value->id;
            }
        return array_unique($ids);
    }
}
