<?php

namespace App\Http\Controllers\Backend;

use App\Models\Portal;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\Backend\Chatroom;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\Backend\ChatRoomDetails;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ChatRoomDetailsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request)
    {
         
        $chatrooms = ChatRoomDetails::latest()->get();
        $portals = Portal::all();

        return view('cbs.backend.chatroom', compact('chatrooms', 'portals'));
    }


    public function store(Request $request)
    {

        $this->validate($request,
              [
                'chatroom_name' => 'required',
                'portal_id' => 'required',
                'temp_image' => 'required',
              ],
              [
                'temp_image.required' => 'Image Required.',
                'portal_id.required' => 'Portal Required.',
                'chatroom_name.required' => 'Name Required.',
              ]
            );

        //====== Image Process ======>
              $current_date = Carbon::now()->toDateString();
              $image_path = "uploads/chatRoomCoverImages";
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
                  $image_name = "uploads/chatRoomCoverImages/default.jpg";
                }
        //====== Image Process ======>

        $ChatRoomDetails = new ChatRoomDetails();
        $ChatRoomDetails->chatroom_name = $request->chatroom_name;
        $ChatRoomDetails->portal_id = $request->portal_id;
        $ChatRoomDetails->chatroom_image = $image_name;
        $ChatRoomDetails->save();

        Toastr::success('Chatroom created', 'Success');
        return redirect()->back();
    }

    public function edit($id)
    {

         if(request()->ajax())
        {

        $chatroom = ChatRoomDetails::find($id);


        $name = '<input type="text" class="form-control" name="chatroom_name" value="'.$chatroom->chatroom_name.'" required>';
        $image = '<img src="/'.$chatroom->chatroom_image.'" width="50" height="50" />';
        $id = '<input type="hidden" class="form-control" name="id" value="'.$chatroom->id.'">';

        return response()->json([
                'name' => $name,
                'image' => $image,
                'id' => $id,
                ]);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request,
              [
                'chatroom_name' => 'required',
              ],
              [
                'chatroom_name.required' => 'Name Required.',
              ]
            );

        $ChatRoomDetails = ChatRoomDetails::find($request->id);

            //====== Image Process ======>
              if($request->has('temp_image'))
                {
                  // For New Image
                    $current_date = Carbon::now()->toDateString();
                    $image_path = "uploads/chatRoomCoverImages";
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
                        $image_name = "uploads/chatRoomCoverImages/default.jpg";
                      }
                  // For New Image

                  // Remove Old Image
                    if(File::exists($ChatRoomDetails->chatroom_image))
                      {
                      File::delete($ChatRoomDetails->chatroom_image);
                      }
                  // Remove Old Image

                }
              else
                {
                  $image_name = $ChatRoomDetails->chatroom_image;
                }
            //====== Image Process ======>

        
        $ChatRoomDetails->chatroom_name = $request->chatroom_name;
        $ChatRoomDetails->chatroom_image = $image_name;
        $ChatRoomDetails->save();

        Toastr::success('Chatroom updated', 'Success');
        return redirect()->back();

    }


    public function destroy($id)
    {

        $chatroom = ChatRoomDetails::find($id);

        // Remove Old Image
            if(File::exists($chatroom->chatroom_image))
            {
                File::delete($chatroom->chatroom_image);
            }
        // Remove Old Image

         $chatroom->delete();

        Toastr::success('Chatroom has been deleted successfully', 'Success');
        return redirect()->back();

    }
}
