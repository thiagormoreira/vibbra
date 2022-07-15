<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function store(StoreUserRequest $request, User $user)
    {
        try {
            $userData = $request->validated();

            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'phone_number' => $userData['phone_number'],
                'password' => bcrypt($userData['password']),
            ]);

            $company = Company::create([
                'name' => $userData['company_name'],
                'address' => $userData['company_address'],
            ]);

            $user->company()->associate($company);

            return response()->json($user, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($user_id)
    {
        try {
            $user = User::findOrfail($user_id);

            return response()->json($user, 200);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'error' => 'User not found'
            ], 404);
        }
    }
}
