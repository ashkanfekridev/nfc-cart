<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function index(){
        $users = User::query();
        $users->whereNot('type', 'admin');
        return $users->paginate();
    }



    public function store(StoreUserRequest $userRequest)
    {
        $avatar = $userRequest->file('avatar')->store('avatars');
        $user = User::create([
            'user_name' => $userRequest->user_name,
            'phone_number' => $userRequest->phone_number,
            'password' => Hash::make($userRequest->password),
            "fa_first_name" => $userRequest->fa_first_name,
            "fa_last_name" => $userRequest->fa_last_name,
            "fa_description" => $userRequest->fa_description,
            "en_first_name" => $userRequest->en_first_name,
            "en_last_name" => $userRequest->en_last_name,
            "en_description" => $userRequest->en_description,
            "type" => $userRequest->type,
            "email" => $userRequest->email,
            'avatar' => asset($avatar)
        ]);

        return $user;

    }
}
