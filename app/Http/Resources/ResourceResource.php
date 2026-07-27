<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceResource extends JsonResource
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
            'type' => $this->type,
            'description' => $this->description,
            'file_path' => $this->file_path,
            'cover_image' => $this->cover_image,
            'download_count' => $this->download_count,
            'is_active' => $this->is_active,
            'seo' => new SeoMetadataResource($this->whenLoaded('seo')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
