<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWebPushRequest;
use App\Http\Requests\StoreWebPushRequest;
use App\Models\WebPush;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class ChannelController extends Controller
{
    public function store($app_id, $channel, \Illuminate\Http\Request $request)
    {
        try {

            switch ($channel){
                case 'webpushes':
                    //$request = new StoreWebPushRequest();
                    //$data = $request->validated();
                    $data = $request->all();

                    $formattedData = $this->formatData($data);

                    $channelInstance = WebPush::updateOrCreate([
                        'app_id' => $app_id,
                    ], $formattedData);
                    break;

            }

            return response()->json($this->transformData($channelInstance));
        }
        catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 400);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

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

    private function transformData(WebPush $webPush)
    {
        return [
            'settings' => [
                'site' => [
                    'name' => $webPush->site_name,
                    'address' => $webPush->site_address,
                    'url_icon' => $webPush->site_url_icon,
                ],
                'allow_notification' => [
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

    private function formatData(array $data)
    {
        return [
            'site_name' => $data['settings']['site']['name'],
            'site_address' => $data['settings']['site']['address'],
            'site_url_icon' => $data['settings']['site']['url_icon'],
            'allow_notification_message_text' => $data['settings']['allow_notification']['message_text'],
            'allow_notification_allow_button_text' => $data['settings']['allow_notification']['allow_button_text'],
            'allow_notification_deny_button_text' => $data['settings']['allow_notification']['deny_button_text'],
            'welcome_notification_message_title' => $data['settings']['welcome_notification']['message_title'],
            'welcome_notification_message_text' => $data['settings']['welcome_notification']['message_text'],
            'welcome_notification_enable_url_redirect' => $data['settings']['welcome_notification']['enable_url_redirect'],
            'welcome_notification_url_redirect' => $data['settings']['welcome_notification']['url_redirect'],
        ];
    }
}
