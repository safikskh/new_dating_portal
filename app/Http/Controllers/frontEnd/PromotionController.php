<?php

namespace App\Http\Controllers\frontEnd;

use File;
use DateTime;
use Carbon\Carbon;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use App\Models\UserPromotation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotonList = UserPromotation::where([['promotion_ends_at', '>' ,Carbon::now()],['portal_type',auth()->user()->portalInfo->portal_id]])
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->get();
        return view('frontEnd.profilePromotionList',compact('promotonList'));
    }


     //for show all promotion plan
    public function promotionplans(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      } 
    //   return "callled ";
    //   session()->forget('promotion');
      $portalUser = PortalJoinUser::find(Auth::user()->portalJoinUser_id);
      $imagelink = session()->get('promotion')['imageURL']; 
      $title= session()->get('promotion')['title']; 
      $plans = Membership::whereIn('slug', ['profilepromotion','profilepromotion24hr'])->get();
      session()->forget('promotion');

      return view('frontEnd.memberships.profilePromotion.index', compact('plans','imagelink','title'));

    }

    public function promotionstart(Request $request){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      } 

      $portalUser = PortalJoinUser::find(Auth::user()->portalJoinUser_id);
      $imagelink = $request->temp_image_name;
      $title= $request->title;
      $plans = Membership::whereIn('slug', ['profilepromotion','profilepromotion24hr'])->get();

      
      return view('frontEnd.memberships.profilePromotion.index', compact('plans','imagelink','title'));

    }

    //after choose promotion plan
    public function promotionplan(Request $request){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }
       $plan = Membership::find($request->plan);
       $imagelink = $request->imagelink;
       $title = $request->title;
       return view('frontEnd.memberships.profilePromotion.show', compact('plan','imagelink','title'));
    }

    //promotion plan payment
    public function promotionplancreate(Request $request, Membership $plan){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $proImageURL = $request->get('imagelink');
        $proTitle = $request->get('title');
        $plan = Membership::findOrFail($request->get('plan'));
      
        if($request->user()
            ->newSubscription(auth()->user()->portalInfo->portal_id, $plan->stripe_plan)
            ->create()){
              if (auth()->user()->subscription((string)auth()->user()->portalInfo->portal_id)->cancel()) {
                $data = new UserPromotation();
                $old_path = 'uploads/temporary/'.$proImageURL;
                $new_path = 'uploads/profilepromotation/'.$proImageURL;
                File::move($old_path, $new_path);
                $data->image = $new_path;
                $data->promotionTitle = $proTitle;
                $data->user_id = Auth::user()->id;
                $data->portal_type = Auth::user()->getportal(Auth::user()->portalJoinUser_id);
                $data->promotion_ends_at = (new \DateTime())->modify('+'.$plan->duration);
                $data->save();

                return redirect('/home')->with('successs','your profile is promoted');
              }
            }
         
    }
}
