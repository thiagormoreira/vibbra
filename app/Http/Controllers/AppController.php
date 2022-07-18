<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppRequest;
use App\Models\App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AppController extends Controller
{
    public function store(StoreAppRequest $request)
    {
        try {
            $newApp = $request->validated();

            $app = App::create([
                'name' => $newApp['app_name'],
                'token' => Str::random(9),
                'user_id' => Auth::user()->id,
            ]);

            return response()->json([
                'app_id' => $app->id,
                'app_token' => $app->token,
            ], 201);

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($app_id)
    {
        try {
            $aux = App::findOrFail($app_id);

            return response()->json($aux, 200);

        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'App not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
