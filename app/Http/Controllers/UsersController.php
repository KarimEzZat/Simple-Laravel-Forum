<?php

namespace LaravelForum\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function notifications()
    {
        // mark all as read
        if (!auth()->user())
        {
            return redirect()->route('login');
        }
        else
        {
            auth()->user()->unReadNotifications->markAsRead();
        }
        // display all notifications

        return view('users.notifications')->with('notifications', auth()->user()->notifications);
    }
}
