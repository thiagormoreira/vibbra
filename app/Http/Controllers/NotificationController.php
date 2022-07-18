<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Models\App;
use App\Models\Notification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        try {

            if($request->has('initdate', 'enddate')) {
                $notifications = Notification::sentDateBetween($request->initdate, $request->enddate)->get();
            } else {
                return response()->json([
                    'message' => 'Initdate and enddate are required',
                ], 400);
            }

            foreach ($notifications as $notification) {
                $data['notifications'][] = [
                    'notification_id' => $notification->id,
                    'send_date' => $notification->send_date,
                ];
            }

            return response()->json($data ?? ['message' => 'No notifications found']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreNotificationRequest $request, $app_id, $channel)
    {
        try {

            $notificationData = $request->validated();

            $app = App::findOrFail($app_id);

            if(!$app->channel->status){
                return response()->json([
                    'error' => 'Channel is not active'
                ], 401);
            }

            switch ($channel){
                case 'webpushes':
                    $webPush = $app->webPush;
                    $webPush->site_url_icon = $notificationData['icon_url'];
                    $webPush->welcome_notification_url_redirect = $notificationData['redirect_url'];
                    $webPush->save();

                    $notification = Notification::create([
                        'message_title' => $notificationData['message_title'],
                        'message_text' => $notificationData['message_text'],
                        'app_id' => $app->id,
                        'channel_id' => $app->channel->id
                    ]);

                    return response()->json($this->transformData($notification, $webPush), 201);
                    break;

                default:
                    return response()->json([
                        'message' => "Invalid channel",
                    ], 404);

            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($app_id, $channel, $notification_id)
    {
        try {
            $notification = Notification::findOrFail($notification_id);
            $app = App::findOrFail($app_id);

            switch ($channel){
                case 'webpushes':
                    $webPush = $app->webPush;
                    return response()->json($webPush->transformData($notification, $webPush));
                    break;
                case 'emails':
                    $email = $app->email;
                    return response()->json($email->transformData($notification, $email));
                    break;
                case 'sms':
                    $sms = $app->sms;
                    return response()->json($sms->transformData($notification, $sms));
                    break;
                default:
                    return response()->json([
                        'message' => "Invalid channel",
                    ], 404);
            }

        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Notification not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function transformData($notification, $webPush)
    {
        return [
            "audience_segments" => [
                "audience_segment1",
                "Audience_segment2",
                "audience_segment3"
            ],
            "message_title" => $notification->message_title,
            "message_text" => $notification->message_text,
            "icon_url" => $webPush->site_url_icon,
            "redirect_url" => $webPush->welcome_notification_url_redirect,
            "app_id" => $notification->app_id,
        ];
    }
}
