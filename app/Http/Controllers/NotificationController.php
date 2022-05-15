<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        return redirect()->route($route);
    }
}
