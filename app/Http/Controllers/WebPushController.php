<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebPushRequest;
use App\Http\Requests\UpdateWebPushRequest;
use App\Models\WebPush;

class WebPushController extends Controller
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
     * @param  \App\Http\Requests\StoreWebPushRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWebPushRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebPush  $webPush
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($app)
    {
        try{
            $webPush = WebPush::where('app_id', $app)->first();

            return response()->json($this->transformData($webPush));

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebPush  $webPush
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(UpdateWebPushRequest $request, $app)
    {
        try{
            $data = $request->validated();

            $webPush = WebPush::where('app_id', $app)->first();

            $channel = $webPush->channel();
            $previousStatus = $channel->status ? true : false;

            $channel->status = $data['status'];
            $channel->save();

            return response()->json([
                'previous_status' => $previousStatus,
                'current_status' => $channel->status,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWebPushRequest  $request
     * @param  \App\Models\WebPush  $webPush
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWebPushRequest $request, WebPush $webPush)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebPush  $webPush
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebPush $webPush)
    {
        //
    }

    public function transformData($webPush)
    {
        return [
            'settings' => [
                'site' => [
                    'name' => $webPush->site_name,
                    'address' => $webPush->site_address,
                    'url_icon' => $webPush->site_url_icon,
                ],
                'alllow_notification' => [
                    'message_text' => $webPush->allow_notification_message_text,
                    'allow_button_text' => $webPush->allow_notification_allow_button_text,
                    'deny_button_text' => $webPush->allow_notification_deny_button_text,
                ],
                'welcome_notification' => [
                    'message_title' => $webPush->welcome_notification_message_title,
                    'message_text' => $webPush->welcome_notification_message_text,
                    'enable_url_redirect' => $webPush->welcome_notification_enable_url_redirect,
                    'url_redirect' => $webPush->welcome_notification_url_redirect,
                ]
            ]
        ];
    }
}
