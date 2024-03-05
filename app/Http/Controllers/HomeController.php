<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use File;
use App\UserChat;
use Carbon\Carbon;
use App\Models\Block;
use App\Models\Blogs;
use App\Models\Events;
use App\Models\Groups;
use App\Models\Portal;
use App\Models\Region;
use App\Models\Status;
use App\Models\Favourite;
use App\Models\CoupleInfo;
use App\Models\FileUpload;
use App\Models\Membership;
use App\Models\BlogComments;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\GroupJoinUser;
use App\Models\PortalJoinUser;
use App\Models\VisitedProfile;
use App\Models\UserPromotation;
use App\Enums\SexualOrientation;
use App\Models\ChatRoomJoinUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        
        $announcements = Announcement::where('portal_id',auth()->user()->portalInfo->portal_id)
        ->orderBy('updated_at', 'DESC')->limit(4)->get();
        
        
        $visitedProfiles = VisitedProfile::where('user_id',auth()->id())
        ->where('portal_id', auth()->user()->portalInfo->portal_id)
        ->whereNotIn('visited_id', auth()->user()->deactivateUserList())
        ->whereNotIn('visited_id', auth()->user()->getBlockUserListByAuth())
        ->orderBy('id','DESC')
        ->groupBy('visited_id')
        ->limit(9)->get();
        
        $latestProfiles = User::where([['id', '!=', Auth::id()]])
        ->whereIn('id', auth()->user()->getAllPortalUserByAuth())
        ->whereNotIn('id', auth()->user()->getBlockUserListByAuth())
        ->whereNotIn('id', auth()->user()->deactivateUserList())
        ->orderBy('created_at', 'DESC')->limit(9)->get();

        $arr = array();
        foreach ($latestProfiles as $key => $profiles) {
            $row = $profiles->id;
            array_push($arr,$row);
        }
        
       
        $favourities = Favourite::with('userFavourite')
            ->orderBy('id', 'DESC')
            ->where('favourite_by', Auth::id())
            ->where('portal_id', auth()->user()->portalInfo->portal_id)
            ->whereNotIn('favourite_to', auth()->user()->deactivateUserList())
            ->whereNotIn('favourite_to', auth()->user()->getBlockUserListByAuth())
            ->where('favourite_status', 0)
            ->limit(9)->get();

        $latestGroup = Groups::where('type', auth()->user()->portalInfo->portal_id)
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->orderBy('id','DESC')->limit(5)->get();

        $latestBlogs = Blogs::where('type', auth()->user()->portalInfo->portal_id)
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->orderBy('id','DESC')->limit(5)->get();


        $latestEvent = Events::where('type', auth()->user()->portalInfo->portal_id)
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->orderBy('id','DESC')->limit(5)->get();

        $statuses = Status::where([['status_ends_at', '>' ,Carbon::now()],['portal_id', auth()->user()->portalInfo->portal_id]])
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->inRandomOrder()->limit(5)->get();

        $userProfileCheck = PortalJoinUser::where('user_id', auth()->user()->id)->first();
        $isProfileComplete = $userProfileCheck['isProfileComplete'];
        session()->put('isProfileComplete',$isProfileComplete);

        // dd($isProfileComplete);
        // For Test
        // $latestBlogs = Blogs::orderBy('id','DESC')->limit(1)->get();
        // $latestEvent = Events::orderBy('id','DESC')->limit(1)->get();
        // $statuses = Status::where('portal_id', auth()->user()->portalInfo->portal_id)
        //     ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
        //     ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        //     ->inRandomOrder()->limit(4)->get();
        return view(
            'dashlead.dashboard',
            compact('statuses','favourities','latestProfiles','visitedProfiles','latestGroup','announcements','latestBlogs','latestEvent'));

    }

    public function announcementList(){
        $announcements = Announcement::where('portal_id',auth()->user()->portalInfo->portal_id)->paginate(9);
        return view('frontEnd.announcements', compact('announcements'));
    }

    public function postList(){
        // $posts = Announcement::where('portal_id',auth()->user()->portalInfo->portal_id)->paginate(9);

        $posts = Status::where([['status_ends_at', '>' ,Carbon::now()],['portal_id', auth()->user()->portalInfo->portal_id]])
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->inRandomOrder()->paginate(9);

        return view('frontEnd.posts', compact('posts'));
    }


    public function users()
    {
        return User::all();
    }

    public function blockError()
    {
        return view(
            'error.urserBlockError');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("successs","Password changed successfully !");
    }
}
