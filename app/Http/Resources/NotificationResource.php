<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'message' => $this->data['message'] ?? '',
            'event_id' => $this->data['event_id'] ?? null,
            'event_title' => $this->data['event_title'] ?? '',
            'assigned_by' => $this->data['assigned_by'] ?? '',
            'read_at' => $this->read_at,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
