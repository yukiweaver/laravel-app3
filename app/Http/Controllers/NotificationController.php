<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\User;
use Log;

class NotificationController extends Controller
{
  public function index(Request $request)
  {
    $ipAddr = User::find(request()->ip())->ip_address;
    $notifications = Notification::findByIpAddr($ipAddr);
    // $ids = [];
    // foreach ($notifications as $value) {
    //   $ids[] = $value->id;
    // }
    // Log::debug($ids);
    return response()->json($notifications);
  }
}
