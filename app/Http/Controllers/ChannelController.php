<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChannelRequest;
use App\Http\Requests\StoreWebPushRequest;
use App\Models\Email;
use App\Models\Sms;
use App\Models\WebPush;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChannelController extends Controller
{
    public function store($app_id, $channel, Request $request)
    {
        try {

            switch ($channel){
                case 'webpushes':
                    $storeWebPushRequest = new StoreWebPushRequest();
                    $data = $request->validate($storeWebPushRequest->rules(), $storeWebPushRequest->messages());

                    $formattedData = WebPush::formatData($data);

                    $channelInstance = WebPush::updateOrCreate([
                        'app_id' => $app_id,
                    ], $formattedData);

                    return response()->json(WebPush::transformData($channelInstance));
                    break;

                case 'emails':
                    return response()->json([
                        'message' => 'Not implemented yet'
                    ], 400);
                    break;

                case 'sms':
                    return response()->json([
                        'message' => 'Not implemented yet'
                    ], 400);
                    break;

                default:
                    return response()->json([
                        'message' => "Invalid channel",
                    ], 404);
            }
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

    public function show($app, $channel)
    {
        try{

            switch ($channel){
                case 'webpushes':
                    $webPushConfig = WebPush::where('app_id', $app)->first();

                    return response()->json(WebPush::transformData($webPushConfig));
                    break;

                case 'emails':
                    $emailConfig = Email::where('app_id', $app)->first();

                    return response()->json(Email::transformData($emailConfig));
                    break;

                case 'sms':
                    $smsConfig = Sms::where('app_id', $app)->first();

                    return response()->json(Sms::transformData($smsConfig));
                    break;

                default:
                    return response()->json([
                        'message' => "Invalid channel",
                    ], 404);

            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit(UpdateChannelRequest $request, $app, $channel)
    {
        try{
            $data = $request->validated();

            switch ($channel){
                case 'webpushes':

                    $webPush = WebPush::where('app_id', $app)->first();

                    $channel = $webPush->channel();
                    $previousStatus = $channel->status ? true : false;

                    $channel->status = $data['status'];
                    $channel->save();
                    break;

                case 'emails':
                    return response()->json([
                        'message' => 'Not implemented yet'
                    ], 400);
                    break;

                case 'sms':
                    return response()->json([
                        'message' => 'Not implemented yet'
                    ], 400);
                    break;
            }

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
}
