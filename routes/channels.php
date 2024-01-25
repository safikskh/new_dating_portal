<?php

use Illuminate\Support\Facades\Broadcast;
Broadcast::channel('user.{reciver}', function($user, $reciver) {
    return (int)$user->id === (int)$reciver;
});

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
// For Chatroom
Broadcast::channel('chatroom.{currentroom}', function($user, $currentroom) {
    return $user;
});

Broadcast::channel('online', function ($user) {
    return $user;
});