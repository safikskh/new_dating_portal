<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Chatroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChatroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chatrooms = Chatroom::all();
        return view('backend.chatroom.index', compact('chatrooms'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
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
        $this->validate($request, [
            'chatroom_name' => 'required',
            'chatroom_image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if($image = $request->file('chatroom_image')) {
            $chatImg = Storage::disk('uploads')->put('chatroom',$image);
        }

        Chatroom::create($request->except('chatroom_image')+['chatroom_image' => $chatImg]);
        
        return redirect()->route('chatroom.index')->with('success', 'Chatroom Information created successfully !');
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

    public function chatroomEdit($id)
    {
        $chatroom = Chatroom::find($id);
        return view('backend.chatroom.editChatroom', compact('chatroom'));
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
        $this->validate($request, [
            'chatroom_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $chatroom = Chatroom::find($id);

        // for chatroom image update
        $chatroomImg = $chatroom->chatroom_image;
        if($image = $request->file('chatroom_image')){
            $chatroomImg = Storage::disk('uploads')->put('chatroom',$image);
            Storage::disk('uploads')->delete($chatroom->image);
        }

        // chatroom info update
        $chatroom->update($request->except('chatroom_image')+['chatroom_image' => $chatroomImg]);

        return redirect()->route('chatroom.index')->with('success', 'Chatroom Information updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chatroom::find($id)->delete();
        return redirect()->route('Chatroom.index')->with('success', 'Chatroom has been deleted successfully');
        $chatroom = Chatroom::find($id);
        $copy = $chatroom;
        if($chatroom->delete())
            Storage::disk('uploads')
                ->delete($copy->chatroom_image);
        return redirect()->route('chatroom.index')->with('success', 'Chatroom Information Deleted successfully !');
    }
}
