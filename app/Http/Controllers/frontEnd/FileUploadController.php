<?php

namespace App\Http\Controllers\frontEnd;

use Brian2694\Toastr\Facades\Toastr;
use File;
use App\User;
use CloudConvert;
use App\Enums\Sex;
use App\Models\Portal;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use App\Models\Backend\Chatroom;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FileUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function imageUpload(Request $request){
      if(auth()->user()->isDeactivate()){
        Toastr::error('Aktivér din konto for at få adgang.', 'Error');
        return redirect('profile_security');
      }


        if(auth()->user()->isPaid()){
          $this->validate($request,
              [
                'temp_image' => 'required',
              ],
              [
                'temp_image.required' => 'Du skal uploade billede.',
              ]
            );

          //====== Event Image Process ======>
              $current_date = Carbon::now()->toDateString();
              $image_path = "uploads/file_upload/images";
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
                  $image_name = "uploads/file_upload/images/default.jpg";
                }
            //====== Event Image Process ======>

          $data = new FileUpload();
          $data->user_id = Auth::user()->id;
          $data->user_type = auth()->user()->portalInfo->portal_id;
          $data->sex = auth()->user()->portalInfo->sex;
          $data->file_type = 0;
          $data->file = $image_name;

          DB::beginTransaction();
          try {
              if ($data->save()) {
                DB::commit();
                Toastr::success('Billedet uploadet!', 'Success');
                return redirect()->back();
              }else{
                DB::rollback();
                Toastr::error('$e->getMessage', 'Error');
                return redirect()->back();
              }
          }catch (\Exception $e) {
              DB::rollback();
              Toastr::error('$e->getMessage', 'Error');
              return redirect()->back();
          }
        }else{
          Toastr::error('Aktivér din konto for at få adgang.', 'Error');
          return redirect()->route('plans.index');
        }
    }

    public function videoUpload(Request $request){
      if(auth()->user()->isDeactivate()){
        Toastr::error('Aktivér din konto for at få adgang.', 'Error');
        return redirect('profile_security');
      }

        if(auth()->user()->isPaid()){

          $this->validate($request,
              [
                'video' => 'required|mimetypes:video/*|max:30720',
              ],
              [
                'video.required' => 'Video skal uploades.',
                'video.max' => 'Videoen skal være under 30 MB.',
                'video.mimetypes' => 'Upload fil skal være en video.',
              ]
            );

          $data = new FileUpload();
          $data->user_id = Auth::user()->id;
          $data->user_type = Auth::user()->getportal(Auth::user()->portalJoinUser_id);
          $data->sex = Auth::user()->portalInfo->sex;
          $data->file_type = 1;
         
          $current_date = Carbon::now()->toDateString();
          if($video = $request->file('video')){
              $input['video'] = uniqid().'_'.$current_date.'.'.$video->getClientOriginalExtension();
              $destinationPath = "uploads/file_upload/videos";

              if (!File::exists($destinationPath))
                  {
                    File::makeDirectory($destinationPath, 0777, true, true);
                  }

              $data->file = $video->move($destinationPath, $input['video']);
          }


          if($video->getClientOriginalExtension() != "mp4"){
              CloudConvert::file($destinationPath.'/'.$input['video'])->to('mp4');
              File::delete($destinationPath.'/');
              $data->file = $destinationPath.'/'.uniqid().'_'.$current_date.'.mp4';
          }
          
          DB::beginTransaction();
          try {
              if ($data->save()) {
                DB::commit();
                Toastr::success('Video uploadet!', 'Success');
                return redirect()->back();
              }else{
                DB::rollback();
                Toastr::error('$e->getMessage', 'Error');
                return redirect()->back();
              }
          }catch (\Exception $e) {
              DB::rollback();
              Toastr::error('$e->getMessage', 'Error');
              return redirect()->back();
          }
        }else{
          Toastr::error('Aktivér din konto for at få adgang.', 'Error');
          return redirect()->route('plans.index');
        }
    }

    public function getFiles($type, $sex, $perPage){
      $userIds = [];
      $fileList = FileUpload::where('user_type', auth()->user()->portalInfo->portal_id)
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
        ->where('file_type', $type)->get();

      foreach ($fileList as $key => $value) {
          if (User::find($value->user_id)->portalInfo->sex == $sex) {            
            $userIds[$key] = $value->user_id;
          }
      }

      return FileUpload::whereIn('user_id', array_unique($userIds))->where([['file_type', $type],['user_type', auth()->user()->portalInfo->portal_id]])->paginate($perPage);
    }    

    public function showUploadImageAll(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      $data = FileUpload::where('user_type',auth()->user()->portalInfo->portal_id)
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
        ->where('file_type',0)
        ->paginate(20);
      return view('dashlead.uploadedimage',compact('data'));

    }

    public function showUploadImageMen(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      $data = $this->getFiles(0, Sex::getValue('Mand'), 20);
      return view('dashlead.uploadedimage',compact('data'));
    }

    public function showUploadImageWomen(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      $data = $this->getFiles(0, Sex::getValue('Kvinde'), 20);
      return view('dashlead.uploadedimage',compact('data'));
    }
    public function showUploadImageCouple(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      $data = $this->getFiles(0, Sex::getValue('Par'), 20);
      return view('dashlead.uploadedimage',compact('data'));
    }
    public function showUploadVideoAll(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      $data = FileUpload::where('user_type', auth()->user()->portalInfo->portal_id)
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
        ->where('file_type',1)->paginate(12);
      return view('dashlead.uploadedvideo',compact('data'));


      return view('dashlead.uploadedvideo',compact('data'));
    }

    public function showUploadVideoMen(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      $data = $this->getFiles(1, Sex::getValue('Mand'), 12);
      return view('dashlead.uploadedvideo',compact('data'));
    }

    public function showUploadVideoWomen(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      $data = $this->getFiles(1, Sex::getValue('Kvinde'), 12);
      return view('dashlead.uploadedvideo',compact('data'));
    }

    public function showUploadVideoCouple(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

       $data = $this->getFiles(1, Sex::getValue('Par'), 12);
      return view('dashlead.uploadedvideo',compact('data'));
    }

    public function faq(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      return view('dashlead.home_faq');
    }
    
    public function chatRoom(){
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }

      $chatrooms = Chatroom::all();
      return view('chatroom',compact('portalList', 'chatrooms'));
    }
    
    // Old Method
    // public function destroyImage(Request $request $id){
    //     FileUpload::destroy($request->id);
    //      return redirect()->back();
    // }

    public function destroyImage($id){
      FileUpload::destroy($id);
       return redirect()->back();
  }
}
