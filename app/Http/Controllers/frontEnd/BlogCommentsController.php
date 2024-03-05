<?php

namespace App\Http\Controllers\frontEnd;

use App\Models\Blogs;
use App\Models\BlogComments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\RepliedToThread;

class BlogCommentsController extends Controller
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
        //
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
        if (auth()->user()->isPaid()) {
             $this->validate($request, [
            'blog_id'=>'required',
            'comment'=>'required',
            ]);
            $comment = new BlogComments();
            $request['user_id'] = auth()->id();
            $comment->create($request->all());

            $notifyUser = Blogs::findUserByBlog($request->blog_id);
            if($notifyUser->id != auth()->id()){
                $notifyThread['user_id'] = auth()->id();
                $notifyThread['blog_id'] = $request->blog_id;
                $notifyThread['notificationType'] = 3;
                $notifyThread['blogName'] = Blogs::find($request->blog_id)->title;
                $notifyThread['portal_id'] = auth()->user()->portalInfo->portal_id;
                $notifyThread['isBlogComment'] = 1;
                $notifyThread['isDisablePushNotif'] = $notifyUser->portalInfo->isDisablePushNotif;
                $notifyUser->notify(new RepliedToThread($notifyThread));
            }
            return redirect()->back();
        } else {
           return redirect()->back();
        }
        
       
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
