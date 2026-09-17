<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class PublishBlogImagesSeeder extends Seeder
{
    /**
     * Run the database seeds to update all blogs with their unique featured images and alt texts.
     */
    public function run(): void
    {
        $blogs = Blog::all();
        $updatedCount = 0;

        foreach ($blogs as $blog) {
            $imagePath = "/assets/images/blogs/{$blog->slug}.jpg";
            $altText = "{$blog->title} - Peshal Bhattarai Executive Thought Leadership";

            $blog->update([
                'featured_image' => $imagePath,
                'featured_image_alt' => $altText,
            ]);
            $updatedCount++;
        }

        $this->command->info("Successfully updated {$updatedCount} unique blog featured images in database.");
    }
}
