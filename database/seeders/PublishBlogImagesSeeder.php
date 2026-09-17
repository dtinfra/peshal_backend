<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class PublishBlogImagesSeeder extends Seeder
{
    /**
     * Run the database seeds to update all blogs with relevant featured images and alt texts.
     */
    public function run(): void
    {
        $imageMap = [
            'scaling-agile-frameworks-in-enterprise-software-architecture' => [
                'image' => '/assets/images/blogs/agile-software-architecture.jpg',
                'alt' => 'Enterprise Agile Software Architecture and Microservices Framework Blueprint',
            ],
            'the-blueprint-for-legacy-application-migration-to-laravel-12' => [
                'image' => '/assets/images/blogs/legacy-migration-blueprint.jpg',
                'alt' => 'Legacy Monolith to Laravel 12 Microservices Application Migration Blueprint',
            ],
            'international-seo-architecture-building-for-multi-country-markets' => [
                'image' => '/assets/images/blogs/aeo-geo-search-optimization.jpg',
                'alt' => 'International SEO & Multi-Region Search Engine Optimization Strategy',
            ],
            'smart-agritech-scaling-iot-automation-in-remote-farm-monitoring' => [
                'image' => '/assets/images/blogs/smart-agritech-iot-farm.jpg',
                'alt' => 'Smart Agritech IoT Automation and Remote Drip Irrigation Sensors in Nepal',
            ],
            'digital-transformation-in-fintech-architecture-for-legacy-modernization' => [
                'image' => '/assets/images/blogs/digital-marketing-roi-analytics.jpg',
                'alt' => 'Fintech Digital Transformation and Cloud Architecture Modernization',
            ],
            'building-a-high-performance-nextjs-15-app-router-frontend' => [
                'image' => '/assets/images/blogs/agile-software-architecture.jpg',
                'alt' => 'Next.js 15 App Router Frontend High Performance Architecture',
            ],
            'what-does-a-fractional-cto-do-startup-guide' => [
                'image' => '/assets/images/blogs/fractional-cto-leadership.jpg',
                'alt' => 'Fractional CTO Advisory for Scaling Technology Startups',
            ],
            'how-to-hire-a-dedicated-remote-development-team' => [
                'image' => '/assets/images/blogs/offshore-development-squads.jpg',
                'alt' => 'Dedicated Remote Software Development Team in Nepal',
            ],
            'scrum-master-vs-agile-coach-team-guide' => [
                'image' => '/assets/images/blogs/agile-sprint-retrospective.jpg',
                'alt' => 'Scrum Master vs Agile Coach Team Execution Framework',
            ],
            'hipaa-compliant-laravel-architecture-developer-checklist' => [
                'image' => '/assets/images/blogs/codebase-security-audit.jpg',
                'alt' => 'HIPAA Compliant Laravel Architecture and Cloud Security Checklist',
            ],
            'how-i-built-an-iot-agritech-company-nepal-thoplo-machine' => [
                'image' => '/assets/images/blogs/smart-agritech-iot-farm.jpg',
                'alt' => 'Thoplo Machine Smart Agritech IoT Farm Automation in Nepal',
            ],
            'digital-transformation-roadmap-4-step-framework' => [
                'image' => '/assets/images/blogs/legacy-migration-blueprint.jpg',
                'alt' => '4-Step Enterprise Digital Transformation Roadmap Framework',
            ],
            'how-to-run-a-sprint-retrospective-guide' => [
                'image' => '/assets/images/blogs/agile-sprint-retrospective.jpg',
                'alt' => 'Agile Sprint Retrospective Playbook for Software Engineering Squads',
            ],
            'building-a-saas-product-roadmap-90-days' => [
                'image' => '/assets/images/blogs/fractional-cto-leadership.jpg',
                'alt' => '90-Day SaaS Product Roadmap Strategy for Founders',
            ],
            'why-most-software-startups-fail-at-product-market-fit' => [
                'image' => '/assets/images/blogs/bootstrapping-venture-ecosystem.jpg',
                'alt' => 'Software Startup Product Market Fit and Scaling Strategy',
            ],
            'the-strangler-fig-pattern-migrating-legacy-monoliths-without-downtime' => [
                'image' => '/assets/images/blogs/legacy-migration-blueprint.jpg',
                'alt' => 'Strangler Fig Pattern for Zero Downtime Legacy Monolith Migration',
            ],
            'remote-team-management-tools-checklist' => [
                'image' => '/assets/images/blogs/offshore-development-squads.jpg',
                'alt' => 'Remote Software Team Management & Engineering Culture Toolkit',
            ],
            'how-to-prepare-a-technical-pitch-deck-for-series-a-investors' => [
                'image' => '/assets/images/blogs/fractional-cto-leadership.jpg',
                'alt' => 'Technical Pitch Deck Blueprint for Series A Startup Investors',
            ],
            'enterprise-digital-transformation-playbook-2026' => [
                'image' => '/assets/images/blogs/legacy-migration-blueprint.jpg',
                'alt' => 'Enterprise Digital Transformation Playbook for Executive Leaders',
            ],
            'how-to-hire-and-manage-remote-software-developers-in-nepal' => [
                'image' => '/assets/images/blogs/offshore-development-squads.jpg',
                'alt' => 'Hiring Dedicated Offshore Software Developers in Kathmandu Nepal',
            ],
            'answer-engine-optimization-aeo-playbook-2026' => [
                'image' => '/assets/images/blogs/aeo-geo-search-optimization.jpg',
                'alt' => 'Answer Engine Optimization (AEO) Playbook for AI Search Engine Rankings',
            ],
            'dubai-real-estate-investment-guide-for-founders' => [
                'image' => '/assets/images/blogs/dubai-luxury-real-estate.jpg',
                'alt' => 'Dubai Off-Plan Real Estate Investment Guide for Tech Founders',
            ],
            'private-everest-base-camp-helicopter-expedition-guide' => [
                'image' => '/assets/images/blogs/everest-base-camp-helicopter.jpg',
                'alt' => 'Private Everest Base Camp Helicopter Expedition VIP Flight Guide',
            ],
            'nepal-fdi-and-tech-market-entry-guide-2026' => [
                'image' => '/assets/images/blogs/nepal-fdi-tech-market-entry.jpg',
                'alt' => 'Nepal Foreign Direct Investment (FDI) & FITTA Laws Tech Guide',
            ],
            'digital-marketing-and-aeo-roi-benchmarks-nepal-dubai' => [
                'image' => '/assets/images/blogs/digital-marketing-roi-analytics.jpg',
                'alt' => 'Digital Growth & AEO Performance Marketing Benchmarks',
            ],
            'saas-product-architecture-microservices-cto-guide' => [
                'image' => '/assets/images/blogs/agile-software-architecture.jpg',
                'alt' => 'Scalable SaaS Microservices Architecture CTO Blueprint',
            ],
            'dubai-off-plan-vs-ready-villas-financial-model' => [
                'image' => '/assets/images/blogs/dubai-luxury-real-estate.jpg',
                'alt' => 'Dubai Off-Plan vs Ready Luxury Villa Financial ROI Model',
            ],
            'nepal-helicopter-expedition-aviation-safety-blueprint' => [
                'image' => '/assets/images/blogs/everest-base-camp-helicopter.jpg',
                'alt' => 'VIP High-Altitude Aviation Safety & Everest Expedition Blueprint',
            ],
            'executive-guide-to-it-project-outsourcing' => [
                'image' => '/assets/images/blogs/codebase-security-audit.jpg',
                'alt' => 'Executive IT Project Outsourcing & Risk Mitigation Blueprint',
            ],
            'executive-it-outsourcing-blueprint-vendor-selection' => [
                'image' => '/assets/images/blogs/codebase-security-audit.jpg',
                'alt' => 'IT Outsourcing Vendor Selection & IP Protection Framework',
            ],
            'scale-offshore-development-squads-nepal-guide' => [
                'image' => '/assets/images/blogs/offshore-development-squads.jpg',
                'alt' => 'Scaling Dedicated Offshore Software Squads in Nepal',
            ],
            'saas-backlog-prioritization-frameworks-rice-kano-moscow' => [
                'image' => '/assets/images/blogs/agile-sprint-retrospective.jpg',
                'alt' => 'SaaS Backlog Prioritization RICE Kano MoSCoW Frameworks',
            ],
            'cross-border-real-estate-tech-wealth-dubai-kathmandu' => [
                'image' => '/assets/images/blogs/dubai-luxury-real-estate.jpg',
                'alt' => 'Cross-Border Dubai & Nepal Tech Wealth Diversification Strategy',
            ],
            'generative-engine-optimization-geo-strategy-b2b-saas' => [
                'image' => '/assets/images/blogs/aeo-geo-search-optimization.jpg',
                'alt' => 'Generative Engine Optimization (GEO) Strategy for ChatGPT & Perplexity',
            ],
            'fractional-cto-vs-fulltime-vp-engineering-guide' => [
                'image' => '/assets/images/blogs/fractional-cto-leadership.jpg',
                'alt' => 'Fractional CTO vs Full-Time VP of Engineering Benchmark Guide',
            ],
            'how-to-audit-outsourced-codebase-cto-guide' => [
                'image' => '/assets/images/blogs/codebase-security-audit.jpg',
                'alt' => 'Outsourced Codebase Security & Technical Debt Audit Blueprint',
            ],
            'digital-marketing-roi-benchmarks-2026-seo-paid-aeo' => [
                'image' => '/assets/images/blogs/digital-marketing-roi-analytics.jpg',
                'alt' => '2026 Digital Marketing ROI Benchmarks SEO Paid Ads & AEO',
            ],
            'entrepreneurs-playbook-bootstrapping-multi-venture-ecosystems' => [
                'image' => '/assets/images/blogs/bootstrapping-venture-ecosystem.jpg',
                'alt' => 'Bootstrapping Multi-Venture Business Ecosystems Playbook',
            ],
            'launch-scale-tech-subsidiary-nepal-guide' => [
                'image' => '/assets/images/blogs/nepal-fdi-tech-market-entry.jpg',
                'alt' => 'Launching & Scaling a Tech Subsidiary in Kathmandu Nepal',
            ],
            'international-brand-building-authority-marketing-guide' => [
                'image' => '/assets/images/blogs/digital-marketing-roi-analytics.jpg',
                'alt' => 'International Authority Marketing & Digital Terai Growth',
            ],
            'luxury-tourism-adventure-operations-everest-helicopter-guide' => [
                'image' => '/assets/images/blogs/everest-base-camp-helicopter.jpg',
                'alt' => 'Luxury Tourism & Everest Helicopter Operations Management',
            ],
        ];

        $updatedCount = 0;
        foreach ($imageMap as $slug => $data) {
            $blog = Blog::where('slug', $slug)->first();
            if ($blog) {
                $blog->update([
                    'featured_image' => $data['image'],
                    'featured_image_alt' => $data['alt'],
                ]);
                $updatedCount++;
            }
        }

        // Catch any remaining blogs without custom images
        Blog::whereNull('featured_image')
            ->orWhere('featured_image', '/assets/images/peshal-og-home.jpg')
            ->update([
                'featured_image' => '/assets/images/blogs/bootstrapping-venture-ecosystem.jpg',
                'featured_image_alt' => 'Peshal Bhattarai Business & Tech Ecosystem',
            ]);

        $this->command->info("Successfully updated featured images for {$updatedCount} blogs.");
    }
}
