<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\SeoMetadata;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurgeUnwantedBlogsSeeder extends Seeder
{
    public function run(): void
    {
        // 41 Whitelisted Master Article Slugs
        $allowedSlugs = [
            'scaling-agile-frameworks-in-enterprise-software-architecture',
            'the-blueprint-for-legacy-application-migration-to-laravel-12',
            'international-seo-architecture-building-for-multi-country-markets',
            'smart-agritech-scaling-iot-automation-in-remote-farm-monitoring',
            'digital-transformation-in-fintech-architecture-for-legacy-modernization',
            'building-a-high-performance-nextjs-15-app-router-frontend',
            'what-does-a-fractional-cto-do-startup-guide',
            'how-to-hire-a-dedicated-remote-development-team',
            'scrum-master-vs-agile-coach-team-guide',
            'hipaa-compliant-laravel-architecture-developer-checklist',
            'how-i-built-an-iot-agritech-company-nepal-thoplo-machine',
            'digital-transformation-roadmap-4-step-framework',
            'how-to-run-a-sprint-retrospective-guide',
            'building-a-saas-product-roadmap-90-days',
            'why-most-software-startups-fail-at-product-market-fit',
            'the-strangler-fig-pattern-migrating-legacy-monoliths-without-downtime',
            'remote-team-management-tools-checklist',
            'how-to-prepare-a-technical-pitch-deck-for-series-a-investors',
            'enterprise-digital-transformation-playbook-2026',
            'how-to-hire-and-manage-remote-software-developers-in-nepal',
            'answer-engine-optimization-aeo-playbook-2026',
            'dubai-real-estate-investment-guide-for-founders',
            'private-everest-base-camp-helicopter-expedition-guide',
            'nepal-fdi-and-tech-market-entry-guide-2026',
            'digital-marketing-and-aeo-roi-benchmarks-nepal-dubai',
            'saas-product-architecture-microservices-cto-guide',
            'dubai-off-plan-vs-ready-villas-financial-model',
            'nepal-helicopter-expedition-aviation-safety-blueprint',
            'executive-guide-to-it-project-outsourcing',
            'executive-it-outsourcing-blueprint-vendor-selection',
            'scale-offshore-development-squads-nepal-guide',
            'saas-backlog-prioritization-frameworks-rice-kano-moscow',
            'cross-border-real-estate-tech-wealth-dubai-kathmandu',
            'generative-engine-optimization-geo-strategy-b2b-saas',
            'fractional-cto-vs-fulltime-vp-engineering-guide',
            'how-to-audit-outsourced-codebase-cto-guide',
            'digital-marketing-roi-benchmarks-2026-seo-paid-aeo',
            'entrepreneurs-playbook-bootstrapping-multi-venture-ecosystems',
            'launch-scale-tech-subsidiary-nepal-guide',
            'international-brand-building-authority-marketing-guide',
            'luxury-tourism-adventure-operations-everest-helicopter-guide',
        ];

        // 1. Identify blogs to delete
        $unwantedBlogs = Blog::whereNotIn('slug', $allowedSlugs)->get();
        $unwantedIds = $unwantedBlogs->pluck('id')->toArray();
        $count = count($unwantedIds);

        if ($count > 0) {
            // Delete SEO metadata for unwanted blogs
            SeoMetadata::where('model_type', Blog::class)
                ->whereIn('model_id', $unwantedIds)
                ->delete();

            // Delete blog tag pivot relations
            DB::table('blog_tag_post')->whereIn('blog_id', $unwantedIds)->delete();

            // Delete unwanted blogs
            Blog::whereIn('id', $unwantedIds)->delete();

            $this->command->info("Purged {$count} unwanted/legacy draft blogs from database.");
        } else {
            $this->command->info("No unwanted blogs found. Database is 100% clean with 41 master articles.");
        }

        // Clean orphaned SEO metadata records if any exist
        $remainingBlogIds = Blog::pluck('id')->toArray();
        $orphanedSeo = SeoMetadata::where('model_type', Blog::class)
            ->whereNotIn('model_id', $remainingBlogIds)
            ->delete();

        if ($orphanedSeo > 0) {
            $this->command->info("Purged {$orphanedSeo} orphaned SEO metadata records.");
        }
    }
}
