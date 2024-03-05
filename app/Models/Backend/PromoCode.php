<?php

namespace App\Models\Backend;

use App\Models\Backend\PromoCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'promoCode','quantity','type','discount','edate'
    ];

    public static function findByCode($code)
    {
        return self::where('promoCode', $code)->first();
    }

    public function discount($total, $isFixed)
    { 
        if ($isFixed) {
            return round($this->discount);
        }else{
            return round(($this->discount / 100) * $total);

        }
    }

    public static function insertData($data, $stripeApiKey){

      $value = DB::table('promo_codes')->where('promoCode', $data['promoCode'])->get();
      if($value->count() == 0 && $data['promoCode'] != "promoCode"){
        if($data['isFixed']){
            $type = "amount_off";
            $currency = "DKK";
            $discount = $data['discount'] * 100;
        }else{
            $type = "percent_off";
            $currency = null;
            $discount = $data['discount'];
        }
        \Stripe\Stripe::setApiKey('sk_live_8553vxXfiTNfDCFpTt9xt8ad00JFhsokTf');
        $coupon = \Stripe\Coupon::create([
            'duration' => $data['duration'],
            'id' => $data['promoCode'],
            $type => $discount,
            'currency' => $currency,
            'redeem_by' => strtotime($data['edate']),
        ]);
        // $data->save();
         DB::table('promo_codes')->insert($data);
      }
   }
}
