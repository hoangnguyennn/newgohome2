<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAllAsRead(Request $request)
    {
        $userId = $request->userId;
        $user = User::find($userId);
        $user->unreadNotifications->markAsRead();

        return 'xong';
    }
}
