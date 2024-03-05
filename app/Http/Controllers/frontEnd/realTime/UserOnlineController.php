<?php

namespace App\Http\Controllers\frontEnd\realTime;

use App\User;
use App\Events\UserOnline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserOnlineController extends Controller
{
    public function __invoke(User $user)
    {
        $user->status = 'online';
        $user->save();

        broadcast(new UserOnline($user));
    }
    public function authOnline()
    {
        $user = User::find(auth()->id());
        $user->status = 'online';
        $user->save();

        broadcast(new UserOnline($user));
    }
}
