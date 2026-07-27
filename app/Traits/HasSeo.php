<?php

namespace App\Traits;

use App\Models\SeoMetadata;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeo
{
    /**
     * Get the SEO metadata for the model.
     */
    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'model', 'model_type', 'model_id');
    }
}
