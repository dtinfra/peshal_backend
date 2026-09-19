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
            'featured_image_alt' => $this->featured_image_alt,
            'reading_time' => $this->reading_time,
            'faqs' => $this->faqs ?? [],
            'category_id' => $this->category_id,
            'author_id' => $this->author_id,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at?->toIso8601String(),
            'author' => [
                'id' => $this->author?->id,
                'name' => $this->author?->name,
                'slug' => $this->author?->slug,
                'avatar' => $this->author?->avatar,
                'bio' => $this->author?->bio,
                'designation' => $this->author?->designation,
                'social_links' => $this->author?->social_links,
            ],
            'category' => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ] : null,
            'tags' => $this->tags->map(fn($tag) => [
                'id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug,
            ]),
            'seo' => new SeoMetadataResource($this->whenLoaded('seo')),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
