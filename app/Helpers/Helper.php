<?php 

use App\User;
use App\Enums\Sex;
use Carbon\Carbon;
use App\Models\Blogs;
use App\Models\Events;
use App\Models\Groups;
use App\Models\Status;
use App\Models\Favourite;
use App\Models\PortalJoinUser;
use App\Models\VisitedProfile;
use App\Models\UserPromotation;
use App\Models\Backend\Announcement;
use Illuminate\Support\Facades\Auth;

if (!function_exists('callRakib')) {
    function callRakib(){
        return "Welcome rakib";
    }
}
if (!function_exists('getRegisterPortalIdArrayByAuth')) {
    function getRegisterPortalIdArrayByAuth(){
        $Array = PortalJoinUser::where('user_id', auth()->id())
        ->whereNotIn('portal_id',[4,5,6])->pluck('portal_id')->toArray();
        return $Array;
    }
}
if (!function_exists('announcements')) {
    function announcements(){
        return Announcement::where('portal_id',1)
            ->orderBy('updated_at', 'DESC')->limit(4)->get();
    }
}
if (!function_exists('statuses')) {
    function statuses(){
        return Status::where([['status_ends_at', '>' ,Carbon::now()],['portal_id', 1]])
            ->inRandomOrder()->limit(4)->get();
    }
}
if (!function_exists('visitedProfiles')) {
    function visitedProfiles(){
        return VisitedProfile::where('portal_id', 1)
            ->orderBy('id','DESC')
            ->groupBy('visited_id')
            ->limit(9)->get();
    }
}
if (!function_exists('latestProfiles')) {
    function latestProfiles(){
        return User::whereIn('id', getAllPortalUserByPortalId(1))
            ->orderBy('created_at', 'DESC')->limit(9)->get();
    }
}
if (!function_exists('favoriteProfiles')) {
    function favoriteProfiles(){
        return Favourite::with('userFavourite')
            ->orderBy('id', 'DESC')
            ->where('favourite_by', User::all()->random()->id)
            ->where('portal_id', 1)
            ->where('favourite_status', 0)
            ->limit(9)->get();
    }
}
if (!function_exists('latestGroup')) {
    function latestGroup(){
        return Groups::where('type', 1)
            ->orderBy('id','DESC')->limit(1)->get();
    }
}
if (!function_exists('latestBlogs')) {
    function latestBlogs(){
        return Blogs::where('type', 1)
            ->orderBy('id','DESC')->limit(1)->get();
    }
}
if (!function_exists('latestEvent')) {
    function latestEvent(){
        return Events::where('type', 1)
            ->orderBy('id','DESC')->limit(1)->get();
    }
}
if (!function_exists('getAllPortalUserByPortalId')) {
    function getAllPortalUserByPortalId($id){
       return PortalJoinUser::where([['user_id','!=', Auth::id()],['portal_id', $id]])->pluck('user_id')->toArray();
    }
}
if (!function_exists('totalShowPromotion')) {
    function totalShowPromotion($i){
        $count = 0;
        for($i; $i < sizeof(getAllPromotionImageByPortalId(1)); $i+=4){
            $count++;
        }
        return  $count;
    }
}
if (!function_exists('getAllPromotionImageByPortalId')) {
    function getAllPromotionImageByPortalId($id){
        return UserPromotation::where([['promotion_ends_at', '>' ,Carbon::now()],['portal_type',$id]])
        ->get();
    }
}
if (!function_exists('getRandomUserBySex')) {
    function getRandomUserBySex($sex){
        if ($sex == Sex::getValue('Par')) {
            $userIds = PortalJoinUser::where('portal_id', 1)->pluck('user_id')->toArray();
             return User::whereIn('id',$userIds)->inRandomOrder()->limit(3)->get();
        } else {
            $userIds = PortalJoinUser::where([['sex', $sex],['portal_id', 1]])->pluck('user_id')->toArray();
             return User::whereIn('id',$userIds)->inRandomOrder()->limit(3)->get();
        }
        
    }
}
if (!function_exists('imageOrientation')) {
    function imageOrientation($filename){
        if (function_exists('exif_read_data')) {
    $exif = exif_read_data($filename);
    if($exif && isset($exif['Orientation'])) {
      $orientation = $exif['Orientation'];
      if($orientation != 1){
        $img = imagecreatefromjpeg($filename);
        $deg = 0;
        switch ($orientation) {
          case 3:
            $deg = 180;
            break;
          case 6:
            $deg = 270;
            break;
          case 8:
            $deg = 90;
            break;
        }
        if ($deg) {
          $img = imagerotate($img, $deg, 0);        
        }
        // then rewrite the rotated image back to the disk as $filename 
        imagejpeg($img, $filename, 95);
      } // if there is some rotation necessary
    } // if have the exif orientation info
  } // if function exists   
        
    }
}
if(!function_exists('promoCodeStore')){
    function promoCodeStore(Request $request){
        $coupon = PromoCode::where([['promoCode', $request->coupon_code],['edate','>', Carbon::now()],['isUsed',0]])->first();
        if (!$coupon) {
            return back()->with('error','Invalid coupon code. Please try again.');
        }
        if($coupon->promoCode == "TG2019" || $coupon->promoCode == "FL2019" || $coupon->promoCode == "DPFB"
        || $coupon->promoCode == "DPIG" || $coupon->promoCode == "DPLOVE" || $coupon->promoCode == "DPMIX"
        || $coupon->promoCode == "DPSINGLE" || $coupon->promoCode == "promo"){
             session()->put('coupon',[
                'name' => $coupon->promoCode,
                'mddiscount' => $coupon->discount(Membership::where('slug','md')->first()->cost, $coupon->isFixed),
                'ugodiscount' => 0,
                'weekenddiscount' => 0,
                'daydiscount' => 0,
                // 'kvartaldiscount' => 0,
                // 'arllgdiscount' => 0,
                // 'ardiscount' => 0,
                '2weekdiscount' => 0,
            ]);

        }else {
            session()->put('coupon',[
                'name' => $coupon->promoCode,
                'mddiscount' => $coupon->discount(Membership::where('slug','md')->first()->cost, $coupon->isFixed),
                'ugodiscount' => $coupon->discount(Membership::where('slug','ugo')->first()->cost,$coupon->isFixed),
                'weekenddiscount' => $coupon->discount(Membership::where('slug','weekend')->first()->cost,$coupon->isFixed),
                'daydiscount' => $coupon->discount(Membership::where('slug','day')->first()->cost,$coupon->isFixed),
                // 'kvartaldiscount' => $coupon->discount(Membership::where('slug','kvartal')->first()->cost,$coupon->isFixed),
                // 'arllgdiscount' => $coupon->discount(Membership::where('slug','arllg')->first()->cost,$coupon->isFixed),
                // 'ardiscount' => $coupon->discount(Membership::where('slug','ar')->first()->cost,$coupon->isFixed),
                '2weekdiscount' => 0,
            ]);
        }

        return redirect()->back()->with('successs', 'Coupon has been applied!');
    }
}


