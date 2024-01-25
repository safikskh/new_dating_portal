<?php

namespace App\Http\Controllers\frontEnd;

use DateTime;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Membership $plan)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        // if($request->user()->subscribedToPlan($plan->stripe_plan, auth()->user()->portalInfo->portal_id)) {
        //     return redirect()->route('home')->with('successs', 'You have already subscribed the plan');
        // }
        $plan = Membership::findOrFail($request->get('plan'));  
        if($request->user()
            ->newSubscription(auth()->user()->portalInfo->portal_id, $plan->stripe_plan)
            ->create($request->stripeToken)){
                $portalJoinUser = PortalJoinUser::where([
                                    ['user_id', Auth::id()],
                                    ['portal_id', auth()->user()->portalInfo->portal_id]
                                    ])->first();

                    $portalJoinUser->membership_id =  $plan->id;
                    $portalJoinUser->membership_ends_at =  (new \DateTime())->modify('+'.$plan->duration);
                    $portalJoinUser->save();

         
            }
        
        return redirect()->route('home')->with('successs', 'Your plan subscribed successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newMemberCreate(Request $request)
    {
        //
    }
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
        //
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
