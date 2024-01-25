<?php

namespace App\Http\Controllers\frontEnd;

use App\Models\AdvanceSearch;
use App\User;
use Carbon\Carbon;
use App\Enums\CivilStatus;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search_null(){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $newMatchUserList = PortalJoinUser::where('id', '0')->get();

        return view('frontEnd.search')->with('newMatchUserList', $newMatchUserList);
        
    }

    public function search(Request $request){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $query = PortalJoinUser::query()->where([['user_id', '!=', auth()->id()],['portal_id',auth()->user()->portalInfo->portal_id]])
                                        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
                                        ->whereNotIn('user_id', auth()->user()->disableUserList())
                                        ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth());

        if((!empty($request->fromAge)) && (!empty($request->toAge)))
        {
            $minDate = Carbon::today()->subYears($request->toAge+1);
            $maxDate = Carbon::today()->subYears($request->fromAge)->endOfDay();

            if(!empty($request->gender))
                {
                    if($request->gender == 'Par')
                    {
                        $query->whereHas('coupleInfos', function($q) use($minDate, $maxDate)
                                {
                                    $q->whereBetween('dob', [$minDate, $maxDate]);
                                });    
                    }
                else
                    {
                        $query->whereBetween('dob', [$minDate, $maxDate]);
                    }
                }
        }

        if(!empty($request->gender))
        {
            $query->where('sex', $request->gender);
        }

        if(!empty($request->location))
        {
            $query->where('region_id', $request->location);
        }

        $newMatchUserList = $query->get();

        return view('frontEnd.search')->with('newMatchUserList', $newMatchUserList);
        
    }

    public function showAdvanceSearch(){
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $search_criteria = [];

        if (auth()->user()->advanceSearch) {
            $search_criteria = unserialize(auth()->user()->advanceSearch->criteria);
        }

        return view('dashlead.advanceSearch', compact('search_criteria'));
        
    }

    public function postAdvanceSearch(Request $request){
        
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $search_criteria = [];

        $query = PortalJoinUser::query()->where([['user_id','!=', auth()->id()],['portal_id',auth()->user()->portalInfo->portal_id]])
                                        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
                                        ->whereNotIn('user_id', auth()->user()->disableUserList())
                                        ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth());

        if(!empty($request->username))
        {
            $search_criteria['username'] = $request->username;
            $query->where('username','LIKE','%'.$request->username."%");
        }

        if(isset($request->man) || isset($request->woman) || isset($request->couple)){

            $query->whereIn('sex',[$request->man,$request->woman,$request->couple]) ;

            if (isset($request->man) && $request->man != '') {
                $search_criteria['man'] = $request->man;
            }

            if (isset($request->woman) && $request->woman != '') {
                $search_criteria['woman'] = $request->woman;
            }

            if (isset($request->couple) && $request->couple != '') {
                $search_criteria['couple'] = $request->couple;
            }
        }

        if(!empty($request->area))
        {
            $search_criteria['area'] = [];

            foreach ($request->area as $area) {
                array_push($search_criteria['area'], $area);
            }

            $query->whereIn('region_id',$request->area);
        }

        if (isset($request->minAge) && $request->minAge != '')
        {
            $search_criteria['minAge'] = $request->minAge;
            $minAge = Carbon::today()->subYears($request->minAge)->endOfDay();
   
            $query->where('sex','!=','Par')->where('dob', '<' ,$minAge);

            $query->whereHas('coupleInfos', function($q) use($minAge)
                {
                    $q->where('dob', '<' ,$minAge);
                });
             
        }

        if (isset($request->maxAge) && $request->maxAge != '')
        {
            $search_criteria['maxAge'] = $request->maxAge;
            $maxAge = Carbon::today()->subYears($request->maxAge+1);
   
            $query->where('sex','!=','Par')->where('dob', '>' ,$maxAge);

            // $query->orWhere('sex','==','Par')->orWhereHas('coupleInfos', function($q) use($maxAge)
            //     {
            //         $q->where('dob', '>' ,$maxAge);
            //     });
             
        }

        

        $newMatchUserList = $query->get();

        AdvanceSearch::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'portal_id' => auth()->user()->portalInfo->portal_id
            ],
            [
                'user_id' => auth()->user()->id,
                'portal_id' => auth()->user()->portalInfo->portal_id,
                'criteria' => serialize($search_criteria)
            ]
        );

        return view('frontEnd.search_adv',compact('newMatchUserList'));
        
    }

    public function getOnlyHaveFileUserListByFileType($type){
         $List = FileUpload::where([['file_type',$type],['user_type',auth()->user()->portalInfo->portal_id]])  
        ->get();
        $Ids = [];
        if($List)
            foreach ($List as $key => $value) {
                $Ids[$key] = $value->user_id;
            }
        return array_unique($Ids);
    }
}
