<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notification;

class NotificationController extends Controller
{
    protected $table = "notifications";

    public function getNotifications(Request $request, $user_id, $who)
    {
        if ($who == "admin") {
            $notifications = DB::table('notifications')->where('id_admin', $user_id)->get();
            return response()->json(['status' => 'success', 'data' => $notifications]);
        }
        else if($who == "user") {
            $notifications = DB::table('notifications')->where('id_provider', $user_id)->get();
            return response()->json(['status' => 'success', 'data' => $notifications]);
        }

    }

    public function getNotificationsCount(Request $request, $user_id, $who)
    {
        if ($who == 'admin') {
            $notifications = DB::table('notifications')->where('id_admin', $user_id)->where('seen', false)->count();
            return response()->json(['status' => 'success', 'count' => $notifications]);
        }
        else if ($who == 'user') {
            $notifications = DB::table('notifications')->where('id_provider', $user_id)->where('seen', false)->count();
            return response()->json(['status' => 'success', 'count' => $notifications]);
        }

    }

    public function setSeen(Request $request, $user_id, $who)
    {
        if ($who == 'admin') {
            $notifications = DB::table('notifications')->where('id_admin', $user_id)->update(['seen' => true]);
            return response()->json(['status' => 'success', 'data' => $notifications]);
        }
        else if ($who == 'user') {
            $notifications = DB::table('notifications')->where('id_provider', $user_id)->update(['seen' => true]);
            return response()->json(['status' => 'success', 'data' => $notifications]);
        }

    }

    public function deleteNotifications(Request $request, $admin_id, $who)
    {
        if ($who == 'admin') {
            DB::table('notifications')->where('id_admin', $admin_id)->delete();
            return response()->json(['status' => 'success', 'data' => 'done']);
        }
        else if ($who == 'user') {
            DB::table('notifications')->where('id_provider', $admin_id)->delete();
            return response()->json(['status' => 'success', 'data' => 'done']);
        }

    }
}
