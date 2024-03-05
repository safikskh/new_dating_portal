<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\User;
use App\Models\PortalJoinUser;
use DB;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;


class CustomerController extends Controller
{
 
    public function getUserList(Request $request){
        $data = PortalJoinUser::orderBy('id','ASC')->get();
        // dd($data);
        return view('cbs.backend.customers',compact('data'));
        // dd('hello');
    }   
}