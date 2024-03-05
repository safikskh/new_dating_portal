<?php

namespace App\Http\Controllers\frontEnd;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Response;
use App\Models\Groups;
use App\Models\Portal;
use Illuminate\Http\Request;
use App\Models\GroupJoinUser;
use App\Models\PortalJoinUser;
use App\Models\UserPostOnGroup;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UserLikesOnGroupPost;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RepliedToThread;
use App\Models\UserCommentsOnGroupPost;
use Illuminate\Support\Facades\File;
use Illuminate\Notifications\DatabaseNotification;
use Carbon\Carbon;
class GroupsController extends Controller
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
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $latestGroup = Groups::orderBy('id','DESC')
        ->where('status','1')
        ->where('type',Auth::user()
        ->getportal(Auth::user()->portalJoinUser_id))
        ->limit(8)->get();

        $data = Groups::orderBy('id','DESC')
        ->where('status','1')
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))
        ->paginate(6);

        return view('groups',compact('data','latestGroup'));
    }

    public function search(Request $request)
    {

          $query = Groups::query()
                          ->whereNotIn('user_id', auth()->user()->deactivateUserList())
                          ->where('status','1')
                          ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id));

          // If User Search
          if(!empty($request->search))
            {
                $query->where('title', 'LIKE', "%{$request->search}%")
                      ->orwhere('details', 'LIKE', "%{$request->search}%");
            }

          $data = $query->paginate(6);


        $latestGroup = Groups::orderBy('id','DESC')
        ->where('status','1')
        ->where('type',Auth::user()
        ->getportal(Auth::user()->portalJoinUser_id))
        ->limit(8)->get();


        return view('groups',compact('data','latestGroup'));
    }

    public function groupstore(Request $request)
    {
       if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
      if(Auth::check()){
        if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){

          $this->validate($request,
                  [
                    'temp_image' => 'required',
                    'title'=>'required',
                    'details'=>'required',
                    'group_type'=>'required',
                  ],
                  [
                    'temp_image.required' => 'Du skal uploade billede.',
                  ]
                );

          //====== Group Image Process ======>
              $current_date = Carbon::now()->toDateString();
              $image_path = "uploads/group";
              $old_img_path = $request->temp_image;
              $new_img_path = $image_path.'/'.uniqid().'_'.$current_date.'.jpg';
              
              if(File::exists($request->temp_image))
                {
                  $image_name = $new_img_path;

                  if (!File::exists($image_path))
                  {
                    File::makeDirectory($image_path, 0777, true, true);
                  }

                  File::move($old_img_path, $new_img_path);
                }
              else
                {
                  $image_name = "uploads/group/default.jpg";
                }
          //====== Group Image Process ======>

          $data = new Groups();
          $data->title = $request->title;
          $data->details = $request->details;
          $data->group_type = $request->group_type;
          $data->image = $image_name;
          $data->user_id = Auth::user()->id;
          $data->type = Auth::user()->getportal(Auth::user()->portalJoinUser_id);
          $data->membership_id = Auth::user()->getmembership(Auth::user()->portalJoinUser_id);
          DB::beginTransaction();
          try {

              if ($data->save()) {
                $data1 = new GroupJoinUser();
                $data1->user_id = Auth::user()->id;
                $data1->group_id = $data->id;
                $data1->status = 0;
                $data1->save();
                DB::commit();
                if($data->type == 3 || $data->type == 4 || $data->type == 6){
                  return redirect()->route('groups')->with('successs','Loger Created Successfull!');
                }else{
                  return redirect()->route('groups')->with('successs','Group Created Successfull!');
                }
              }else{
                DB::rollback();
                return redirect()->route('groups')->with('error',$e->getMessage());
              }
          }catch (\Exception $e) {
              DB::rollback();
              return redirect()->route('groups')->with('error',$e->getMessage());
          }
        }else{
          if(Auth::user()->getportal(Auth::user()->portalJoinUser_id) == 3 || Auth::user()->getportal(Auth::user()->portalJoinUser_id) == 4 || Auth::user()->getportal(Auth::user()->portalJoinUser_id) == 6){
            return redirect()->route('groups')->with('error','For create this Loger you must update as paid member');
          }else{
            return redirect()->route('groups')->with('error','For create this group you must update as paid member');
          }
        }
      }else{

        return redirect()->route('home')->with('error','Please Login Your Account');
      }

    }

    public function groupedit($id)
    {
        if(auth()->user()->isDeactivate()){
        return redirect('profile_security')->with('error','please active your account to access');
        }
        if(auth()->user()->isDeactivateUser(Groups::findUserByGroup($id)->id)){
          return redirect('home');
        }

        $latestGroup = Groups::orderBy('id','DESC')
        ->where('status','1')
        ->where('type',Auth::user()
        ->getportal(Auth::user()->portalJoinUser_id))
        ->limit(8)->get();

        $data = Groups::find($id);


        return view('groupedit',compact('latestGroup','data'));
    }

    public function groupupdate(Request $request, $id)
    {

      if(auth()->user()->isDeactivate())
        {
          Toastr::error('Aktivér din konto for at få adgang.', 'Error');
          return redirect('profile_security');
        }

      if(Auth::check())
        {
          if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){

            $this->validate($request,
              [
                'title' => 'required',
                'details' => 'required',
              ],
              [
                'title.required' => 'Du skal indtaste titel.',
                'details.required' => 'Du skal indtaste begivenheds oplysninger.',
              ]
            );

            $group = Groups::find($id);

            //====== Event Image Process ======>
              if($request->has('temp_image'))
                {
                  // For New Image
                    $current_date = Carbon::now()->toDateString();
                    $image_path = "uploads/group";
                    $temp_img_path = $request->temp_image;
                    $new_img_path = $image_path.'/'.uniqid().'_'.$current_date.'.jpg';
                    
                    if(File::exists($request->temp_image))
                      {
                        $image_name = $new_img_path;

                        if (!File::exists($image_path))
                        {
                          File::makeDirectory($image_path, 0777, true, true);
                        }

                        File::move($temp_img_path, $new_img_path);
                      }
                    else
                      {
                        $image_name = "uploads/group/default.jpg";
                      }
                  // For New Image

                  // Remove Old Image
                    if(File::exists($group->image))
                      {
                      File::delete($group->image);
                      }
                  // Remove Old Image

                }
              else
                {
                  $image_name = $event->image;
                }
            //====== Event Image Process ======>

            
            $group->title = $request->title;
            $group->details = $request->details;
            $group->image = $image_name;
            $group->save();

            Toastr::success('Gruppe opdatering vellykket.', 'Success');
            return redirect()->route('groupDetails',$id);

          }
          else
            {
              Toastr::error('Opdater medlemskab.', 'Error');
              return redirect()->route('plans.index');
            }
        }
      else
        {
          Toastr::error('Log ind på din konto.', 'Error');
          return redirect()->route('home');
        }
    
    }


    //SearchController.php
    public function autocomplete(Request $request){
       if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $term = $request->term;
        $results = array();
        $queries = DB::table('groups')
        ->where('title', 'LIKE', '%'.$term.'%')
        ->take(5)->get();
        foreach ($queries as $query)
        {
          $results[] = [ 'id' => $query->id, 'value' => $query->title ];
        }
        return Response::json($results);
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

    public function approvedToJoin(Request $request){
       if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $threadID =  $request->thread_id;
        $groupId = $request->group_id;
        $userId = $request->user_id;
          $model = GroupJoinUser::where('group_id',$groupId)->where('user_id',$request->user_id)->first();
          if($model){
            $model->status = 0;
            $model->save();
            $this->sendNotification($groupId,$userId,"isApproveGroupJoinRequest");            
            if($request->ajax() && auth()->user()->unreadNotifications->find($threadID)->markAsRead())
              return response()->json('success', 200);
            return redirect()->back();
          }else{
            return redirect()->back()->with('error','group join user not found');
          }
    }
      

    

    public function rejectToJoin(Request $request){
       if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
          $threadID = $request->thread_id;
          $groupId = $request->group_id;
          $userId = $request->user_id;
          $model = GroupJoinUser::where([['group_id',$groupId],['user_id',$userId]])->first();
          if($model){            
            $model->delete();
            $this->sendNotification($groupId,$userId,"isRejectGroupJoinRequest");
            auth()->user()->unreadNotifications->find($threadID)->markAsRead();
            if($request->ajax()) return response()->json('success', 200);
            
            return redirect()->back();
          }else{
            return redirect()->back()->with('error','group join user not found');
          }

      }

      public function sendNotification($groupId, $userId,$type){
            $notifyUser = User::find($userId); 

            $model['user_id'] = $userId;
            $model['group_id'] = $groupId;
            $model['groupName'] = Groups::find($groupId)->title;           
            $model['notificationType'] = 3;
            $model[$type] = 1;
            $model['portal_id'] = auth()->user()->portalInfo->portal_id;
            $model['isDisablePushNotif'] = $notifyUser->portalInfo->isDisablePushNotif;
            $notifyUser->notify(new RepliedToThread($model));
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
      if(Auth::check()){
        if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){
          // $this->validate($request, [
          //   'title'=>'required',
          //   'details'=>'required',

          // ]);
          $data = new Groups();
          $data->title = session()->get('groupPost')['title'];
          $data->details = session()->get('groupPost')['about'];
          $data->group_type = session()->get('groupPost')['type'];
          // if($file = $request->file('image')){
          //   $name = uniqid().$file->getClientOriginalName();
          //   $data->image = $file->move('uploads/group', $name );
          // }else{
          //   $data->image = "samrat/default.jpg";
          // }
          $groupImage = session()->get('groupPost')['imageURL'];
          $old_path = 'uploads/temporary/'.$groupImage;
          $new_path = 'uploads/group/'.$groupImage;
          File::move($old_path, $new_path);
          $data->image = $new_path;
          $data->user_id = Auth::user()->id;
          $data->type = Auth::user()->getportal(Auth::user()->portalJoinUser_id);
          $data->membership_id = Auth::user()->getmembership(Auth::user()->portalJoinUser_id);
          DB::beginTransaction();
          try {

              if ($data->save()) {
                $data1 = new GroupJoinUser();
                $data1->user_id = Auth::user()->id;
                $data1->group_id = $data->id;
                $data1->status = 0;
                $data1->save();
                DB::commit();
                if($data->type == 3 || $data->type == 4 || $data->type == 6){
                  return redirect()->route('groups')->with('successs','Loger Created Successfull!');
                }else{
                  return redirect()->route('groups')->with('successs','Group Created Successfull!');
                }
              }else{
                DB::rollback();
                return redirect()->route('groups')->with('error',$e->getMessage());
              }
          }catch (\Exception $e) {
              DB::rollback();
              return redirect()->route('groups')->with('error',$e->getMessage());
          }
        }else{
          if(Auth::user()->getportal(Auth::user()->portalJoinUser_id) == 3 || Auth::user()->getportal(Auth::user()->portalJoinUser_id) == 4 || Auth::user()->getportal(Auth::user()->portalJoinUser_id) == 6){
            return redirect()->route('groups')->with('error','For create this Loger you must update as paid member');
          }else{
            return redirect()->route('groups')->with('error','For create this group you must update as paid member');
          }
        }
      }else{

        return redirect()->route('home')->with('error','Please Login Your Account');
      }

    }

    public function groupDetails($id){
      if(auth()->user()->isDeactivate()){
          return redirect('profile_security')->with('error','please active your account to access');
      }
      if(auth()->user()->isDeactivateUser(Groups::findUserByGroup($id)->id)){
          return redirect('home');
      }
      $data = Groups::find($id);
      $similarGroup = Groups::where('type',$data->type)
      ->whereNotIn('user_id', auth()->user()->deactivateUserList())
      ->where('id','!=',$data->id)->orderBy('id','Desc')->limit(5)->get();
      $groupMember = GroupJoinUser::where('group_id',$id)
      ->whereNotIn('user_id', auth()->user()->deactivateUserList())
      ->where('status',0)->get();
      $posts = UserPostOnGroup::where('group_id',$id)
      ->whereNotIn('user_id', auth()->user()->deactivateUserList())
      ->where('type',0)->orderBy('id','DESC')->paginate(2);
      $mediaposts = UserPostOnGroup::where('group_id',$id)
      ->whereNotIn('user_id', auth()->user()->deactivateUserList())
      ->where('type',1)->orderBy('id','DESC')->paginate(1);

      if (session()->has('type')){
        return session('type');
        // return view('groupdetails',compact('data','similarGroup','groupMember','posts','mediaposts'));
      }

      return view('groupdetails',compact('data','similarGroup','groupMember','posts','mediaposts'));
    }

    public function groupdeactive($id)
    {

      if(auth()->user()->isDeactivate())
        {
          Toastr::error('Aktivér din konto for at få adgang.', 'Error');
          return redirect('profile_security');
        }

      if(Auth::check())
        {
          if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){

            $group = Groups::find($id);
            $group->status = "0";
            $group->save();

            Toastr::success('Grouppe Blev Deaktiveret.', 'Success');
            return redirect()->back();

          }
          else
            {
              Toastr::error('Opdater medlemskab.', 'Error');
              return redirect()->route('plans.index');
            }
        }
      else
        {
          Toastr::error('Log ind på din konto.', 'Error');
          return redirect()->route('home');
        }
    
    }

    public function joinGroup($id){
      if(auth()->user()->isDeactivate()){
          return redirect('profile_security')->with('error','please active your account to access');
      }
      $data = Groups::find($id);
      $ifAlreadyJoinMember = GroupJoinUser::where('user_id',auth()->id())->where('group_id',$id)->first();
      if(auth()->user()->isPaid() || $ifAlreadyJoinMember){
        if($data->type == Auth::user()->getportal(Auth::user()->portalJoinUser_id)){
          if($data->membership_id == Auth::user()->getmembership(Auth::user()->portalJoinUser_id) || $data->membership_id != 1){
            $data1 = new GroupJoinUser();
            $data1->user_id = Auth::user()->id;
            $data1->group_id = $id;
            if($data->group_type == 0){
              $data1->status = 0;
            }else{
              $data1->status = 1;
            }
            DB::beginTransaction();
            try {
                $check = GroupJoinUser::where('user_id',$data1->user_id)->where('group_id',$id)->first();
                if(!$check){
                  if ($data1->save()) {
                    $notifyUser = Groups::findUserByGroup($id);
                    $data1->notificationType = 3;
                    if (Groups::find($id)->group_type == 1) {
                      $data1->isGroupRequest = 1;
                    } else {
                      $data1->isGroupJoin = 1;
                    }                    
                    $data1->groupName = Groups::find($id)->title;
                    $data1->portal_id = auth::user()->portalInfo->portal_id;
                    $data1->isDisablePushNotif = $notifyUser->portalInfo->isDisablePushNotif;
                    $notifyUser->notify(new RepliedToThread($data1));
                    DB::commit();
                    if($data->type == 3 || $data->type == 4 || $data->type == 6){
                      if($data->group_type == 1){
                        return redirect()->route('groupDetails',$id)->with('successs','Thank you for joining. The Loger admin will confirm your joining');
                      }else{
                        return redirect()->route('groupDetails',$id)->with('successs','Thank you for joining this Loger');
                      }
                    }else{
                      if($data->group_type == 1){
                        return redirect()->route('groupDetails',$id)->with('successs','Thank you for joining. The group admin will confirm your joining');
                      }else{
                        return redirect()->route('groupDetails',$id)->with('successs','Thank you for joining this group');
                      }
                    }
                  }else{
                    DB::rollback();
                    return redirect()->route('groupDetails',$id)->with('error',$e->getMessage());
                  }
                }else{
                  if($check->status == 0){
                    $check->delete();
                    DB::commit();
                    if($data->type == 3 || $data->type == 4 || $data->type == 6){
                      return redirect()->route('groups')->with('successs','you leave from Loger');
                    }else{
                      return redirect()->route('groups')->with('successs','you leave from group');
                    }
                  }else{
                    DB::commit();
                    return redirect()->route('groupDetails',$id)->with('error','you are not approved yet');
                  }
                }
            }catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('groupDetails',$id)->with('error',$e->getMessage());
            }
          }else{
            if($data->type == 3 || $data->type == 4 || $data->type == 6){
              return redirect()->route('groupDetails',$id)->with('error','For joining this Loger you must update as paid member');
            }else{
              return redirect()->route('groupDetails',$id)->with('error','For joining this group you must update as paid member');
            }
          }
        }else{
          return redirect()->route('groupDetails',$id)->with('error','please change your membership type');
        }
      }else{
        return redirect()->back();
      }
    }

    public function postongroup(Request $request){
      if(auth()->user()->isDeactivate()){
          return redirect('profile_security')->with('error','please active your account to access');
      }
      
      $data = Groups::find($request->group_id);
      $id = $request->group_id;
      if(Auth::check()){
        $check = GroupJoinUser::where('user_id',Auth::user()->id)->where('group_id',$request->group_id)->where('status',0)->first();
        if($check || $data->user_id == Auth::user()->id){
          
            if($request->type == 0)
              {
                  $this->validate($request, [
                    'group_id'=>'required',
                    'type'=>'required',
                    'data'=>'required',
                  ]);
              }
            else
              {
                $this->validate($request,
                  [
                    'temp_image' => 'required',
                    'type' => 'required',
                    'group_id' => 'required',
                  ],
                  [
                    'temp_image.required' => 'Du skal uploade billede.',
                  ]
                );
              }

            //====== Group Post Image Process ======>
              $current_date = Carbon::now()->toDateString();
              $image_path = "uploads/groupspost";
              $old_img_path = $request->temp_image;
              $new_img_path = $image_path.'/'.uniqid().'_'.$current_date.'.jpg';
              
              if(File::exists($request->temp_image))
                {
                  $image_name = $new_img_path;

                  if (!File::exists($image_path))
                  {
                    File::makeDirectory($image_path, 0777, true, true);
                  }

                  File::move($old_img_path, $new_img_path);
                }
              else
                {
                  $image_name = "uploads/groupspost/default.jpg";
                }
            //====== Group Post Image Process ======>
         
          if($data->type == auth()->user()->portalInfo->portal_id){
             if($data->membership_id == Auth::user()->getmembership(Auth::user()->portalJoinUser_id) || $data->membership_id != 1){
              $data1 = new UserPostOnGroup();
              $data1->user_id = Auth::user()->id;
              $data1->group_id = $request->group_id;
              $data1->type = $request->type;

              if($data1->type == 0){
                $data1->data = $request->data;
              }else{
                $data1->data = $image_name;
              }


              DB::beginTransaction();
              try {
                  if ($data1->save()) {
                    DB::commit();

                    // notification system
                    $notifyThread['user_id'] = Auth::user()->id;
                    $notifyThread['group_id'] = $request->group_id;
                    $notifyThread['notificationType'] = 3;
                    $notifyThread['isGroupPost'] = 1;
                    $notifyThread['groupName'] = Groups::find($request->group_id)->title;
                    $notifyThread['portal_id'] = auth::user()->portalInfo->portal_id;

                     foreach(GroupJoinUser::where('group_id',$request->group_id)->where('status',0)->get() as $item){
                        if(auth()->id() != $item->user_id){
                          $notifyUser = User::find($item->user_id);                          
                          $notifyThread['isDisablePushNotif'] = $notifyUser->portalInfo->isDisablePushNotif;
                          $notifyUser->notify(new RepliedToThread($notifyThread));
                        }
                      }
                    $type = $data1->type;
                    return redirect()->route('groupDetails',$id)->with( ['data' => $type] );
                  }else{
                    DB::rollback();
                    return redirect()->route('groupDetails',$id)->with('error',$e->getMessage());
                  }
              }catch (\Exception $e) {
                  DB::rollback();
                  return redirect()->route('groupDetails',$id)->with('error',$e->getMessage());
              }
            }else{
              return redirect()->route('groupDetails',$id)->with('error','For post something in this group you must update as paid member');
            }
          }else{
            return redirect()->route('groupDetails',$id)->with('error','please change your membership type');
          }
        }else{
          return redirect()->route('groupDetails',$id)->with('error','you are not member of this group');
        }
      }else{
        return redirect()->route('groupDetails',$request->group_id)->with('error','Please Log in first for post something in this group');
      }
    }

    public function likeGroupPost(Request $request){
      if(auth()->user()->isDeactivate()){
          return redirect('profile_security')->with('error','please active your account to access');
      }
      $id = $request->group_id;
      $data = Groups::find($request->group_id);
      if(auth()->user()->isPaid()){
        $check = GroupJoinUser::where('user_id',Auth::user()->id)->where('group_id',$request->group_id)->where('status',0)->first();
        if($check || $data->user_id == Auth::user()->id){
          if($data->type == auth()->user()->portalInfo->portal_id){            
              $data1 = UserLikesOnGroupPost::where('user_id',Auth::user()->id)->where('group_id',$request->group_id)->where('post_id',$request->post_id)->first();
              if($data1){
                if($data1->is_like == 0){
                  $data1->is_like = 1;
                }else{
                  $data1->is_like = 0;
                }
                $data1->save();
              }else{
                $data1 = new UserLikesOnGroupPost();
                $data1->user_id = Auth::user()->id;
                $data1->group_id = $request->group_id;
                $data1->post_id = $request->post_id;
                $data1->is_like = 0;
                $data1->save();
              }
              $type = UserPostOnGroup::find($data1->post_id)->type;
              return redirect()->route('groupDetails',$request->group_id)->with( ['data' => $type] );
            }else{
              return redirect()->route('groupDetails',$request->group_id)->with('error','you are not member of this portal');
            }
        }else{
          return redirect()->route('groupDetails',$id)->with('error','you are not member of this group');
        }
      }else{
        return redirect()->back();
      }
    }

    public function postcommentonthispost(Request $request){
      if(auth()->user()->isDeactivate()){
          return redirect('profile_security')->with('error','please active your account to access');
      }
      $groupUserList = new Collection();
      $data = Groups::find($request->group_id);
      $id = $request->group_id;
      if(auth()->user()->isPaid()){
        $check = GroupJoinUser::where('user_id',Auth::user()->id)->where('group_id',$request->group_id)->where('status',0)->first();
        if($check || Auth::user()->id == $data->user_id){
          $this->validate($request, [
            'group_id'=>'required',
            'post_id'=>'required',
            'comment'=>'required',
          ]);

          if($data->type == Auth::user()->getportal(Auth::user()->portalJoinUser_id)){
            if($data->membership_id == Auth::user()->getmembership(Auth::user()->portalJoinUser_id) || $data->membership_id != 1){
              $data1 = new UserCommentsOnGroupPost();
              $data1->user_id = Auth::user()->id;
              $data1->group_id = $request->group_id;
              $data1->post_id = $request->post_id;
              $data1->comment = $request->comment;
              DB::beginTransaction();
              try {
                  if ($data1->save()) {
                    // notification system
                    DB::commit();
                    $notifyUser = Groups::findUserByPost($request->post_id);
                    if($notifyUser->id != auth()->id()){
                      $notifyThread['user_id'] = Auth::user()->id;
                      $notifyThread['group_id'] = $request->group_id;
                      $notifyThread['notificationType'] = 3;
                      $notifyThread['groupName'] = Groups::find($request->group_id)->title;
                      $notifyThread['portal_id'] = auth::user()->portalInfo->portal_id;
                      $notifyThread['isGroupComment'] = 1;
                      $notifyThread['isDisablePushNotif'] = $notifyUser->portalInfo->isDisablePushNotif;
                      $notifyUser->notify(new RepliedToThread($notifyThread));
                    }
                    $type = UserPostOnGroup::find($data1->post_id)->type;
                    return redirect()->route('groupDetails',$id)->with( ['data' => $type] );
                  }else{
                    DB::rollback();
                    return redirect()->route('groupDetails',$id)->with('error',$e->getMessage());
                  }
              }catch (\Exception $e) {
                  DB::rollback();
                  return redirect()->route('groupDetails',$id)->with('error',$e->getMessage());
              }
            }else{
              return redirect()->route('groupDetails',$id)->with('error','For comment on post in this group you must update as paid member');
            }
          }else{
            return redirect()->route('groupDetails',$id)->with('error','please change your membership type');
          }
        }else{
          return redirect()->route('groupDetails',$id)->with('error','you are not member of this group');
        }
      }else{
       return redirect()->back();
      }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function show(Groups $groups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function edit(Groups $groups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Groups $groups)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy(Groups $groups)
    {
        //
    }
}
