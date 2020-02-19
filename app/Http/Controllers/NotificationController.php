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
    return response()->json($notifications);
  }

  public function update(Request $request)
  {
    $params = $request->notify;
    Log::debug($params);
    dd($params);
  }
}
