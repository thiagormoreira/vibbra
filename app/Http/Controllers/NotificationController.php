<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\App;
use App\Models\Channel;
use App\Models\Notification;
use App\Models\WebPush;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNotificationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreNotificationRequest $request, $app_id)
    {
        try {
            $notificationData = $request->validated();

            $app = App::findOrFail($app_id);
            $channel = $app->channel()->first();

            $notification = Notification::create([
                'message_title' => $notificationData['message_title'],
                'message_text' => $notificationData['message_text'],
                'app_id' => $app->id,
                'channel_id' => $channel->id
            ]);

            return response()->json([
                "audience_segments" => [
                    "audience_segment1",
                    "Audience_segment2",
                    "audience_segment3"
                ],
                "message_title" => $notification->message_title,
                "message_text" => $notification->message_text,
                "icon_url" => $channel->webPush()->icon_url,
                "redirect_url" => $channel->redirect_url,
                "app_id" => $app->id,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotificationRequest  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
