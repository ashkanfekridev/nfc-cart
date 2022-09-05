<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'user_name'=>$this->user_name,
                'fa_first_name' => $this->fa_first_name,
                'fa_last_name' => $this->fa_last_name,
                'en_first_name' => $this->en_first_name,
                'en_last_name' => $this->en_last_name,
                'email' => $this->email
            ],
            'access_token' => $this->token,
            'token_type' => 'Bearer',
        ];
    }
}
