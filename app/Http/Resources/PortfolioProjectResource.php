<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioProjectResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'client_name' => $this->client_name,
            'summary' => $this->summary,
            'content' => $this->content,
            'main_image' => $this->main_image,
            'gallery' => $this->gallery,
            'technologies' => $this->technologies,
            'business_outcomes' => $this->business_outcomes,
            'results_summary' => $this->results_summary,
            'website_url' => $this->website_url,
            'is_featured' => $this->is_featured,
            'order' => $this->order,
            'seo' => new SeoMetadataResource($this->whenLoaded('seo')),
        ];
    }
}
