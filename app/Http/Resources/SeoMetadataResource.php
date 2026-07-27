<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeoMetadataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [];
        }

        return [
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'keywords' => $this->keywords,
            'canonical_url' => $this->canonical_url,
            'og_title' => $this->og_title ?? $this->meta_title,
            'og_description' => $this->og_description ?? $this->meta_description,
            'og_image' => $this->og_image,
            'twitter_card' => $this->twitter_card,
            'json_ld' => $this->json_ld,
        ];
    }
}
