<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Announcement;
use App\Models\Portal;
use Brian2694\Toastr\Facades\Toastr;


class AnnouncementController extends Controller
{
    
    public function index(Request $request)
    {
        $announcements = Announcement::latest()->get();
        $portals = Portal::all();

        return view('cbs.backend.announcement', compact('announcements', 'portals'));
    }

    public function announcementList(){
        $announcements = Announcement::where('portal_id',auth()->user()->portalInfo->portal_id)->get();
        return view('frontEnd.announcements', compact('announcements'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'detail' => 'required',
            'portal_id' => 'required',
            ]);

        Announcement::create($request->all());
        Toastr::success('Announcement created', 'Success');
        return redirect()->back();
    }


    public function edit($id)
    {

        $announcement = Announcement::find($id);
        $portals = Portal::all();
        return view('cbs.backend.announcementedit', compact('announcement','portals'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'detail' => 'required',
            'portal_id' => 'required',
        ]);

        $announcement = Announcement::find($id);
        $announcement->update($request->all());
        Toastr::success('Announcement updated successfully', 'Success');
        return redirect()->route('announcement.index');
    }

    public function destroy($id)
    {

        Announcement::find($id)->delete();
        Toastr::success('Announcement has been deleted successfully', 'Success');
        return redirect()->back();

    }
}
