<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Register a new user
     * @param Request $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()
                ->json($validator->errors());
        }
        $user = User::create([
            'user_name' => $request->user_name,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            "fa_first_name" => $request->fa_first_name,
            "fa_last_name" => $request->fa_last_name,
            "en_first_name" => $request->en_first_name,
            "en_last_name" => $request->en_last_name,
            "email" => $request->email
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->token = $token;
        return new UserResource($user);

    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('user_name', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('user_name', $request['user_name'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->token = $token;
        return new UserResource($user);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ]);
    }
}
