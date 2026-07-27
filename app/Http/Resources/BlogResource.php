<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'summary' => $this->summary,
            'content' => $this->content,
            'featured_image' => $this->featured_image,
            'reading_time' => $this->reading_time,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at?->toIso8601String(),
            'author' => [
                'name' => $this->author->name,
                'slug' => $this->author->slug,
                'avatar' => $this->author->avatar,
                'bio' => $this->author->bio,
                'designation' => $this->author->designation,
                'social_links' => $this->author->social_links,
            ],
            'category' => [
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ],
            'tags' => $this->tags->map(fn($tag) => [
                'name' => $tag->name,
                'slug' => $tag->slug,
            ]),
            'seo' => new SeoMetadataResource($this->whenLoaded('seo')),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
