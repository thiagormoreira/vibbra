<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Models\App;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        try {

            foreach (Notification::sent()->get() as $notification) {
                $notifications['notifications'][] = [
                    'notification_id' => $notification->id,
                    'send_date' => $notification->send_date,
                ];
            }

            return response()->json($notifications, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreNotificationRequest $request, $app_id)
    {
        try {

            $notificationData = $request->validated();

            $app = App::findOrFail($app_id);
            $channel = $app->channel;
            $webPush = $app->webPush;

            if(!$channel->status){
                return response()->json([
                    'error' => 'Channel is not active'
                ], 401);
            }

            $webPush->site_url_icon = $notificationData['icon_url'];
            $webPush->welcome_notification_url_redirect = $notificationData['redirect_url'];
            $webPush->save();

            $notification = Notification::create([
                'message_title' => $notificationData['message_title'],
                'message_text' => $notificationData['message_text'],
                'app_id' => $app->id,
                'channel_id' => $channel->id
            ]);

            return response()->json($this->transformData($notification, $webPush), 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($app_id, $channel, $notification_id)
    {
        try {
            $notification = Notification::findOrFail($notification_id);
            $app = App::findOrFail($app_id);
            $webPush = $app->webPush;

            return response()->json($this->transformData($notification, $webPush), 200);

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
