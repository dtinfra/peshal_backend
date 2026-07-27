<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'client_name' => $this->client_name,
            'client_image' => $this->client_image,
            'company_name' => $this->company_name,
            'position' => $this->position,
            'rating' => $this->rating,
            'review' => $this->review,
            'video_url' => $this->video_url,
            'is_featured' => $this->is_featured,
            'country' => $this->country,
        ];
    }
}
