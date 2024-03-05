<?php

namespace App\Http\Controllers\frontEnd;

use App\User;

use DateTime;
use App\Enums\Sex;
use Carbon\Carbon;
use App\Enums\Height;
use App\Enums\Weight;
use App\Enums\Smoking;
use App\Enums\Tattoos;
use App\Models\Portal;
use App\Models\Region;
use App\Enums\BodyType;
use App\Enums\Children;
use App\Enums\EyeColor;
use App\Enums\Piercing;
use App\Enums\HairColor;
use App\Enums\Searching;
use Stripe\Subscription;
use App\Enums\CivilStatus;
use App\Enums\IAmSeekingA;
use App\Models\CoupleInfo;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use App\Enums\SexualOrientation;
use App\Models\Backend\PromoCode;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\TemplateEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Stripe\Laravel\Facades\Stripe;



class SignupController extends Controller
{

    public function f2(Request $request){

        return view('form.f2');
    }

    public function f3(Request $request){

        return view('form.f3');
    }

    public function f5(Request $request){

        return view('form.f5');
    }

    public function SecondStep(Request $request){
        // dd($request);
        session()->forget('signup');
        $this->validate($request, [
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
            'day' => ['required'],
            'month' => ['required'],
            'year' => ['required'],
            'sex' => ['required'],
        ]);
        session()->put('signup1',[
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => $request->password,
            'dob' => $request->year.'-'.$request->month.'-'.$request->day,
            'sex' => $request->sex,
        ]);

        // return $request->all();
        if($request->sex == Sex::getValue('Mand'))
            {$sex = Sex::getValue('Kvinde');}
        elseif($request->sex == Sex::getValue('Kvinde'))
            {$sex = Sex::getValue('Mand');}
        else
            {$sex = Sex::getValue('Par');}

        return view('frontEnd.signup.secondStep',compact('sex'));
    }
    public function ThirdStep(Request $request){
        $this->validate($request,[
            'portal_id' => ['required']
        ]);
        $check = Portal::find($request->portal_id)->portalType;
        session()->put('signup2',[
             'iAmSeekingA' => Portal::find($request->portal_id)->portalType
        ]);
        if(session()->get('signup1')['sex'] == Sex::getValue('Mand'))
            {$sex = Sex::getValue('Kvinde');}
        elseif(session()->get('signup1')['sex'] == Sex::getValue('Kvinde'))
            {$sex = Sex::getValue('Mand');}
        else
            {$sex = Sex::getValue('Par');}

        session()->put('userObj',array_merge(session('signup1'),session('signup2'),$request->all()));
        return redirect('/signupplans');
        // return view('frontEnd.signup.thirdStep',compact('sex'));
    }

    public function checkUserProfileStatus(){
        return 0;
    }

    public function FortStep(Request $request){

        $this->validate($request,[
            'profilePicture' => ['required'],
            'profile_detail' => ['required'],
        ]);
        $imagePath = '';
            if($file =$request->file('profilePicture')){
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $file->move('uploads/profilePictures', $name );
                    $imagePath = "uploads/profilePictures/". $name;
        }
        session()->put('signup3',[
             'profilePicture' => $imagePath,
             'profile_detail' => $request->profile_detail,
        ]);

        return redirect()->route('signup.show.fort');

    }
    public function FortStepShow(){

        return view('frontEnd.signup.fortStep');
    }
    public function FifthStepSubmit(Request $request){
        $this->validate($request,[
            'username' => ['required', 'max:255', 'unique:portal_join_users'],
            'sexualOrientation' => ['required'],
            'zipCode' => ['required'],
            'civilStatus' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'hairColor' => ['required'],
            'eyeColor' => ['required'],
            'searching' =>[ 'required'],
            'bodyType' => ['required'],
            'tattoos' => ['required'],
            'piercing' => ['required'],
            'children' => ['required'],
            'smoking' => ['required'],
            'region_id' => ['required'],
            'matchWords' => ['required'],
            'profilePicture' => ['required'],
            'profile_detail' => ['required'],
        ]);


        $newPortalJoinUser = PortalJoinUser::where('user_id',auth()->user()->id)->first();
        $imagePath = '';
            if($file =$request->file('profilePicture')){
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $file->move('uploads/profilePictures', $name );
                    $imagePath = "uploads/profilePictures/". $name;
                    $request['profilePicture'] = $imagePath;
            }
        // dd($newPortalJoinUser);
        // if(isset($request['profilePicture']))
        //     $newPortalJoinUser->profilePicture = $request['profilePicture'];
        // if(isset($request['username']))
        //     $newPortalJoinUser->username = $request['username'];
        // // $newPortalJoinUser->user_id = $newUser->id;
        // // $newPortalJoinUser->portal_id = $portal->id;
        // // $newPortalJoinUser->membership_id = $membership->id;
        // // $newPortalJoinUser->membership_ends_at = (new \DateTime())->modify('+'.$membership->duration);
        // if(isset($request['firstName']))
        //     $newPortalJoinUser->firstName = $request['firstName'];
        // if(isset($request['lastName']))
        //     $newPortalJoinUser->lastName = $request['lastName'];
        // if(isset($request['dob']))
        //     $newPortalJoinUser->dob = $request['dob'];
        // if(isset($request['sexualOrientation']))
        //     $newPortalJoinUser->sexualOrientation = $request['sexualOrientation'];
        // if(isset($request['sex']))
        //     $newPortalJoinUser->sex = $request['sex'];
        // if(isset($request['zipCode']))
        //     $newPortalJoinUser->zipCode = $request['zipCode'];
        // if(isset($request['civilStatus']))
        //     $newPortalJoinUser->civilStatus = $request['civilStatus'];
        // if(isset($request['height']))
        //     $newPortalJoinUser->height = $request['height'];
        // if(isset($request['weight']))
        //     $newPortalJoinUser->weight = $request['weight'];
        // if(isset($request['hairColor']))
        //     $newPortalJoinUser->hairColor = $request['hairColor'];
        // if(isset($request['eyeColor']))
        //     $newPortalJoinUser->eyeColor = $request['eyeColor'];
        // if(isset($request['searching']))
        //     $newPortalJoinUser->searching = json_encode($request['searching']);
        // if(isset($request['bodyType']))
        //     $newPortalJoinUser->bodyType = $request['bodyType'];
        // if(isset($request['tattoos']))
        //     $newPortalJoinUser->tattoos = $request['tattoos'];
        // if(isset($request['piercing']))
        //     $newPortalJoinUser->piercing = $request['piercing'];
        // if(isset($request['children']))
        //     $newPortalJoinUser->children = $request['children'];
        // if(isset($request['smoking']))
        //     $newPortalJoinUser->smoking = $request['smoking'];
        // if(isset($request['region_id']))
        //     $newPortalJoinUser->region_id = $request['region_id'];
        // if(isset($request['profile_detail']))
        //     $newPortalJoinUser->profile_detail = $request['profile_detail'];
        // if(isset($request['matchWords']))
        //     $newPortalJoinUser->matchWords = json_encode(explode(",",$request['matchWords']));
        // if(isset($request['nMatchWords']))
        //     $newPortalJoinUser->nMatchWords = json_encode(explode(",",$request['nMatchWords']));
        // $newPortalJoinUser->save();
        // if(isset($request['sex']))
        //     if ($request['sex'] == Sex::getValue('Par')) {
        //         $this->saveCoupleInfo($request,$newPortalJoinUser->id, Sex::getValue('Mand'));
        //         $this->saveCoupleInfo($request,$newPortalJoinUser->id, Sex::getValue('Kvinde'));
        //     }
            $sex = 'Mand';
        return view('frontEnd.signup.thirdStep');
        // return $newPortalJoinUser;
        dd($request);
        session()->put('userObj',array_merge(session('signup1'),session('signup2'),session('signup3'),$request->all()));
        return redirect('/signupplans');
    }

    public function FBPortalSelection(){
        $sex = Sex::getValue('Par');
        return view('frontEnd.signup.fbPortals',compact('sex'));
    }
    public function FBPortalSubmit(Request $request){
        $this->validate($request,[
            'portal_id' => ['required']
        ]);

        session()->put('fbSignup2',[
            'iAmSeekingA' => Portal::find($request->portal_id)->portalType
        ]);
        session()->put('userObj',array_merge(session('fbSignup1'),session('fbSignup2')));
        return redirect('/signupplans');
    }


    public function store(Request $request)
    {
        // check isAllPortal are available or not
        if(Portal::all()->count() == 0){
            foreach (IAmSeekingA::getValues() as $item) {
                Portal::create(['portalType' => $item]);
            }
        }
        // validate signup request data
        $this->validation($request);

        // check membership
        if($request->status == 'free'){
            return $this->registration($request);
        }elseif ($request->status == 'paid') {
            session(['userObj' => $request->all()]);
            return redirect('/signupplans');
        }


    }


    public function registration($request){

        DB::beginTransaction();
        $newUser = new User();

        $newUser->email = $request['email'];
        $newUser->password = $request['password'] = bcrypt($request['password']);
        if(isset($request['type']) && $request['type'] == "facebook")
            $newUser->email_verified_at = Carbon::now();
        if($newUser->save()){

            $portal = Portal::where('portalType', $request['iAmSeekingA'])->first();
            $membership = Membership::where('slug', 'free')->first();

            $newPortalJoinUser = $this->savePortalUser($request ,$portal, $membership, $newUser);

           if(isset($request['sex']))
               if ($request['sex'] == 'PAR' || $request['sex'] == 'Par' || $request['sex'] == 'par') {
                $this->saveCoupleInfo($request, $newPortalJoinUser->id, Sex::getValue('Mand'));
                $this->saveCoupleInfo($request, $newPortalJoinUser->id, Sex::getValue('Kvinde'));
                }

            $newUser['portalJoinUser_id'] = $newPortalJoinUser->id;
            $newUser->save();
            session()->forget('userObj');
            DB::commit();
            $newUser->notificationType = 6;
            $newUser->portal_id =  $portal->id;
            if(isset($sessionRequest['type']) && $sessionRequest['type'] == "facebook"){

            }else {
                $newUser->sendEmailVerificationNotification();
            }
            $newUser->notify(new TemplateEmail($newUser));
            if(isset($request['type']) && $request['type'] == "facebook"){
                Auth::login($newUser);
                return redirect('profile_edit')->with('successs', 'welcome');
            }
            return redirect('/')->with('successs', 'registrering succesfuld');


        }else {
            return redirect('/')->with('error', 'Invalid data');
        }

    }

    public function saveCoupleInfo($request, $portalJoinUser_id, $sex){

        $CoupleInfo = new CoupleInfo();

        $CoupleInfo->portalJoinUser_id = $portalJoinUser_id;
        $CoupleInfo->sex = $sex;
        $CoupleInfo->firstName = $request['firstName'];
        $CoupleInfo->lastName = $request['lastName'];
        $CoupleInfo->dob = $request['dob'];
        $CoupleInfo->sexualOrientation = $request['sexualOrientation'];
        $CoupleInfo->civilStatus = $request['civilStatus'];
        $CoupleInfo->height = $request['height'];
        $CoupleInfo->weight = $request['weight'];
        $CoupleInfo->hairColor = $request['hairColor'];
        $CoupleInfo->eyeColor = $request['eyeColor'];
        $CoupleInfo->searching = json_encode($request['searching']);
        $CoupleInfo->bodyType = $request['bodyType'];
        $CoupleInfo->tattoos = $request['tattoos'];
        $CoupleInfo->piercing = $request['piercing'];
        $CoupleInfo->children = $request['children'];
        $CoupleInfo->smoking = $request['smoking'];
        $CoupleInfo->save();

    }

    protected function validation($request)
    {
        return $this->validate($request, [

            'username' => ['required', 'max:255', 'unique:portal_join_users'],
            'firstName' => ['required'],
            'lastName' => ['required'],
            'dob' => ['required','date','before_or_equal:'.\Carbon\Carbon::now()->subYears(18)->format('Y-m-d')],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
            'iAmSeekingA' => ['required'],
            'sexualOrientation' => ['required'],
            'sex' => ['required'],
            'zipCode' => ['required'],
            'civilStatus' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'hairColor' => ['required'],
            'eyeColor' => ['required'],
            'searching' =>[ 'required'],
            'bodyType' => ['required'],
            'tattoos' => ['required'],
            'piercing' => ['required'],
            'children' => ['required'],
            'smoking' => ['required'],
            'region_id' => ['required'],
            'status' => ['required'],
        ]);

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

    public function signupplans(){

        if(!session()->has('userObj')){
            return redirect('/');
        }
        $newUserObj =  session('userObj');
        $memberships = ['free','2week','md','ugo','weekend','day'];

        $plans = Membership::whereIn('slug', $memberships)->get();
        $portal = $newUserObj['iAmSeekingA'];
        return view('frontEnd.memberships.signup.signupPlans', compact('plans','portal','newUserObj'));
    }

    public function showplan(Membership $plan, Request $request){
        if($plan->stripe_plan == "free"){

            $newUserObj =  session('userObj');
            return  $this->registration($newUserObj);
        }
        return view('frontEnd.memberships.signup.signupPlanShow', compact('plan'));
    }

    public function newMemberCreate(Request $request, Membership $plan)
    {
        $plan = Membership::findOrFail($request->get('plan'));
        $contents = (function($item) {
            return ($plan->slug.', ')+1;
        });
        if (! session()->has('coupon') || $plan->slug == "2week") {
          return  $this->newMemberCreateWithoutCoupon($request,$plan);
        }else {
            if(session()->get('coupon')['name'] == "TG2019" || session()->get('coupon')['name'] == "FL2019" || session()->get('coupon')['name'] == "DPFB"
            || session()->get('coupon')['name'] == "DPIG" || session()->get('coupon')['name'] == "DPLOVE" || session()->get('coupon')['name'] == "DPMIX"
            || session()->get('coupon')['name'] == "DPSINGLE" || session()->get('coupon')['name'] == "promo"){
                if($plan->stripe_plan != "monthly")
                    return  $this->newMemberCreateWithoutCoupon($request,$plan);
            }
            DB::beginTransaction();
            $sessionRequest = session('userObj');
            $newUser = new User();
            $newUser->email = $sessionRequest['email'];
            $newUser->password = bcrypt($sessionRequest['password']);

            $portal = Portal::where('portalType', $sessionRequest['iAmSeekingA'])->first();
             if($newUser
            ->newSubscription($portal->id, $plan->stripe_plan)
            ->withCoupon(session()->get('coupon')['name'])
            ->create($request->stripeToken)){
                    if(isset($sessionRequest['type']) && $sessionRequest['type'] == "facebook")
                        $newUser->email_verified_at = Carbon::now();
                    $newUser->save();

                    $newPortalUser = $this->savePortalUser($sessionRequest ,$portal,$plan,$newUser);

                    $newUser['portalJoinUser_id'] = $newPortalUser->id;
                    $newUser->save();
                    $promocode = PromoCode::where('promoCode', session()->get('coupon')['name'])->first();
                    if($promocode && $promocode->isOneTimeUse){
                        $promocode->isUsed = 1;
                        $promocode->save();
                        session()->forget('coupon');
                    }

                    $newUser->notificationType = 6;
                    $newUser->portal_id =  $portal->id;
                    if(isset($sessionRequest['type']) && $sessionRequest['type'] == "facebook"){

                    }else {
                        $newUser->sendEmailVerificationNotification();
                    }
                    $newUser->notify(new TemplateEmail($newUser));
                    DB::commit();
                    if(isset($sessionRequest['type']) && $sessionRequest['type'] == "facebook"){
                        Auth::login($newUser);
                        session()->forget('coupon');
                        return redirect('profile_edit')->with('successs', 'welcome');
                    }
                    session()->forget('coupon');
                    return redirect('/')->with('successs', 'Your registration and plan subscribed successfully');
                }else {
                    User::onlyTrashed()
                    ->where('id', $user->id)
                    ->get();
                    return redirect('/')->with('error', 'Invalid request');
                }
        }

    }
    public function newMemberCreateWithoutCoupon(Request $request, Membership $plan)
    {
        DB::beginTransaction();
        $plan = Membership::findOrFail($request->get('plan'));
        $sessionRequest = session('userObj');
        $newUser = new User();
        $newUser->email = $sessionRequest['email'];
        $newUser->password = bcrypt($sessionRequest['password']);

        $portal = Portal::where('portalType', $sessionRequest['iAmSeekingA'])->first();
        if($newUser
            ->newSubscription($portal->id, $plan->stripe_plan)
            ->create($request->stripeToken)){

                $newPortalUser = $this->savePortalUser($sessionRequest ,$portal, $plan, $newUser);

                $newUser['portalJoinUser_id'] = $newPortalUser->id;
                if(isset($sessionRequest['type']) && $sessionRequest['type'] == "facebook")
                    $newUser->email_verified_at = Carbon::now();
                $newUser->save();
                $newUser->notificationType = 6;
                $newUser->portal_id =  $portal->id;
                if(isset($sessionRequest['type']) && $sessionRequest['type'] == "facebook"){

                }else {
                    $newUser->sendEmailVerificationNotification();
                }
                $newUser->notify(new TemplateEmail($newUser));
                DB::commit();
                if(isset($sessionRequest['type']) && $sessionRequest['type'] == "facebook"){
                    Auth::login($newUser);
                    return redirect('profile_edit')->with('successs', 'welcome');
                }
                return redirect('/')->with('successs', 'Your registration and plan subscribed successfully');
            }else {
                User::onlyTrashed()
                ->where('id', $user->id)
                ->get();
                return redirect('/')->with('error', 'Invalid request');
            }

    }

    public function savePortalUser($request,$portal,$membership,$newUser){

        $newPortalJoinUser = new PortalJoinUser();

        if(isset($request['profilePicture']))
            $newPortalJoinUser->profilePicture = $request['profilePicture'];
        if(isset($request['username']))
            $newPortalJoinUser->username = $request['username'];
        $newPortalJoinUser->user_id = $newUser->id;
        $newPortalJoinUser->portal_id = $portal->id;
        $newPortalJoinUser->membership_id = $membership->id;
        $newPortalJoinUser->membership_ends_at = (new \DateTime())->modify('+'.$membership->duration);
        if(isset($request['firstName']))
            $newPortalJoinUser->firstName = $request['firstName'];
        if(isset($request['lastName']))
            $newPortalJoinUser->lastName = $request['lastName'];
        if(isset($request['dob']))
            $newPortalJoinUser->dob = $request['dob'];
        if(isset($request['sexualOrientation']))
            $newPortalJoinUser->sexualOrientation = $request['sexualOrientation'];
        if(isset($request['sex']))
            $newPortalJoinUser->sex = $request['sex'];
        if(isset($request['zipCode']))
            $newPortalJoinUser->zipCode = $request['zipCode'];
        if(isset($request['civilStatus']))
            $newPortalJoinUser->civilStatus = $request['civilStatus'];
        if(isset($request['height']))
            $newPortalJoinUser->height = $request['height'];
        if(isset($request['weight']))
            $newPortalJoinUser->weight = $request['weight'];
        if(isset($request['hairColor']))
            $newPortalJoinUser->hairColor = $request['hairColor'];
        if(isset($request['eyeColor']))
            $newPortalJoinUser->eyeColor = $request['eyeColor'];
        if(isset($request['searching']))
            $newPortalJoinUser->searching = json_encode($request['searching']);
        if(isset($request['bodyType']))
            $newPortalJoinUser->bodyType = $request['bodyType'];
        if(isset($request['tattoos']))
            $newPortalJoinUser->tattoos = $request['tattoos'];
        if(isset($request['piercing']))
            $newPortalJoinUser->piercing = $request['piercing'];
        if(isset($request['children']))
            $newPortalJoinUser->children = $request['children'];
        if(isset($request['smoking']))
            $newPortalJoinUser->smoking = $request['smoking'];
        if(isset($request['region_id']))
            $newPortalJoinUser->region_id = $request['region_id'];
        if(isset($request['profile_detail']))
            $newPortalJoinUser->profile_detail = $request['profile_detail'];
        if(isset($request['matchWords']))
            $newPortalJoinUser->matchWords = json_encode(explode(",",$request['matchWords']));
        if(isset($request['nMatchWords']))
            $newPortalJoinUser->nMatchWords = json_encode(explode(",",$request['nMatchWords']));
        $newPortalJoinUser->save();
        if(isset($request['sex']))
            if ($request['sex'] == Sex::getValue('Par')) {
                $this->saveCoupleInfo($request,$newPortalJoinUser->id, Sex::getValue('Mand'));
                $this->saveCoupleInfo($request,$newPortalJoinUser->id, Sex::getValue('Kvinde'));
            }

        return $newPortalJoinUser;
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
        return redirect('/home');
    }
    public function updateProfile(Request $request, $id)
    {
        //
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
             session()->put('coupon',[
                'name' => $coupon->promoCode,
                'mddiscount' => $coupon->discount(Membership::where('slug','md')->first()->cost, $coupon->isFixed),
                'ugodiscount' => 0,
                'weekenddiscount' => 0,
                'daydiscount' => 0,
                // 'kvartaldiscount' => 0,
                // 'arllgdiscount' => 0,
                // 'ardiscount' => 0,
                '2weekdiscount' => 0,
            ]);

        }else {
            session()->put('coupon',[
                'name' => $coupon->promoCode,
                'mddiscount' => $coupon->discount(Membership::where('slug','md')->first()->cost, $coupon->isFixed),
                'ugodiscount' => $coupon->discount(Membership::where('slug','ugo')->first()->cost,$coupon->isFixed),
                'weekenddiscount' => $coupon->discount(Membership::where('slug','weekend')->first()->cost,$coupon->isFixed),
                'daydiscount' => $coupon->discount(Membership::where('slug','day')->first()->cost,$coupon->isFixed),
                // 'kvartaldiscount' => $coupon->discount(Membership::where('slug','kvartal')->first()->cost,$coupon->isFixed),
                // 'arllgdiscount' => $coupon->discount(Membership::where('slug','arllg')->first()->cost,$coupon->isFixed),
                // 'ardiscount' => $coupon->discount(Membership::where('slug','ar')->first()->cost,$coupon->isFixed),
                '2weekdiscount' => 0,
            ]);
        }

        return redirect()->back()->with('successs', 'Coupon has been applied!');
    }
    public function promoCodeDestroy(){
        session()->forget('coupon');

        return back()->with('successs', 'Coupon has been removed.');
    }

    public function portalPrices(){
        $plans = Membership::whereNotIn('slug', ['profilepromotion','status','chat'])->get();
        return view('frontEnd.memberships.prices.portalPrices', compact('plans'));
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
