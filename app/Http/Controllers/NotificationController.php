<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match($request->create($url))->getName();

        return redirect()->route($route);
    }
}
