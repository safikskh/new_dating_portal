<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Requests\StatusReportRequest;
use App\Models\StatusReport;
use DateTime;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $plans = Membership::where([['slug', 'status']])->get();
        return view('frontEnd.memberships.status.index', compact('plans'));
    }

    public function statusList(){
         $statusList = Status::where([['portal_id', auth()->user()->portalInfo->portal_id]
        ,['status_ends_at', '>' ,Carbon::now()]])
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
        ->get();
        return view('frontEnd.statuses', compact('statusList'));
    }

    /**
     * Report the specified status.
     *
     * @param $id
     * @param StatusReportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function report($id, StatusReportRequest $request)
    {
        $existingReport = StatusReport::where('user_id', auth()->user()->id)
            ->where('status_id', $id);

        if ($existingReport->count() > 0) {
            return redirect()->back()->with('error', 'You have already reported this status');
        }

        StatusReport::create([
            'user_id' => auth()->user()->id,
            'status_id' => $id,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'We have got your request. Thank you');
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
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $portalUser = PortalJoinUser::find(Auth::user()->portalJoinUser_id);
            // validate request
            $this->validation($request);
            //if first post free then enable
                // if(Status::where('user_id', auth()->id())->count() == 0){
                //     $plan = Membership::where('slug', 'status')->first(); 
                //     $status = new Status();
                //     $status->user_id = auth()->id();
                //     $status->portal_id = auth()->user()->portalInfo->portal_id;
                //     $status->title = $request->title;
                //     $status->details = $request->details;
                //     $status->status_ends_at = (new \DateTime())->modify('+'.$plan->duration);
                //     $status->save();
                //     return redirect('/home')->with('successs', 'Status submitted.');
                // }
            session(['statusObj' => $request->all()]);
            return redirect()->route('status.index');    
    }

    protected function validation($request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        return $this->validate($request, [
            
            'title' => ['required'],
            'details' => ['required', 'max:250'],       
            
        ]);
 
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    
    public function statusplan(Membership $plan, Request $request)
    {

        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        return view('frontEnd.memberships.status.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $plan)
    {

        
        
       
}
public function statusplancreate (Request $request, Membership $plan){
        
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $plan = Membership::findOrFail($request->get('plan'));  
        $newStatus = session('statusObj');
            if($request->user()
                ->newSubscription(auth()->user()->portalInfo->portal_id, $plan->stripe_plan)
                ->create($request->stripeToken)){
                    if (auth()->user()->subscription((string)auth()->user()->portalInfo->portal_id)->cancel()) {
                        $status = new Status();
                        $status->user_id = auth()->id();
                        $status->portal_id = auth()->user()->portalInfo->portal_id;
                        $status->title = $newStatus['title'];
                        $status->details = $newStatus['details'];
                        $status->status_ends_at = (new \DateTime())->modify('+'.$plan->duration);
                        
                        $status->save();
                        return redirect('/home')->with('successs', 'Status submitted.');
                    }
                }

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
    }
}
