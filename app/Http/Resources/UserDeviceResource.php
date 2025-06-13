<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentToken = $request->user()->currentAccessToken();
        return [
            'id' => $this->id,
            'device_name' => $this->device_name,
            'device_type' => $this->device_type,
            'platform' => $this->platform,
            'last_active_at' => $this->last_active_at ? $this->last_active_at->toDateTimeString() : null,
            'is_current' => $currentToken && $currentToken->id === $this->token_id,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
