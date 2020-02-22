<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\User;
use Log;
use App\Http\Requests\NotificationRequest;

class NotificationController extends Controller
{
  public function index(Request $request)
  {
    $ipAddr = User::find(request()->ip())->ip_address;
    $notifications = Notification::findByIpAddr($ipAddr);
    return response()->json($notifications);
  }

  /**
   * 既読更新アクション
   */
  public function update(NotificationRequest $request)
  {
    $notifyIds = $request->input('notifyIds');
    if (empty($notifyIds)) {
      return putjsonError(['error' => '通知を選択してください。']);
    }
    $dbParams = [
      'read_flg' => true,
    ];
    $result = Notification::notifyUpdate($dbParams, $notifyIds);
    if (is_array($result)) {
      return putjsonError($result);
    }

    return putjsonSuccess($notifyIds);
  }
}
