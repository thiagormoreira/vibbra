<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\StoreSmsRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Http\Requests\StoreWebPushRequest;
use App\Models\Email;
use App\Models\Sms;
use App\Models\WebPush;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
                    $storeEmailRequest = new StoreEmailRequest();
                    $data = $request->validate($storeEmailRequest->rules(), $storeEmailRequest->messages());

                    $formattedData = Email::formatData($data);

                    $channelInstance = Email::updateOrCreate([
                        'app_id' => $app_id,
                    ], $formattedData);

                    return response()->json(Email::transformData($channelInstance));
                    break;

                case 'sms':
                    $storeSmsRequest = new StoreSmsRequest();
                    $data = $request->validate($storeSmsRequest->rules(), $storeSmsRequest->messages());

                    $formattedData = Sms::formatData($data);

                    $channelInstance = Sms::updateOrCreate([
                        'app_id' => $app_id,
                    ], $formattedData);

                    return response()->json(Sms::transformData($channelInstance));
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

        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'App not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit(UpdateChannelRequest $request, $app, $channel)
    {
        try{
            $data = $request->validated();

            switch ($channel){
                case 'webpushes':

                    $webPush = WebPush::where('app_id', $app)->firstOrFail();

                    $channel = $webPush->channel();

                    break;

                case 'emails':

                    $email = Email::where('app_id', $app)->firstOrFail();

                    $channel = $email->channel();

                    break;

                case 'sms':

                    $sms = Sms::where('app_id', $app)->firstOrFail();

                    $channel = $sms->channel();

                    break;

                default:
                    return response()->json([
                        'message' => "Invalid channel",
                    ], 404);
            }

            $previousStatus = $channel->status ? true : false;

            $channel->changeStatus($data['status']);

            return response()->json([
                'previous_status' => $previousStatus,
                'current_status' => $channel->status,
            ]);

        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Channel not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
