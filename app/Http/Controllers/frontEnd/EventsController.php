<?php

namespace App\Http\Controllers\frontEnd;

use Brian2694\Toastr\Facades\Toastr;
use Session;
use App\User;
use Response;
use Carbon\Carbon;
use App\Models\Events;
use App\Models\Portal;
use App\Models\EventPost;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\EventJoinUser;
use App\Models\PortalJoinUser;
use App\Models\EventClickCount;
use App\Models\UserPromotation;
use App\Models\EventPostComment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Notifications\RepliedToThread;
use Illuminate\Support\Facades\Storage;



class EventsController extends Controller
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

        $events = Events::with('click')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))
        ->where('status','1')
        ->paginate(6);

        $latestEvents = Events::orderBy('id','DESC')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('status','1')
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))->limit(4)->get();

        $populerEvents = Events::with('click')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('status','1')
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))
        ->limit(4)->get()->sortByDesc('click.count');

        return view('events',compact('latestEvents','populerEvents','events'));
    }

    public function search(Request $request)
    {

          $query = Events::query()
                          ->whereNotIn('user_id', auth()->user()->deactivateUserList())
                          ->where('status','1')
                          ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id));

          // If User Search
          if(!empty($request->search))
            {
                $query->where('title', 'LIKE', "%{$request->search}%")
                      ->orwhere('location', 'LIKE', "%{$request->search}%")
                      ->orwhere('details', 'LIKE', "%{$request->search}%");
            }

          $events = $query->paginate(6);


        $latestEvents = Events::orderBy('id','DESC')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('status','1')
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))->limit(4)->get();

        $populerEvents = Events::with('click')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('status','1')
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))
        ->limit(4)->get()->sortByDesc('click.count');


        return view('events',compact('latestEvents','populerEvents','events'));
    }



    public function eventstore(Request $request)
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
                'temp_image' => 'required',
                'title' => 'required',
                'location' => 'required',
                'event_type' => 'required',
                'amount' => 'required',
                'event_date' => 'required',
                'event_time' => 'required',
                'details' => 'required',
              ],
              [
                'temp_image.required' => 'Du skal uploade billede.',
                'title.required' => 'Du skal indtaste titel.',
                'location.required' => 'Du skal indtaste placering.',
                'event_type.required' => 'Du skal indtaste begivenheds type.',
                'amount.required' => 'Du skal indtaste begivenheds beløb.',
                'event_date.required' => 'Du skal indtaste begivenheds dato.',
                'event_time.required' => 'Du skal indtaste begivenheds tid.',
                'details.required' => 'Du skal indtaste begivenheds oplysninger.',
              ]
            );

            //====== Event Image Process ======>
              $current_date = Carbon::now()->toDateString();
              $image_path = "uploads/event";
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
                  $image_name = "uploads/event/default.jpg";
                }
            //====== Event Image Process ======>

            $event = new Events();
            $event->user_id = Auth::user()->id;
            $event->type = Auth::user()->getportal(Auth::user()->portalJoinUser_id);
            $event->title = $request->title;
            $event->amount = $request->amount;
            $event->event_type = $request->event_type;
            $event->event_date = $request->event_date;
            $event->event_time = $request->event_time;
            $event->location = $request->location;
            $event->details = $request->details;
            $event->image = $image_name;
            $event->membership_id = Auth::user()->getmembership(Auth::user()->portalJoinUser_id);
            DB::beginTransaction();
              try {
                  if ($event->save()) {
                    $data = new EventJoinUser();
                    $data->user_id = Auth::user()->id;
                    $data->event_id = $event->id;
                    $data->save();

                    $count = new EventClickCount();
                    $count->event_id = $event->id;
                    $count->count = 0;
                    $count->save();
                    DB::commit();
                    Toastr::success('Begivenhed oprettet med succes.', 'Success');
                    return redirect()->back();
                  }else{
                    DB::rollback();
                    Toastr::error('$e->getMessage()', 'Error');
                    return redirect()->back()->with('error',$e->getMessage());
                  }
              }catch (\Exception $e) {
                  DB::rollback();
                  return redirect()->back()->with('error',$e->getMessage());
              }

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

    public function eventedit($id)
    {
        if(auth()->user()->isDeactivate()){
        return redirect('profile_security')->with('error','please active your account to access');
        }
        if(auth()->user()->isDeactivateUser(Events::findUserByEvent($id)->id)){
            return redirect('home');
        }

        $latestEvents = Events::orderBy('id','DESC')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('status','1')
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))->limit(5)->get();

        $populerEvents = Events::with('click')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))
        ->where('status','1')
        ->limit(5)->get()->sortByDesc('click.count');

        $data = Events::find($id);

        return view('eventedit',compact('data','latestEvents','populerEvents'));
    }

    public function eventupdate(Request $request, $id)
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

            $event = Events::find($id);

            //====== Event Image Process ======>
            if($request->has('temp_image'))
              {
                // For New Image
                  $current_date = Carbon::now()->toDateString();
                  $image_path = "uploads/event";
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
                      $image_name = "uploads/event/default.jpg";
                    }
                // For New Image

                // Remove Old Image
                  if(File::exists($event->image))
                    {
                    File::delete($event->image);
                    }
                // Remove Old Image

              }
            else
              {
                $image_name = $event->image;
              }
            //====== Event Image Process ======>

            
            $event->title = $request->title;
            // $event->amount = $request->amount;
            // $event->event_type = $request->event_type;
            // $event->event_date = $request->event_date;
            // $event->event_time = $request->event_time;
            // $event->location = $request->location;
            $event->details = $request->details;
            $event->image = $image_name;
            $event->save();

            Toastr::success('Begivenheds opdatering vellykket.', 'Success');
            return redirect()->route('eventDetails',$id);

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

    public function eventdeactive($id)
    {

      if(auth()->user()->isDeactivate())
        {
          Toastr::error('Aktivér din konto for at få adgang.', 'Error');
          return redirect('profile_security');
        }

      if(Auth::check())
        {
          if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){

            $event = Events::find($id);
            $event->status = "0";
            $event->save();

            Toastr::success('Begivenheden Blev Deaktiveret.', 'Success');
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


    //SearchController.php
    public function autocomplete(Request $request){
      
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $term = $request->term;
        $results = array();
        $queries = DB::table('events')
        ->where('title', 'LIKE', '%'.$term.'%')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // return $request->all();
       if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        if(Auth::check()){
        if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){
          // $this->validate($request, [
          //   'title'=>'required',
          //   'event_type'=>'required',
          //   'event_date'=>'required',
          //   'location'=>'required',
          //   'details'=>'required',

          // ]);
          $data = new Events();
          $data->title = session()->get('eventpost')['title'];
          $data->event_type = session()->get('eventpost')['type'];
          $data->event_date = session()->get('eventpost')['date'];
          $data->event_time = session()->get('eventpost')['time'];
          $data->amount = session()->get('eventpost')['amount'];
          if($data->amount == ''){
            $data->amount = 0;
          }
          $data->location = session()->get('eventpost')['location'];
          $data->details = session()->get('eventpost')['details'];
          $eventImage = session()->get('eventpost')['imageURL'];
          $old_path = 'uploads/temporary/'.$eventImage;
          $new_path = 'uploads/event/'.$eventImage;
          if ($eventImage != '') {
            File::move($old_path, $new_path);
            $data->image = $new_path;
          }else {
            $data->image = "uploads/event/defaultevent.png";
          }
          $data->user_id = Auth::user()->id;
          $data->type = Auth::user()->getportal(Auth::user()->portalJoinUser_id);
          $data->membership_id = Auth::user()->getmembership(Auth::user()->portalJoinUser_id);
          DB::beginTransaction();
          try {
            //dd($data);
              if ($data->save()) {
                session()->forget('eventpost');
                $data1 = new EventJoinUser();
                $data1->user_id = Auth::user()->id;
                $data1->event_id = $data->id;
                $data1->save();

                $count = new EventClickCount();
                $count->event_id = $data->id;
                $count->count = 0;
                $count->save();
                DB::commit();
                return redirect()->route('events')->with('successs','Event Created Successfull!');
              }else{
                DB::rollback();
                return redirect()->route('events')->with('error',$e->getMessage());
              }
          }catch (\Exception $e) {
              DB::rollback();
              return redirect()->route('events')->with('error',$e->getMessage());
          }
        }else{
          return redirect()->route('plans.index')->with('error','Update membership' );
        }
      }else{

        return redirect()->route('home')->with('error','Please Login Your Account');
      }
    }

    public function eventDetails(Request $request, $id){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
       }
      if(auth()->user()->isDeactivateUser(Events::findUserByEvent($id)->id)){
          return redirect('home');
      }
      $portalList = new Collection();
      $portalUsers = PortalJoinUser::where('user_id', Auth::user()->id)->get();
        foreach ($portalUsers as $value) {
            $portal = Portal::find($value['portal_id']);
             $portalList->push($portal);
        }
      if (session()->has('tabName')){
        return $this->eventInfo($id,'discussion');
      }
      return $this->eventInfo($id,'about');
     
    }

    public function eventInfo($id,$tabNmae){
       $data = Events::find($id);
     $similarEvent = Events::where('type',$data->type)
      ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
      ->whereNotIn('user_id', auth()->user()->deactivateUserList())
      ->where('id','!=',$data->id)->orderBy('id','Desc')->limit(5)->get();

      $eventMember = EventJoinUser::where('event_id',$id)
      ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
      ->whereNotIn('user_id', auth()->user()->deactivateUserList())
      ->get();

      $eventPosts = EventPost::where('event_id',$id)
        ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->orderBy('id', 'DESC')
        ->paginate(2);;

      $count = EventClickCount::where('event_id',$id)->first();
      if($count){
        $count->count +=1;
        $count->save();
      }
       $tab = $tabNmae;
      return view('eventdetails',compact('tab','data','similarEvent','eventMember','eventPosts'));
    }

    public function joinEvent($id){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
      if(Auth::check()){
        $data = Events::find($id);
        if($data->type ==  Auth::user()->getportal(Auth::user()->portalJoinUser_id)){          
            $data = new EventJoinUser();
            $data->user_id = Auth::user()->id;
            $data->event_id = $id;
            DB::beginTransaction();
            try {
                $check = EventJoinUser::where('user_id',$data->user_id)->where('event_id',$id)->first();
                if(!$check){
                  if ($data->save()) {
                    // notification system
                    $notifyUser = Events::findUserByEvent($id);
                    $data->isEventJoin = 1;
                    $data->eventName = Events::find($id)->title;
                    $data->notificationType = 3;
                    $data->portal_id = auth::user()->portalInfo->portal_id;
                    $data->isDisablePushNotif = $notifyUser->portalInfo->isDisablePushNotif;
                    $notifyUser->notify(new RepliedToThread($data));
                    DB::commit();
                    return redirect()->route('eventDetails',$id)->with('successs','Thank you for joining this event');
                  }else{
                    DB::rollback();
                    return redirect()->route('eventDetails',$id)->with('error',$e->getMessage());
                  }
                }else{
                  $check->delete();
                  DB::commit();
                  return redirect()->route('events');
                }

            }catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('eventDetails',$id)->with('error',$e->getMessage());
            }         
        }else{
          return redirect()->route('eventDetails',$id)->with('error','please change your membership type');
        }
      }else{
        return redirect()->route('eventDetails',$id)->with('error','Please Log in first for joining any event');
      }
    }

    public function eventPost(Request $request){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      if(auth()->user()->isPaid()){
        $eventPost = new EventPost();
        $request['user_id'] = auth()->id();
        if($eventPost->create($request->all())){
          return redirect()->back()->with('tabName', ['discussion']);
        }

      }else{
        return redirect()->back()->with('tabName', ['discussion']);
      }
    }

    public function eventComment(Request $request){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }
      
      if(auth()->user()->isPaid()){
        $eventComment = new EventPostComment();
        $request['user_id'] = auth()->id();
        if($eventComment->create($request->all())){
          return redirect()->back()->with('tabName', ['discussion']);
        }
      }else {
        return redirect()->back()->with('tabName', ['discussion']);
      }
    }

    public function show(Events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Events $events)
    {
        //
    }


   
}
