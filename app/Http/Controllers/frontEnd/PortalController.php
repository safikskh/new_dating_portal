<?php

namespace App\Http\Controllers\frontEnd;

use App\User;
use DateTime;
use App\Enums\Sex;
use Carbon\Carbon;
use App\Models\CoupleInfo;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use App\Models\Backend\PromoCode;
use App\Http\Controllers\Controller;
use App\Notifications\TemplateEmail;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class PortalController extends Controller
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

        if (!session()->has('portalId')) {
            return redirect('home');
        }
            //  session()->forget('coupon');
        if(count(getRegisterPortalIdArrayByAuth()) == 1 ){
            $plans = ['free','md2nd','ugo','weekend','day','kvartal','arllg','ar'];
        }elseif (count(getRegisterPortalIdArrayByAuth()) == 2) {
            $plans = ['free','md3rd','ugo','weekend','day','kvartal','arllg','ar'];
        }
        $plans = Membership::whereIn('slug', $plans)->orderBy('updated_at', 'ASC')->get();
        $isNewPortalReg = true;
        return view('frontEnd.memberships.switchPortal.index', compact('plans','isNewPortalReg'));
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
   
        if($portalUser = PortalJoinUser::where([['user_id', Auth::user()->id],['portal_id', $request->id]])->first()){
            if (Carbon::now() < $portalUser->membership_ends_at) {
                Toastr::success('You are already member this portal!', 'Success');
                return redirect()->back();
            }else {
                session(['portalId' => $request->id]);
                $plans = Membership::whereIn('slug', ['free','md','ugo','weekend','day','kvartal','arllg','ar'])->get();
                return redirect('portals');
            }
        }else{
            session(['portalId' => $request->id]);
            $plans = Membership::whereIn('slug', ['free','md','ugo','weekend','day','kvartal','arllg','ar'])->get();
            return redirect('portals');
           
        }
    }

    public function portalplan(Membership $plan, Request $request){

        // check is it free registration or not
        if($plan->id == 1){
            $portalId = session('portalId');
            return $this->registerNewPortal($portalId, $plan);
        }

        return view('frontEnd.memberships.switchPortal.show', compact('plan'));
    }

    public function portalplancreate(Request $request, Membership $plan){

        $plan = Membership::findOrFail($request->get('plan')); 
        $portalId = session('portalId');
        if (session()->has('coupon')) { 
            if($request->user()
                ->newSubscription($portalId, $plan->stripe_plan)
                ->withCoupon(session()->get('coupon')['name'])
                ->create($request->stripeToken)){ 
                    $promocode = PromoCode::where('promoCode', session()->get('coupon')['name'])->first();
                    if($promocode && $promocode->isOneTimeUse){
                        $promocode->isUsed = 1;
                        $promocode->save();                        
                    }
                return $this->registerNewPortal($portalId, $plan);
            }
        }else {
            if($request->user()
                ->newSubscription($portalId, $plan->stripe_plan)
                ->create($request->stripeToken)){ 
            return $this->registerNewPortal($portalId, $plan);
            }
        }
    }

    public function registerNewPortal($portalId, $plan){
        $portalUser = PortalJoinUser::where([['user_id', Auth::id()],['portal_id',$portalId]])->first();
         if ($portalUser) {
                $portalUser->membership_id =  $plan->id;
                $portalUser->membership_ends_at =  (new \DateTime())->modify('+'.$plan->duration);
                $portalUser->save();
                $user = User::find(Auth::id());
                $user->portalJoinUser_id = $portalUser->id;
                $user->save();
                return redirect('home')->with('successs', 'Membership plan updated');
            }else {
                $portalUserOld = PortalJoinUser::where([['user_id', Auth::id()]])->first();
                
                $newPortalJoinUser = new PortalJoinUser();

                $newPortalJoinUser->user_id = Auth::id();
                $newPortalJoinUser->portal_id = $portalId;
                $newPortalJoinUser->membership_id =  $plan->id;
                $newPortalJoinUser->membership_ends_at = (new \DateTime())->modify('+'.$plan->duration);
                $newPortalJoinUser->sex =  $portalUserOld->sex;
                $newPortalJoinUser->region_id =  $portalUserOld->region_id;
                $newPortalJoinUser->dob =  $portalUserOld->dob;
                $newPortalJoinUser->firstName =  $portalUserOld->firstName;
                $newPortalJoinUser->lastName =  $portalUserOld->lastName;
                $newPortalJoinUser->profile_detail =  $portalUserOld->profile_detail;
                $newPortalJoinUser->sexualOrientation =  $portalUserOld->sexualOrientation;
                $newPortalJoinUser->zipCode =  $portalUserOld->zipCode;
                $newPortalJoinUser->civilStatus =  $portalUserOld->civilStatus;
                $newPortalJoinUser->height =  $portalUserOld->height;
                $newPortalJoinUser->weight =  $portalUserOld->weight;
                $newPortalJoinUser->hairColor =  $portalUserOld->hairColor;
                $newPortalJoinUser->eyeColor =  $portalUserOld->eyeColor;
                $newPortalJoinUser->searching =  $portalUserOld->searching;
                $newPortalJoinUser->bodyType =  $portalUserOld->bodyType;
                $newPortalJoinUser->tattoos =  $portalUserOld->tattoos;
                $newPortalJoinUser->piercing =  $portalUserOld->piercing;
                $newPortalJoinUser->children =  $portalUserOld->children;
                $newPortalJoinUser->smoking =  $portalUserOld->smoking;
                $newPortalJoinUser->matchWords =  $portalUserOld->matchWords;
                $newPortalJoinUser->nMatchWords =  $portalUserOld->nMatchWords;
                $newPortalJoinUser->profilePicture =  $portalUserOld->profilePicture;
                $newPortalJoinUser->save();

                if ($portalUserOld->sex == Sex::getValue('Par')) {
                    $coupleMaleOld = CoupleInfo::where([['portalJoinUser_id', auth()->user()->portalInfo->id],['sex',Sex::getValue('Mand')]])->first();
                    $this->saveCoupleInfo($coupleMaleOld, $newPortalJoinUser->id, Sex::getValue('Mand'));
                    $coupleFemaleOld = CoupleInfo::where([['portalJoinUser_id', auth()->user()->portalInfo->id],['sex',Sex::getValue('Kvinde')]])->first();
                    $this->saveCoupleInfo($coupleFemaleOld, $newPortalJoinUser->id, Sex::getValue('Kvinde'));

                }

                $user = User::find(Auth::id());
                $user->portalJoinUser_id = $newPortalJoinUser->id;
                $user->save();
                $newPortalJoinUser->notificationType = 5;
                if(!auth()->user()->portalInfo->isDisableEmailNotif){
                    auth()->user()->notify(new TemplateEmail($newPortalJoinUser));
                }
                session()->forget('portalId');
                session()->forget('coupon');
                return redirect('profile_edit')->with('successs', 'join new portal & you have been switched to '. Auth::user()->portalType($user->portalJoinUser_id));
            }      
    }

    public function saveCoupleInfo($request, $portalJoinUser_id, $sex){

        $CoupleInfo = new CoupleInfo();

        $CoupleInfo->portalJoinUser_id = $portalJoinUser_id;
        $CoupleInfo->sex = $sex;
        $CoupleInfo->firstName = $request->firstName;
        $CoupleInfo->lastName = $request->lastName;
        $CoupleInfo->dob = $request->dob;
        $CoupleInfo->sexualOrientation = $request->sexualOrientation;
        $CoupleInfo->civilStatus = $request->civilStatus;
        $CoupleInfo->height = $request->height;
        $CoupleInfo->weight = $request->weight;
        $CoupleInfo->hairColor = $request->hairColor;
        $CoupleInfo->eyeColor = $request->eyeColor;
        $CoupleInfo->searching = $request->searching;
        $CoupleInfo->bodyType = $request->bodyType;
        $CoupleInfo->tattoos = $request->tattoos;
        $CoupleInfo->piercing = $request->piercing;
        $CoupleInfo->children = $request->children;
        $CoupleInfo->smoking = $request->smoking;
        $CoupleInfo->profilePicture = $request->profilePicture;
        $CoupleInfo->save();

    }


    public function update(Request $request, $id)
    {
        //OLD
            // if(auth()->user()->isDeactivate()){
            //     return redirect('profile_security')->with('error','please active your account to access');
            // }
            
            // $portalUser = PortalJoinUser::where([['user_id', Auth::user()->id],['portal_id', $id]])->get();
            // $user = User::find(Auth::user()->id);
            // $user['portalJoinUser_id'] = $portalUser[0]->id;
            // $user->save();
            // return redirect('home')->with('successs', 'You have been switched to '. Auth::user()->portalType($user->portalJoinUser_id));
        //OLD

        if($portalUser = PortalJoinUser::where([['user_id', Auth::user()->id],['portal_id', $id]])->first()){
            if (Carbon::now() < $portalUser->membership_ends_at) {
                $user = User::find(Auth::user()->id);
                $user['portalJoinUser_id'] = $portalUser->id;
                $user->save();
                Toastr::success('You have been switched to '. Auth::user()->portalType($user->portalJoinUser_id), 'Success');
                return redirect('home');
            }else {
                session(['portalId' => $id]);
                $plans = Membership::whereIn('slug', ['free','md','ugo','weekend','day','kvartal','arllg','ar'])->get();
                return redirect('portals');
            }
        }else{
            session(['portalId' => $id]);
            $plans = Membership::whereIn('slug', ['free','md','ugo','weekend','day','kvartal','arllg','ar'])->get();
            return redirect('portals');
        }
    }

     // promocode
    public function promoCodeStore(Request $request){
        
        $coupon = PromoCode::where([['promoCode', $request->coupon_code],['edate','>', Carbon::now()],['isUsed',0]])->first();
        if (!$coupon) {
            
            return back()->with('error','Invalid coupon code. Please try again.');
        }
        if($coupon->promoCode == "TG2019" || $coupon->promoCode == "FL2019" || $coupon->promoCode == "DPFB"
        || $coupon->promoCode == "DPIG" || $coupon->promoCode == "DPLOVE" || $coupon->promoCode == "DPMIX"
        || $coupon->promoCode == "DPSINGLE" || $coupon->promoCode == "promo"){
            return back()->with('error','Invalid coupon code. Please try again.');
            //  session()->put('coupon',[
            //     'name' => $coupon->promoCode,
            //     'mddiscount' => $coupon->discount(Membership::where('slug','md')->first()->cost, $coupon->isFixed),
            //     'md2nddiscount' => 0,
            //     'md3rddiscount' => 0,
            //     'ugodiscount' => 0,
            //     'weekenddiscount' => 0,
            //     'daydiscount' => 0,
            //     'kvartaldiscount' => 0,
            //     'arllgdiscount' => 0,
            //     'ardiscount' => 0,
            //     '2weekdiscount' => 0,
            // ]);

        }else {
            session()->put('coupon',[
                'name' => $coupon->promoCode,
                'mddiscount' => $coupon->discount(Membership::where('slug','md')->first()->cost, $coupon->isFixed),
                'md2nddiscount' => $coupon->discount(Membership::where('slug','md2nd')->first()->cost, $coupon->isFixed),
                'md3rddiscount' => $coupon->discount(Membership::where('slug','md3rd')->first()->cost, $coupon->isFixed),
                'ugodiscount' => $coupon->discount(Membership::where('slug','ugo')->first()->cost,$coupon->isFixed),
                'weekenddiscount' => $coupon->discount(Membership::where('slug','weekend')->first()->cost,$coupon->isFixed),
                'daydiscount' => $coupon->discount(Membership::where('slug','day')->first()->cost,$coupon->isFixed),
                'kvartaldiscount' => $coupon->discount(Membership::where('slug','kvartal')->first()->cost,$coupon->isFixed),
                'arllgdiscount' => $coupon->discount(Membership::where('slug','arllg')->first()->cost,$coupon->isFixed),
                'ardiscount' => $coupon->discount(Membership::where('slug','ar')->first()->cost,$coupon->isFixed),
                '2weekdiscount' => 0,
            ]);
        }

        return redirect()->back()->with('successs', 'Coupon has been applied!');
    }
    public function promoCodeDestroy(){
        session()->forget('coupon');

        return back()->with('successs', 'Coupon has been removed.');
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
