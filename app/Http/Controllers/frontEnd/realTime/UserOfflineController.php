<?php

namespace App\Http\Controllers\frontEnd\realTime;

use App\User;
use App\Events\UserOffline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserOfflineController extends Controller
{
    public function __invoke(User $user)
    {
        $user->status = 'offline';
        $user->save();

        broadcast(new UserOffline($user));
    }
}
