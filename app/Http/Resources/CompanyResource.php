<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'slug' => $this->slug,
            'logo' => $this->logo,
            'description' => $this->description,
            'content' => $this->content,
            'website_url' => $this->website_url,
            'services' => $this->services,
            'locations' => $this->locations,
            'order' => $this->order,
            'story' => $this->story,
            'mission' => $this->mission,
            'technologies' => $this->technologies,
            'industries' => $this->industries,
            'faqs' => $this->faqs,
            'related_services' => $this->related_services,
            'seo' => new SeoMetadataResource($this->whenLoaded('seo')),
        ];
    }
}
