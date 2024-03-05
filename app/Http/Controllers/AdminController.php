<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Collection;



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
use App\Models\GroupJoinUser;
use App\Models\PortalJoinUser;
use App\Models\VisitedProfile;
use App\Models\UserPromotation;
use App\Enums\SexualOrientation;
use App\Models\ChatRoomJoinUser;
use App\Models\Backend\Announcement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentdate = Carbon::now();

        $latest_paid_user = DB::table('users')
        ->join('portal_join_users', 'users.portalJoinUser_id', '=', 'portal_join_users.id')
        ->where('portal_join_users.membership_id', '!=', '1')
        ->where('portal_join_users.membership_ends_at', '>', $currentdate)
        ->orderByDesc('portal_join_users.id')
        ->select('users.email AS email', 'portal_join_users.profilePicture AS image', 'portal_join_users.firstName AS firstname', 'portal_join_users.lastName AS lastname', 'portal_join_users.created_at AS join_date', 'portal_join_users.membership_ends_at AS membership_ends')
        ->limit(10)
        ->get();

        $latest_unpaid_user = DB::table('users')
        ->join('portal_join_users', 'users.portalJoinUser_id', '=', 'portal_join_users.id')
        ->where('portal_join_users.membership_id', '=', '1')
        ->orderByDesc('portal_join_users.id')
        ->select('users.email AS email', 'portal_join_users.profilePicture AS image', 'portal_join_users.firstName AS firstname', 'portal_join_users.lastName AS lastname', 'portal_join_users.created_at AS join_date', 'portal_join_users.membership_ends_at AS membership_ends')
        ->limit(10)
        ->get();

        $expire_soon_user = DB::table('users')
        ->join('portal_join_users', 'users.portalJoinUser_id', '=', 'portal_join_users.id')
        ->join('memberships', 'portal_join_users.membership_id', '=', 'memberships.id')
        ->orderByDesc('portal_join_users.membership_ends_at')
        ->select('memberships.name AS membership_name', 'users.email AS email', 'portal_join_users.profilePicture AS image', 'portal_join_users.firstName AS firstname', 'portal_join_users.lastName AS lastname', 'portal_join_users.created_at AS join_date', 'portal_join_users.membership_ends_at AS membership_ends')
        ->limit(10)
        ->get();

        $subscriptions = DB::table('subscriptions')
        ->join('users', 'subscriptions.user_id', '=', 'users.id')
        ->join('portal_join_users', 'users.portalJoinUser_id', '=', 'portal_join_users.id')
        ->orderByDesc('subscriptions.updated_at')
        ->select('subscriptions.stripe_id AS stripe_id', 'subscriptions.name AS name', 'subscriptions.stripe_plan AS stripe_plan', 'subscriptions.quantity AS quantity','subscriptions.updated_at AS updated_at', 'portal_join_users.firstName AS firstname', 'portal_join_users.lastName AS lastname')
        ->limit(10)
        ->get();

        $active_user = DB::table('portal_join_users')
        ->where('isDeactivate', '=', '0')
        ->count();

        $deactive_user = DB::table('portal_join_users')
        ->where('isDeactivate', '!=', '0')
        ->count();

        $paid_user = DB::table('portal_join_users')
        ->where('isDeactivate', '=', '0')
        ->where('membership_id', '!=', '1')
        ->where('membership_ends_at', '>', $currentdate)
        ->count();

        $unpaid_user = DB::table('portal_join_users')
        ->where('isDeactivate', '=', '0')
        ->where('membership_id', '=', '1')
        ->count();

        $expire_user = DB::table('portal_join_users')
        ->where('isDeactivate', '=', '0')
        ->where('membership_id', '!=', '1')
        ->where('membership_ends_at', '<', $currentdate)
        ->count();

        $user_stat = array("active"=>$active_user, "paid"=>$paid_user, "unpaid"=>$expire_user+$unpaid_user, "deactive"=>$deactive_user);

        $monthly_income = DB::table('subscriptions')
        ->join('users', 'subscriptions.user_id', '=', 'users.id')
        ->join('portal_join_users', 'users.portalJoinUser_id', '=', 'portal_join_users.id')
        ->join('memberships', 'portal_join_users.membership_id', '=', 'memberships.id')
        // ->where('subscriptions.updated_at', '>=', Carbon::now()->startOfMonth())
        ->whereBetween('subscriptions.updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth(),])
        ->orderByDesc('subscriptions.updated_at')
        ->sum('memberships.cost');

        $yearly_income = DB::table('subscriptions')
        ->join('users', 'subscriptions.user_id', '=', 'users.id')
        ->join('portal_join_users', 'users.portalJoinUser_id', '=', 'portal_join_users.id')
        ->join('memberships', 'portal_join_users.membership_id', '=', 'memberships.id')
        // ->where('subscriptions.updated_at', '>=', Carbon::now()->startOfYear())
        ->whereBetween('subscriptions.updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear(),])
        ->orderByDesc('subscriptions.updated_at')
        ->sum('memberships.cost');

        $total_income = DB::table('subscriptions')
        ->join('users', 'subscriptions.user_id', '=', 'users.id')
        ->join('portal_join_users', 'users.portalJoinUser_id', '=', 'portal_join_users.id')
        ->join('memberships', 'portal_join_users.membership_id', '=', 'memberships.id')
        ->orderByDesc('subscriptions.updated_at')
        ->sum('memberships.cost');

        $income_stat = array("monthly"=>$monthly_income, "yearly"=>$yearly_income, "total"=>$total_income);

        return view('cbs.backend.dashboard', compact('latest_paid_user','latest_unpaid_user','expire_soon_user','subscriptions','user_stat','income_stat'));
    }

    public function incomechart()
    {
        $income_chart = DB::table('subscriptions')
        ->join('users', 'subscriptions.user_id', '=', 'users.id')
        ->join('portal_join_users', 'users.portalJoinUser_id', '=', 'portal_join_users.id')
        ->join('memberships', 'portal_join_users.membership_id', '=', 'memberships.id')
        ->whereBetween('subscriptions.updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear(),])
        ->groupby('month')
        ->orderBy('subscriptions.updated_at', 'ASC')
        ->get([
            DB::raw('DATE_FORMAT(subscriptions.updated_at, "%b-%y") as month'),
            // DB::raw('DATE_FORMAT(subscriptions.updated_at, "%b") as month'),
            DB::raw('year(subscriptions.updated_at) year'),
            DB::raw('sum(memberships.cost) as income')
        ]);

        return response()->json($income_chart);
    }

    public function settings()
    {
        $data = DB::table('settings')->first();
        return view('cbs.backend.settings')->with('data', $data);

    }

    public function settings_update(Request $request)

        {

            $this->validate($request,[
                'maintenance_status' => 'required',
                // 'maintenance_date' => 'required',
            ]);


            DB::table('settings')
                ->update(['maintenance_status' => $request->maintenance_status , 'maintenance_date' => $request->maintenance_date]);

            return redirect()->back();
        }

}
