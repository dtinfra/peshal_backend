<?php

namespace Database\Seeders;

use App\Models\SeoMetadata;
use Illuminate\Database\Seeder;

class PublishStaticPageSeoSeeder extends Seeder
{
    public function run(): void
    {
        $baseUrl = 'https://www.peshalb.com.np';

        // Purge old legacy domain static page records if any exist
        SeoMetadata::where('model_type', 'Page')
            ->where('canonical_url', 'like', 'https://peshalbhattarai.com%')
            ->delete();

        $pages = [
            [
                'path' => '/',
                'title' => 'Peshal Bhattarai — Tech Entrepreneur, Growth Marketer & Business Builder',
                'description' => 'Official portfolio & executive profile of Peshal Bhattarai. Building high-growth tech ventures, digital growth agencies, and real estate investments across Nepal & Dubai.',
                'keywords' => 'peshal bhattarai, tech entrepreneur nepal, digital growth marketer, venture builder, intechnexus, digital terai, dubai real estate advisory',
            ],
            [
                'path' => '/about',
                'title' => 'About Peshal Bhattarai | Technology Leadership & Entrepreneur Profile',
                'description' => 'Discover Peshal Bhattarai\'s 10+ year executive journey holding M.Eng. from Kathmandu University and B.E. from VTU. Operating ventures across tech, digital growth, travel, and real estate.',
                'keywords' => 'about peshal bhattarai, kathmandu university computer engineering, vtu cs graduate, tech leadership nepal, serial entrepreneur kathmandu',
            ],
            [
                'path' => '/journey',
                'title' => 'Founder Journey & Career Timeline | Peshal Bhattarai',
                'description' => 'Explore Peshal Bhattarai\'s executive timeline from founding Digital Terai and IntechNexus to expanding travel operations and Dubai real estate investments.',
                'keywords' => 'peshal bhattarai career timeline, founder journey, digital terai history, intechnexus founder, nepal tech leadership milestone',
            ],
            [
                'path' => '/ventures',
                'title' => 'Venture Portfolio | IntechNexus, Digital Terai, Nepal Trip Packages & 360Castle',
                'description' => 'Explore active business ventures founded and scaled by Peshal Bhattarai spanning AI software engineering, digital growth marketing, luxury travel, and Dubai real estate.',
                'keywords' => 'intechnexus, digital terai, nepal trip packages, 360castle dubai, peshal bhattarai ventures, nepal tech companies, dubai property advisory',
            ],
            [
                'path' => '/companies',
                'title' => 'Corporate Venture Ecosystem Directory | Peshal Bhattarai',
                'description' => 'Official directory of corporate entities and business ventures operated under Peshal Bhattarai\'s executive leadership in Nepal and Dubai.',
                'keywords' => 'peshal bhattarai companies, corporate entity directory, intechnexus, digital terai, 360castle, nepal trip packages',
            ],
            [
                'path' => '/services',
                'title' => 'Executive Strategic Services | Fractional CTO, Growth Marketing & Business Consulting',
                'description' => 'Partner with Peshal Bhattarai for Fractional CTO advisory, AEO & digital growth marketing, offshore engineering squad scaling, and venture strategy.',
                'keywords' => 'fractional cto nepal, digital growth marketing consulting, aeo optimization service, offshore engineering squad setup, b2b saas consulting',
            ],
            [
                'path' => '/portfolio',
                'title' => 'Client Outcomes & Case Studies | Peshal Bhattarai Venture Portfolio',
                'description' => 'Inspect documented business outcomes, SaaS product re-architectures, AEO search campaigns, and offshore engineering squad scaling delivered for global clients.',
                'keywords' => 'saas case studies, digital marketing case studies nepal, aeo ROI outcomes, decoupled architecture case study, intechnexus outcomes',
            ],
            [
                'path' => '/insights',
                'title' => 'Insights & Strategy Hub | Executive Playbooks on Tech, Growth & Investment',
                'description' => 'Read practitioner guides on IT outsourcing, scaling offshore squads in Nepal, AEO/GEO growth, SaaS product governance, and cross-border real estate wealth.',
                'keywords' => 'it outsourcing guide, scale offshore squad nepal, aeo playbook, generative engine optimization, dubai off plan investment model',
            ],
            [
                'path' => '/blog',
                'title' => 'Editorial Insights & Strategy Feed | Peshal Bhattarai',
                'description' => 'First-hand technical playbooks, founder stories, and strategic guides covering Technology, AI, Digital Growth, Nepal Business, Dubai Real Estate, and Venture Building.',
                'keywords' => 'peshal bhattarai blog, editorial strategy, tech leadership insights, digital growth playbooks',
            ],
            [
                'path' => '/work-with-me',
                'title' => 'Work With Peshal Bhattarai | Executive Advisory & Strategic Partnerships',
                'description' => 'Engage Peshal Bhattarai for tech leadership advisory, high-performance offshore squad setup, digital growth marketing retainer execution, or joint ventures.',
                'keywords' => 'work with peshal bhattarai, hire fractional cto, strategic business advisory nepal, offshore dev team partnership, digital marketing retainer',
            ],
            [
                'path' => '/now',
                'title' => 'What I\'m Doing Now (/now) | Peshal Bhattarai Active Focus 2026',
                'description' => 'Current operational focus of Peshal Bhattarai: scaling IntechNexus software squads, executing AEO campaigns at Digital Terai, and Dubai real estate investments.',
                'keywords' => 'peshal bhattarai now page, active focus 2026, intechnexus current projects, digital terai expansion, current venture operations',
            ],
            [
                'path' => '/contact',
                'title' => 'Book a Strategic Briefing | Contact Peshal Bhattarai',
                'description' => 'Schedule an executive briefing or business consultation with Peshal Bhattarai for tech leadership, offshore squad scaling, or digital growth partnerships.',
                'keywords' => 'contact peshal bhattarai, book consultation peshal, executive briefing, intechnexus contact, digital terai consultation',
            ],
            [
                'path' => '/author/peshal-bhattarai',
                'title' => 'Peshal Bhattarai | Author & Executive Contributor Profile',
                'description' => 'Official author profile of Peshal Bhattarai. Explore executive strategy guides on software engineering squads, AEO/GEO growth, and cross-border investment.',
                'keywords' => 'peshal bhattarai author, peshal bhattarai articles, tech executive author, digital marketing strategist',
            ],
            [
                'path' => '/privacy',
                'title' => 'Privacy Policy | Peshal Bhattarai',
                'description' => 'Privacy Policy detailing data collection, processing standards, and user privacy safeguards across peshalb.com.np.',
                'keywords' => 'privacy policy peshalb.com.np, data protection',
            ],
            [
                'path' => '/terms',
                'title' => 'Terms of Service | Peshal Bhattarai',
                'description' => 'Terms of Service and legal usage agreements governing peshalb.com.np.',
                'keywords' => 'terms of service peshalb.com.np, legal terms',
            ],
        ];

        foreach ($pages as $pData) {
            $canonical = $pData['path'] === '/' ? $baseUrl : "{$baseUrl}{$pData['path']}";

            SeoMetadata::updateOrCreate(
                [
                    'model_type' => 'Page',
                    'canonical_url' => $canonical,
                ],
                [
                    'model_id' => 0,
                    'meta_title' => $pData['title'],
                    'meta_description' => $pData['description'],
                    'keywords' => $pData['keywords'],
                    'canonical_url' => $canonical,
                    'og_title' => $pData['title'],
                    'og_description' => $pData['description'],
                    'og_image' => '/assets/images/peshal-og-home.jpg',
                ]
            );

            $this->command->info("Seeded static page SEO for: {$pData['path']}");
        }
    }
}
