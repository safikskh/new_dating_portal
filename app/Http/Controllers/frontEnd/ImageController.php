<?php

namespace App\Http\Controllers\frontEnd;

use Carbon\Carbon;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ImageController extends Controller
{

    
    public function imageCrop()
    {
        return view('frontEnd.imageCrop');
    }

    public function imageprocess(Request $request)
    {
        
      if($request->ajax())
      {
        $image_data = $request->image;
        $image_array_1 = explode(";", $image_data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = time() . '.jpg';
        $upload_path = public_path() . "/uploads/temporary/" . $image_name;
        file_put_contents($upload_path, $data);
        return response()->json(['temp_image_path' => 'uploads/temporary/', 'temp_image' => 'uploads/temporary/' . $image_name, 'temp_image_name' => $image_name]);
      }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageCropPost(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }

        $data = $request->temp_image_name;
        $title = $request->title;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name= uniqid().'.png';
        $path = public_path() . "/uploads/temporary/" . $image_name;
        file_put_contents($path, $data);
        Session::put('promotion',[
            'imageURL' => $image_name,
            'title' => $title,
        ]);
        return response()->json('success', 200);
    }

    public function blogImageCropPost(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $data = $request->image;
        $blogTitle = $request->blogTitle;
        $blogSubTitle = $request->blogSubTitle;
        $description = $request->description;
        // $category = $request->category;
        // list($type, $data) = explode(';', $data);
        // list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name= uniqid().'.png';
        $path = public_path() . "/uploads/temporary/" . $image_name;
        session()->put('blogpost',[
            'imageURL' => $image_name,
            'blogTitle' => $blogTitle,
            'blogSubTitle' => $blogSubTitle,
            'description' => $description,
            // 'category' => $category,
        ]);
        file_put_contents($path, $data);
        return response()->json(['success'=>'done']);
    }
    public function eventImageCropPost(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $data = $request->image;
        if ($data != '') {
            # code...
        }
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name= uniqid().'.png';
        $path = public_path() . "/uploads/temporary/" . $image_name;
        session()->put('eventpost',[
            'imageURL' => $image_name,
            'title' => $request->title,
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'details' => $request->details,
        ]);
        file_put_contents($path, $data);
        return response()->json(['success'=>'done']);
    }
    public function groupImageCropPost(Request $request)
    {
        if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        }
        $data = $request->image;
        
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name= uniqid().'.png';
        $path = public_path() . "/uploads/temporary/" . $image_name;
        session()->put('groupPost',[
            'imageURL' => $image_name,
            'title' => $request->title,
            'type' => $request->type,
            'about' => $request->about,
        ]);
        file_put_contents($path, $data);
        return response()->json(['success'=>'done']);
    }
}
