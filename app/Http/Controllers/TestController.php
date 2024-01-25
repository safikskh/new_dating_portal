<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index(){
        
        //  DB::statement('ALTER TABLE portal_join_users MODIFY bodyType ENUM('Gennemsnitlig','Slank','Atletisk','Spinkel','Kraftig','Muskuløs','Buttet') AFTER searching;');
        // DB::statement("ALTER TABLE portal_join_users MODIFY COLUMN bodyType ENUM(['Gennemsnitlig','Atletisk','Spinkel','Kraftig','Muskuløs','Buttet','Slank'])");
        //  return getRegisterPortalIdArrayByAuth();
    }
}
