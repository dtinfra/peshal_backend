<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaseStudyResource extends JsonResource
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
            'problem' => $this->problem,
            'solution' => $this->solution,
            'technology' => $this->technology,
            'approach' => $this->approach,
            'timeline_duration' => $this->timeline_duration,
            'challenges' => $this->challenges,
            'results' => $this->results,
            'roi_percentage' => $this->roi_percentage,
            'portfolio_project' => new PortfolioProjectResource($this->whenLoaded('portfolioProject')),
            'seo' => new SeoMetadataResource($this->whenLoaded('seo')),
        ];
    }
}
