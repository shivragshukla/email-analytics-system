<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignMetricResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'emails_sent' => $this->emails_sent,
            'emails_delivered' => $this->emails_delivered,
            'emails_opened' => $this->emails_opened,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
