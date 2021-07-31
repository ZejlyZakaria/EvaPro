<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notification;

class NotificationController extends Controller
{
    protected $table = "notifications";

    public function getNotifications(Request $request, $user_id)
    {
        $notifications = DB::table('notifications')->where('id_provider', $user_id)->get();
        return response()->json(['status' => 'success', 'data' => $notifications]);
    }

    public function getNotificationsCount(Request $request, $user_id)
    {
        $notifications = DB::table('notifications')->where('id_provider', $user_id)->where('seen', false)->count();
        return response()->json(['status' => 'success', 'count' => $notifications]);
    }

    public function setSeen(Request $request, $user_id)
    {
        $notifications = DB::table('notifications')->where('id_provider', $user_id)->update(['seen' => true]);
        return response()->json(['status' => 'success', 'data' => $notifications]);
    }
}
