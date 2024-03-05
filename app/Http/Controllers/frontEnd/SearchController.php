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

        // return $request->all();
        $newMatchUserList = new Collection();
        $search_criteria = [];
                
        $portalJoinUsers = portalJoinUser::where([['user_id','!=', auth()->id()],['portal_id',auth()->user()->portalInfo->portal_id]])
            ->whereNotIn('user_id', auth()->user()->deactivateUserList())
            ->whereNotIn('user_id', auth()->user()->disableUserList())
            ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
            ->where('username','LIKE','%'.$request->username."%")
            ->get();

        // if(isset($request->username)){
        //     $search_criteria['username'] = $request->username;
        //     $portalJoinUsers = $portalJoinUsers->where('username','LIKE','%'.$request->username."%");
        // }

        if(isset($request->man) || isset($request->woman) || isset($request->couple)){
            $portalJoinUsers = $portalJoinUsers->whereIn('sex',[$request->man,$request->woman,$request->couple]) ;

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

        if(isset($request->area)){
            $search_criteria['area'] = [];

            foreach ($request->area as $area) {
                array_push($search_criteria['area'], $area);
            }

            $portalJoinUsers = $portalJoinUsers->whereIn('region_id',$request->area);
        }
        if(isset($request->bodyType)){
            $search_criteria['bodyType'] = $request->bodyType;
            $portalJoinUsers = $portalJoinUsers->whereIn('bodyType',$request->bodyType);
        }
        if(isset($request->hairColor)){
            $search_criteria['hairColor'] = $request->hairColor;
            $portalJoinUsers = $portalJoinUsers->whereIn('hairColor',$request->hairColor);
        }
        if(isset($request->eyeColor)){
            $search_criteria['eyeColor'] = $request->eyeColor;
            $portalJoinUsers = $portalJoinUsers->whereIn('eyeColor',$request->eyeColor);
        }
        if(isset($request->children)){
            $search_criteria['children'] = $request->children;
            $portalJoinUsers = $portalJoinUsers->whereIn('children',$request->children);
        }
        if(isset($request->havepictre)){
            $search_criteria['havepictre'] = $request->havepictre;
            $portalJoinUsers = $portalJoinUsers->whereIn('user_id', $this->getOnlyHaveFileUserListByFileType(0));
        }
        if(isset($request->havevideo)){
            $search_criteria['havevideo'] = $request->havevideo;
            $portalJoinUsers = $portalJoinUsers->whereIn('user_id', $this->getOnlyHaveFileUserListByFileType(1));
        }
        if(isset($request->inarelationship)){
            $search_criteria['inarelationship'] = $request->inarelationship;
            $array = [CivilStatus::getValue('IEtForhold'),CivilStatus::getValue('Gift'),CivilStatus::getValue('ÅbentForhold')];
            $portalJoinUsers = $portalJoinUsers->whereIn('civilStatus', $array);
        }
        if(isset($request->onlinePresence)){
            $search_criteria['onlinePresence'] = $request->onlinePresence;

            if($request->onlinePresence == "online"){
                $portalJoinUsers = $portalJoinUsers->whereIn('user_id',auth()->user()->getAllPortalUserByAuth())
                ->whereIn('user_id',auth()->user()->getOnlineUserListByAuth());
            }
        }

        if(isset($request->civilStatus)){
            $search_criteria['civilStatus'] = $request->civilStatus;

            $userOnCivilStatus = new Collection();
            foreach ($portalJoinUsers as $item) {
                if($item->civilStatus == $request->civilStatus){
                    $userOnCivilStatus->push($item);
                }
            }
            $portalJoinUsers = $userOnCivilStatus;
        }
        if(isset($request->minAge) && isset($request->maxAge)){
            if (isset($request->minAge) && $request->minAge != '') {
                $search_criteria['minAge'] = $request->minAge;
            }

            if (isset($request->maxAge) && $request->maxAge != '') {
                $search_criteria['maxAge'] = $request->maxAge;
            }

            $userOnAge = new Collection();
            foreach ($portalJoinUsers as $item) {
                if((Carbon::parse($item->dob)->age) >= $request->minAge && 
                (Carbon::parse($item->dob)->age) <= $request->maxAge){
                    $userOnAge->push($item);
                }
            }
            $portalJoinUsers = $userOnAge;
        }
        if(isset($request->minWeight) && isset($request->maxWeight)){
            if (isset($request->minWeight) && $request->minWeight != '') {
                $search_criteria['minWeight'] = $request->minWeight;
            }

            if (isset($request->maxWeight) && $request->maxWeight != '') {
                $search_criteria['maxWeight'] = $request->maxWeight;
            }

            $userOnWeight = new Collection();
            foreach ($portalJoinUsers as $item) {
                if((int)$item->weight >= (int)$request->minWeight && 
                (int)$item->weight <= (int)$request->maxWeight){
                    $userOnWeight->push($item);
                }
            }
            $portalJoinUsers = $userOnWeight;
        }
        if(isset($request->minHeight) && isset($request->maxHeight)){
            if (isset($request->minHeight) && $request->minHeight != '') {
                $search_criteria['minHeight'] = $request->minHeight;
            }

            if (isset($request->maxHeight) && $request->maxHeight != '') {
                $search_criteria['maxHeight'] = $request->maxHeight;
            }

            $userOnHeight = new Collection();
            foreach ($portalJoinUsers as $item) {
                if((int)$item->height >= (int)$request->minHeight && 
                (int)$item->height <= (int)$request->maxHeight){
                    $userOnHeight->push($item);
                }
            }
            $portalJoinUsers = $userOnHeight;
        }
        if(isset($request->sexualOrientation)){
            if (isset($request->sexualOrientation) && $request->sexualOrientation != '') {
                $search_criteria['sexualOrientation'] = $request->sexualOrientation;
            }

            if (isset($request->sexualOrientation) && $request->sexualOrientation != '') {
                $search_criteria['sexualOrientation'] = $request->sexualOrientation;
            }

            $userOnSexualOrientation = new Collection();
            foreach ($portalJoinUsers as $item) {
                if($item->sexualOrientation == $request->sexualOrientation){
                    $userOnSexualOrientation->push($item);
                }
            }
            $portalJoinUsers = $userOnSexualOrientation;
        }

        if(isset($request->tattoos)){
            $search_criteria['tattoos'] = $request->tattoos;

            $userOnTattoos = new Collection();
            foreach ($portalJoinUsers as $item) {
                if($item->tattoos == $request->tattoos){
                    $userOnTattoos->push($item);
                }
            }
            $portalJoinUsers = $userOnTattoos;
        }

        if(isset($request->piercing)){
            $search_criteria['piercing'] = $request->piercing;

            $userOnPiercing = new Collection();
            foreach ($portalJoinUsers as $item) {
                if($item->piercing == $request->piercing){
                    $userOnPiercing->push($item);
                }
            }
            $portalJoinUsers = $userOnPiercing;
        }

        if(isset($request->smoking)){
            $search_criteria['smoking'] = $request->smoking;

            $userOnSmoking = new Collection();
            foreach ($portalJoinUsers as $item) {
                if($item->smoking == $request->smoking){
                    $userOnSmoking->push($item);
                }
            }
            $portalJoinUsers = $userOnSmoking;
        }

        if(isset($request->matchword)){
            $search_criteria['matchword'] = $request->matchword;

            $aMword = explode(",",$request->matchword);
            $userOmatchword = new Collection();
            foreach ($portalJoinUsers as $item) {
                $result = array_intersect($aMword , (array)(json_decode($item->matchWords)));
                    if($aMword == $result){
                       $userOmatchword->push($item);
                    }
            }
            $portalJoinUsers = $userOmatchword;
        }

        if(isset($request->searching)){
            $search_criteria['searching'] = [];

            foreach ($request->searching as $item) {
                array_push($search_criteria['searching'], $item);
            }

            $userOnSearching = new Collection();
                foreach ($portalJoinUsers as $item) {
                  $result = array_intersect($request->searching,(array)(json_decode($item->searching)));
                    if($request->searching == $result){
                         $userOnSearching->push($item);
                    }
                }
            $portalJoinUsers = $userOnSearching;
        }
       
        foreach ($portalJoinUsers as $item) {
           
                $user = User::find($item['user_id']);
                $newMatchUserList->push($user);             
        }

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
