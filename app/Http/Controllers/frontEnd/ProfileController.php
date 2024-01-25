<?php

namespace App\Http\Controllers\frontEnd;

use App\User;
use App\Admin;
use App\Enums\Sex;
use Carbon\Carbon;
use App\Models\Block;
use App\Models\Portal;
use App\Models\Rating;
use App\Models\Region;
use App\Models\Favourite;
use App\Models\CoupleInfo;
use App\Models\UserReport;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use App\Models\VisitedProfile;
use App\Models\UserPromotation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\TemplateEmail;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RepliedToThread;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getTargetUserProfileActivationStatus($userId)
    {
        return PortalJoinUser::where(
            [
                ['user_id', $userId],
                ['portal_id', auth()->user()->getPortal(auth()->user()->portalJoinUser_id)]
            ]
        );
    }

    public function index(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $userID = Auth::user()->id;
        $singleProfileID = $request->user_id;
        if(isset($request->user_id)){
            $portal = $this->getTargetUserProfileActivationStatus($singleProfileID);

            if(!(User::where('id',$singleProfileID)->exists()) || $portal->first()->profile_disable){
                return redirect()->back();
            }
        }


        $blockCheckBy = Block::where('block_by', $singleProfileID)
                ->where('block_to', Auth::id())
                ->where('portal_id', auth()->user()->portalInfo->portal_id)
                ->where('block_status', 0)
                ->first();

        $blockCheckTo = Block::where('block_by', Auth::id())
                ->where('block_to', $singleProfileID)
                ->where('portal_id', auth()->user()->portalInfo->portal_id)
                ->where('block_status', 0)
                ->first();

        if(isset($request->user_id)){
            if(auth()->user()->isDeactivateUser($request->user_id)
                || $this->getTargetUserProfileActivationStatus($request->user_id)->first()->profile_disable
            ) {
                return redirect('home');
            }
            $id = $request->user_id;
            $othersUser = User::find($request->user_id);
            $othersUser['age'] = Carbon::parse($othersUser['dob'])->age;
            $user = User::find(Auth::user()->id);
            $regionId =  $othersUser->region_id;
            if( $regionId == null){
                $oRegion = "";
            }else{
            $oRegion = Region::find($regionId);
            $oRegion= $oRegion->region_name;}
            if($id != Auth::user()->id){
              $model = new VisitedProfile();
              $model->user_id = $id;
              $model->visited_id = Auth::user()->id;
              $model->portal_id = auth()->user()->portalInfo->portal_id;
              $model->save();
            }
        }else{
            $id = Auth::user()->id;
            $user = User::find($id);
            $user['age'] = Carbon::parse($user['dob'])->age;
            $regionId =  $user->region_id;
            if( $regionId == null){
                $region = "";
            }else{
                $region = Auth::user()->regionName(Auth::user()->region_id);
            }
        }

        $checkFavourite = Favourite::where('favourite_by', $userID)
            ->where('favourite_to', $singleProfileID)
            ->whereNotIn('favourite_to', auth()->user()->disableUserList())
            ->where('portal_id', auth()->user()->portalInfo->portal_id)
            ->where('favourite_status', 0)
            ->first();

        $checkRatings = Rating::where([['to_user_id', $userID],['portal_id', auth()->user()->getCurrentPortalbyAuth()->id]])->first();
        if($checkRatings != null){
            $views = DB::table('ratings')
                ->where([['to_user_id', $userID],['portal_id', auth()->user()->getCurrentPortalbyAuth()->id]])
                ->select(DB::raw('count(DISTINCT from_user_id) as total'))
                ->groupBy('to_user_id')
                ->first();
            $viewers = $views->total;

            $ratingss = Rating::where([['to_user_id', $userID],['portal_id', auth()->user()->getCurrentPortalbyAuth()->id]])->average('rating_value');
            $ratings = round($ratingss, 1);
            $rate = $ratings;
        }else{
            $viewers = 0;
            $ratings = 0;
            $rate = 0;
        }

        $checkRating = Rating::where([['to_user_id', $singleProfileID],['portal_id', auth()->user()->getCurrentPortalbyAuth()->id]])->first();
        if($checkRating != null){
            $view = DB::table('ratings')
                ->where([['to_user_id', $singleProfileID],['portal_id', auth()->user()->getCurrentPortalbyAuth()->id]])
                ->select(DB::raw('count(DISTINCT from_user_id) as total'))
                ->groupBy('to_user_id')
                ->first();
            $viewer = $view->total;

            $ratings = Rating::where([['to_user_id', $singleProfileID],['portal_id', auth()->user()->getCurrentPortalbyAuth()->id]])->average('rating_value');
            $rating = round($ratings, 1);
        }else{
            $viewer = 0;
            $rating = 0;
        }
        if ($userID == $singleProfileID) {
            return view('dashlead.profile', compact('oRegion','userID','singleProfileID','checkFavourite', 'viewers', 'ratings', 'rate'));
        }else{
            if($request->user_id == null){
             return view('dashlead.profile', compact('region','userID','singleProfileID','checkFavourite', 'viewers', 'ratings', 'rate'));
            }else{
                if ($blockCheckBy != null || $blockCheckTo != null) {
                    return redirect()->route('blockError');
                }else{
                    return view('frontEnd.singleProfile', compact('othersUser','oRegion','userID','singleProfileID','checkFavourite', 'viewer', 'rating','ratings'));
                }

            }
        }
    }

    public function ratingProfile(Request $request){

        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $checkRating = Rating::where([['from_user_id', $request->from_user_id],['to_user_id', $request->to_user_id],['portal_id', auth()->user()->portalInfo->portal_id]])->first();

        if($checkRating == null) {
            $request['portal_id'] = auth()->user()->getCurrentPortalbyAuth()->id;
            $data1 = Rating::create($request->all());
            $notifyUser = User::find($request->to_user_id);
            $data1->notificationType = 3;
            $data1->isUserRating = 1;
            $data1->portal_id = auth::user()->portalInfo->portal_id;
            $data1->isDisablePushNotif = $notifyUser->portalInfo->isDisablePushNotif;
            $notifyUser->notify(new RepliedToThread($data1));
            return redirect()->back()->with('successs', 'You have given rating this profile!');
        }else{
            if($checkRating->updated_at <= Carbon::now()->subDays(14)){
                $checkRating->update($request->except('from_user_id','to_user_id','portal_id')+['rating_value' => $request->rating_value]);
                $notifyUser = User::find($request->to_user_id);
                $checkRating->notificationType = 3;
                $checkRating->isUserRating = 1;
                $checkRating->portal_id = auth::user()->portalInfo->portal_id;
                $checkRating->isDisablePushNotif = $notifyUser->portalInfo->isDisablePushNotif;
                $notifyUser->notify(new RepliedToThread($checkRating));
                return redirect()->back()->with('successs', 'You have given updated rating this profile!');
            }else {
                return redirect()->back();
            }
        }

    }

    public function userBlock(Request $request){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        if(auth()->user()->isPaid()){
        $checkBlock = Block::where([['block_by', $request->block_by],['portal_id',auth()->user()->portalInfo->portal_id]])
                    ->where('block_to', $request->block_to)->first();

        if($checkBlock == null) {
            if($request->block_to != null){
                $block = new Block();
                $block->block_by = $request->block_by;
                $block->block_to = $request->block_to;
                $block->portal_id = auth()->user()->portalInfo->portal_id;
                $block->save();
                return redirect()->route('blockList')->with('successs', 'This profile blocked by You!');
            }
        }else{
            $checkBlock->update($request->except('block_by','block_to','portal_id')+['block_status' => 0]);
            return redirect()->route('blockList')->with('successs', 'This profile again blocked by You!');
        }
        }else {
            return redirect()->back();
        }
    }

    public function blockList(){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $blockTo = Block::with('userblockto')
            ->where('block_by', auth()->id())
            ->where('portal_id', auth()->user()->portalInfo->portal_id)
            ->where('block_status', 0)
            ->whereNotIn('block_to', auth()->user()->deactivateUserList())
            ->whereNotIn('block_to', auth()->user()->disableUserList())
            ->get();

        return view('frontEnd.blockList',compact('blockTo'));
    }

    public function userBlockDelete(Request $request){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $blockDelete = Block::where('block_by', $request->block_by)
            ->where('block_to', $request->block_to)
            ->where('block_status', 0)
            ->first();
        $blockDelete->update($request->except('block_by','block_to')+['block_status' => $request->block_status]);
        return redirect()->back();
    }


    public function favouriteUser(Request $request){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
      $check = Favourite::where('favourite_by', $request->favourite_by)
            ->where('favourite_to', $request->favourite_to)
            ->where('favourite_status', 0)
            ->where('portal_id', auth()->user()->portalInfo->portal_id)
            ->first();
      if (empty($check)) {
        $request['portal_id'] = auth()->user()->portalInfo->portal_id;
        Favourite::create($request->all());
        return redirect()->back()->with('successs', 'This User Favourite by You!');
      }
      $check->delete();
      return redirect()->back()->with('successs', 'Remove form Favourite!');

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
        //
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
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $this->validate($request, [
            'profilePicture' => 'nullable|image',
            'username' => 'max:255',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|string|email|max:255',
            'dob' => 'required|date|before_or_equal:'.\Carbon\Carbon::now()->subYears(18)->format('Y-m-d'),
            ]);

            $user = User::find(auth()->id());
            $portalDetails = PortalJoinUser::find($user->portalJoinUser_id);
            if($portalDetails->username != $request->username){
                $this->validate($request, [
                    'username' => ['required', 'max:255', 'unique:portal_join_users'],
                ]);
                $portalDetails->username = $request['username'];
            }
            if($user->email != $request->email){
                $this->validate($request, [
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
                $user->email = $request['email'];
                $user->email_verified_at = null;
            }




            $region = Region::where('region_name', $request['region'])->first();
            $request['region_id'] = $region->id;

            $portalDetails->matchWords = json_encode(explode(",",$request['matchWords']));
            $portalDetails->nMatchWords = json_encode(explode(",",$request['nMatchWords']));
            $portalDetails->region_id = $request['region_id'];
            $portalDetails->zipCode = $request['zipCode'];
            $portalDetails->profile_detail = $request['profile_detail'];

            if ($portalDetails->sex == Sex::getValue('Par')) {
                $this->saveCoupleInfo($request,$portalDetails->id,$request['sex']);
            } else {
                if ($request['sex'] == Sex::getValue('Par')) {
                    // return $portalDetails->id;
                    $portalDetails->sex = $request['sex'];
                    if($file = $request->file('profilePicture')){
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $portalDetails->profilePicture = $file->move('uploads/profilePictures', $name );
                    }
                    $portalDetails->firstName = $request['firstName'];
                    $portalDetails->lastName = $request['lastName'];
                    $portalDetails->lastName = $request['lastName'];
                    $portalDetails->dob = $request['dob'];
                    $portalDetails->sexualOrientation = $request['sexualOrientation'];
                    $portalDetails->sex = $request['sex'];
                    $portalDetails->civilStatus = $request['civilStatus'];
                    $portalDetails->height = $request['height'];
                    $portalDetails->weight = $request['weight'];
                    $portalDetails->hairColor = $request['hairColor'];
                    $portalDetails->eyeColor = $request['eyeColor'];
                    $portalDetails->searching = json_encode($request['searching']);
                    $portalDetails->bodyType = $request['bodyType'];
                    $portalDetails->tattoos = $request['tattoos'];
                    $portalDetails->piercing = $request['piercing'];
                    $portalDetails->children = $request['children'];
                    $portalDetails->smoking = $request['smoking'];
                    // $portalDetails->profile_detail = $request['profile_detail'];
                    $this->createCoupleInfo($request,$portalDetails,Sex::getValue('Mand'));
                    $this->createCoupleInfo($request,$portalDetails,Sex::getValue('Kvinde'));
                }else{

                    if($file = $request->file('profilePicture')){
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $portalDetails->profilePicture = $file->move('uploads/profilePictures', $name );
                    // if($portalDetails->profilePicture != "uploads/profilePictures/defaultPicture.png"){
                    //     Storage::disk('uploads')
                    //     ->delete($portalDetails->profilePicture);
                    // }
                    }
                    $portalDetails->firstName = $request['firstName'];
                    $portalDetails->lastName = $request['lastName'];
                    $portalDetails->lastName = $request['lastName'];
                    $portalDetails->dob = $request['dob'];
                    $portalDetails->sexualOrientation = $request['sexualOrientation'];
                    $portalDetails->sex = $request['sex'];
                    $portalDetails->civilStatus = $request['civilStatus'];
                    $portalDetails->height = $request['height'];
                    $portalDetails->weight = $request['weight'];
                    $portalDetails->hairColor = $request['hairColor'];
                    $portalDetails->eyeColor = $request['eyeColor'];
                    $portalDetails->searching = json_encode($request['searching']);
                    $portalDetails->bodyType = $request['bodyType'];
                    $portalDetails->tattoos = $request['tattoos'];
                    $portalDetails->piercing = $request['piercing'];
                    $portalDetails->children = $request['children'];
                    $portalDetails->smoking = $request['smoking'];
                    $portalDetails->isProfileComplete = 1;
                    // $portalDetails->profile_detail = $request['profile_detail'];
                }

            }


            DB::beginTransaction();
            try {
              if ($portalDetails->save() &&  $user->save()) {
                DB::commit();
                session()->put('isProfileComplete',1);
                return redirect()->route('profile.index')->with('successs', 'Profile updated.');
              }else{
                DB::rollback();
                return redirect()->back()->with('error',$e->getMessage());
              }
          }catch (\Exception $e) {
              DB::rollback();
              return redirect()->back()->with('error',$e->getMessage());
          }



            // return redirect()->back()->with('successs', 'Profile updated.');
    }

    public function saveCoupleInfo($request,$portalJoinUser_id,$sex){
        $coupleInfo = CoupleInfo::find($request['coupleId']);
        $coupleInfo->firstName = $request['firstName'];
        $coupleInfo->lastName = $request['lastName'];
        $coupleInfo->lastName = $request['lastName'];
        $coupleInfo->dob = $request['dob'];
        $coupleInfo->sexualOrientation = $request['sexualOrientation'];
        $coupleInfo->sex = $sex;
        $coupleInfo->civilStatus = $request['civilStatus'];
        $coupleInfo->height = $request['height'];
        $coupleInfo->weight = $request['weight'];
        $coupleInfo->hairColor = $request['hairColor'];
        $coupleInfo->eyeColor = $request['eyeColor'];
        $coupleInfo->searching = json_encode($request['searching']);
        $coupleInfo->bodyType = $request['bodyType'];
        $coupleInfo->tattoos = $request['tattoos'];
        $coupleInfo->piercing = $request['piercing'];
        $coupleInfo->children = $request['children'];
        $coupleInfo->smoking = $request['smoking'];
        if($file = $request->file('profilePicture')){
            $name = time().'.'.$file->getClientOriginalExtension();
            $coupleInfo->profilePicture = $file->move('uploads/profilePictures', $name );
            // if($portalDetails->profilePicture != "uploads/profilePictures/defaultPicture.png"){
            //     Storage::disk('uploads')
            //     ->delete($portalDetails->profilePicture);
            // }
        }
        $coupleInfo->save();
    }
    public function createCoupleInfo($request,$portalJoinUser,$sex){

        $coupleInfo = new CoupleInfo();
        $coupleInfo->portalJoinUser_id = $portalJoinUser->id;
        $coupleInfo->sex = Sex::getValue($sex);
        $coupleInfo->firstName = $request['firstName'];
        $coupleInfo->lastName = $request['lastName'];
        $coupleInfo->lastName = $request['lastName'];
        $coupleInfo->dob = $request['dob'];
        $coupleInfo->sexualOrientation = $request['sexualOrientation'];
        $coupleInfo->civilStatus = $request['civilStatus'];
        $coupleInfo->height = $request['height'];
        $coupleInfo->weight = $request['weight'];
        $coupleInfo->hairColor = $request['hairColor'];
        $coupleInfo->eyeColor = $request['eyeColor'];
        $coupleInfo->searching = json_encode($request['searching']);
        $coupleInfo->bodyType = $request['bodyType'];
        $coupleInfo->tattoos = $request['tattoos'];
        $coupleInfo->piercing = $request['piercing'];
        $coupleInfo->children = $request['children'];
        $coupleInfo->smoking = $request['smoking'];
        $coupleInfo->profilePicture = $portalJoinUser->profilePicture;
        $coupleInfo->save();
    }

    public function profileDescription(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $portalJoinUser = PortalJoinUser::where([['user_id', Auth::id()],['portal_id', auth()->user()->portalInfo->portal_id]])->first();
        // $user =  User::find(Auth::user()->id);
        $portalJoinUser->profile_detail = $request->profileDetails;
        $portalJoinUser->save();
    }

    public function profileReport(Request $request){

        //create new instance of UserReport class
        $userReport = new UserReport();

        //check if image exist
        if($request->hasFile('files')){
            $images = $request->file('files');

            // loop through each image to save and upload
            foreach($images as $key => $image){
                $name = time().$image->getClientOriginalName();
                $image->move('uploads/userReport', $name );
                $data[] = 'uploads/userReport/' . $name;
            }
        }

        $userReport->fron_user_id = auth()->id();
        $userReport->to_user_id = $request->to_user_id;
        $userReport->title = $request->title;
        $userReport->details = $request->details;
        $userReport->files = json_encode($data);
        $userReport->save();
        $notifyThread = UserReport::find($userReport->id);
        $notifyThread->notificationType = 4;
        $notifyUser = Admin::find(2);
        if(!$notifyUser->portalInfo->isDisableEmailNotif){
            $notifyUser->notify(new TemplateEmail($notifyThread));
        }
        return redirect()->back();
    }

    public function profileEditShow(){
        return view('frontEnd.profileEdit');
    }

    public function visitedAll(){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        if (!auth()->user()->isPaid()) {
            return redirect()->back();
        }


        // $visitedList = VisitedProfile::where('user_id',auth()->id())
        //     ->where('portal_id', auth()->user()->portalInfo->portal_id)
        //     ->whereNotIn('visited_id', auth()->user()->deactivateUserList())
        //     ->whereNotIn('visited_id', auth()->user()->getBlockUserListByAuth())
        //     ->orderBy('created_at','DESC')
        //     //->groupBy('visited_id')
        //     ->get();

        $visitedList = VisitedProfile::where('user_id',auth()->id())
                ->where('portal_id', auth()->user()->portalInfo->portal_id)
                 ->whereNotIn('visited_id', auth()->user()->deactivateUserList())
                 ->whereNotIn('visited_id', auth()->user()->getBlockUserListByAuth())
                ->select('*')
                ->whereIn('id', function($q){
                    $q->select(DB::raw('MAX(id) FROM visited_profiles GROUP BY visited_id'));
                })
                ->get();

        return view('frontEnd.visitedAll', compact('visitedList'));
    }
    public function favoriteAll(){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        if (!auth()->user()->isPaid()) {
            return redirect()->back();
        }
       $favouritieList = Favourite::with('userFavourite')
            ->orderBy('id', 'DESC')
            ->where('favourite_by', Auth::id())
            ->where('portal_id', auth()->user()->portalInfo->portal_id)
            ->whereNotIn('favourite_to', auth()->user()->deactivateUserList())
            ->whereNotIn('favourite_to', auth()->user()->getBlockUserListByAuth())
            ->where('favourite_status', 0)
            ->get();
        return view('frontEnd.favoriteAll',compact('favouritieList'));
    }
    public function latestAll(){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        if (!auth()->user()->isPaid()) {
            return redirect()->back();
        }
        $latestList = User::where([['id', '!=', Auth::id()]])
            ->whereIn('id', auth()->user()->getAllPortalUserByAuth())
            ->whereNotIn('id', auth()->user()->getBlockUserListByAuth())
            ->whereNotIn('id', auth()->user()->deactivateUserList())
            ->orderBy('created_at', 'DESC')->limit(30)->get();
        return view('frontEnd.latestAll',compact('latestList'));
    }


}
