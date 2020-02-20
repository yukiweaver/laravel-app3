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
    $notifyIds = $request->input('notifyIds');
    Log::debug($notifyIds);
    if (empty($notifyIds)) {
      return response()->json();
    }
    $dbParams = [
      'read_flg' => true,
    ];
    $result = Notification::notifyUpdate($dbParams, $notifyIds);
    if (is_array($result)) {
      return $this->putjsonError($result);
    }

    return response()->json($notifyIds);
    // dd($params);
  }

  private function putjsonError($data)
  {
    $array = [
      'status'  => 'ng',
      'content' => $data, 
    ];
    return json_encode($array);
  }

  private function putjsonSuccess($data)
  {
    $array = [
      'status'  => 'ok',
      'content' => $data, 
    ];
    return json_encode($array);
  }
}
