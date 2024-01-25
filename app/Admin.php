<?php

namespace App;
use App\Model\AdminPermission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUserName($id){
        $model = Admin::find($id);
        if($model){
            return $model->name;
        }else{
            return '';
        }
    }

    public static function checkPermission($user_id,$permission_id){
        if($user_id == 1){
            return true;
        }else{
            $model = AdminPermission::where('admin_id',$user_id)->where('permission_id',$permission_id)->first();
            if($model){
                return true;
            }else{
                return false;
            }
        }
    }
    public static function permissionFormate($data){
        if(sizeof($data)>0){
            foreach ($data as $key => $value) {
                $p = '';
                $model = AdminPermission::where('admin_id',$value->id)->get();
                if(sizeof($model)>0){
                    foreach ($model as $key => $value1) {
                        $p .=$value1->permission->name .', ';
                    }
                    $p = substr($p, 0, -2);
                }
                $value['permission'] = $p;
            }
        }
        return $data;
    }
}
