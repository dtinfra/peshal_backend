<?php

namespace Database\Seeders;

use App\Models\SeoMetadata;
use Illuminate\Database\Seeder;

class PublishStaticPageSeoSeeder extends Seeder
{
    public function run(): void
    {
        $baseUrl = "https://www.peshalb.com.np";

        // Purge old legacy domain static page records
        SeoMetadata::where('model_type', 'Page')
            ->where('canonical_url', 'like', 'https://peshalbhattarai.com%')
            ->delete();

        $pages = [
            [
                'path' => '/',
                'title' => "Peshal Bhattarai — Tech Entrepreneur & Business Growth Advisor (Nepal • Dubai)",
                'description' => "Official executive profile of Peshal Bhattarai. Founder of IntechNexus & Digital Terai. Advising tech enterprises, FDI market entry in Nepal, and Dubai corporate setup.",
                'keywords' => "peshal bhattarai, tech entrepreneur nepal, digital growth advisor, intechnexus, digital terai, beinseo dubai, thoplo machine, company registration nepal, dubai business setup",
            ],
            [
                'path' => '/about',
                'title' => "About Peshal Bhattarai | Tech Executive & Venture Founder Profile",
                'description' => "Discover Peshal Bhattarai's executive background holding M.Eng. from Kathmandu University. Founding and scaling software engineering, digital growth, and international ventures.",
                'keywords' => "about peshal bhattarai, kathmandu university computer engineering, tech founder nepal, intechnexus founder, digital terai founder, serial entrepreneur kathmandu",
            ],
            [
                'path' => '/journey',
                'title' => "Founder Journey & Executive Timeline | Peshal Bhattarai",
                'description' => "Explore Peshal Bhattarai's executive timeline from founding Digital Terai and IntechNexus to expanding international travel operations and Dubai advisory.",
                'keywords' => "peshal bhattarai career timeline, founder journey, digital terai history, intechnexus founder, nepal tech leadership milestone",
            ],
            [
                'path' => '/ventures',
                'title' => "Venture Portfolio | IntechNexus, Digital Terai, BeinSEO Dubai & Thoplo Machine",
                'description' => "Explore active business ventures founded and scaled by Peshal Bhattarai across AI software engineering (IntechNexus), search marketing (Digital Terai & BeinSEO Dubai), and IoT agritech (Thoplo Machine).",
                'keywords' => "intechnexus, digital terai, beinseo dubai, thoplo machine, peshal bhattarai ventures, nepal tech companies, dubai corporate setup advisory",
            ],
            [
                'path' => '/companies',
                'title' => "Corporate Ecosystem Directory | IntechNexus, Digital Terai, BeinSEO & Thoplo Machine",
                'description' => "Official directory of corporate entities and business ventures operated under Peshal Bhattarai's executive leadership in Nepal, Dubai, and global markets.",
                'keywords' => "peshal bhattarai companies, corporate entity directory, intechnexus, digital terai, beinseo dubai, thoplo machine",
            ],
            [
                'path' => '/services',
                'title' => "Executive Strategic Services & Advisory Directory | Peshal Bhattarai",
                'description' => "Directory of executive business consulting, company registration in Nepal, digital growth marketing, Dubai freezone setup, and remote software engineering squads.",
                'keywords' => "fractional cto nepal, company registration nepal, digital marketing consultant nepal, dubai business setup, remote development team nepal, saas architecture advisory",
            ],
            [
                'path' => '/digital-growth',
                'title' => "Digital Growth & Technical SEO Hub — Peshal Bhattarai",
                'description' => "Data-driven growth strategies combining code-level technical SEO, Google & Meta Ads performance funnels, GA4 attribution, and Answer Engine Optimization (AEO/GEO).",
                'keywords' => "digital growth nepal, technical seo consultant, aeo optimization, google ads performance marketing, digital terai, search marketing advisor",
            ],
            [
                'path' => '/business-consulting',
                'title' => "Business Consulting & Company Registration Nepal Hub — Peshal Bhattarai",
                'description' => "Executive advisory for company incorporation in Nepal, Office of Company Registrar (OCR) filing, FITTA FDI clearances, and corporate scaling.",
                'keywords' => "business consultant nepal, company registration nepal, fdi advisor nepal, ocr company setup kathmandu, business registration guide nepal",
            ],
            [
                'path' => '/dubai',
                'title' => "Dubai Business Setup & Property Investment Hub — Peshal Bhattarai",
                'description' => "Freezone & Mainland corporate licensing, 10-Year UAE Golden Visa processing, and high-yield off-plan real estate portfolio advisory in Dubai.",
                'keywords' => "dubai business setup, freezone company formation uae, dubai golden visa advisor, luxury real estate investment dubai, beinseo dubai",
            ],
            [
                'path' => '/technology',
                'title' => "Technology Engineering & Remote Squads Hub — Peshal Bhattarai",
                'description' => "Remote Team as a Service (RTaaS), enterprise SaaS software architecture, AI model integration, and dedicated developer squads from Nepal.",
                'keywords' => "remote development team nepal, software development nepal, saas architecture consultant, ai integration nepal, intechnexus, rtaas squads",
            ],
            [
                'path' => '/start-business-in-dubai',
                'title' => "Start a Business in Dubai Guide 2026 | Freezone Setup & Tax Strategy",
                'description' => "Comprehensive step-by-step guide to corporate setup in Dubai. Freezone licensing, 0% personal tax, UAE corporate banking, and 10-Year Golden Visas.",
                'keywords' => "start business in dubai, dubai freezone setup guide, uae corporate tax 2026, dubai company registration steps",
            ],
            [
                'path' => '/start-business-in-nepal',
                'title' => "Start a Business in Nepal Guide 2026 | OCR & FITTA FDI Incorporation",
                'description' => "Complete operational roadmap for foreign investors and founders establishing IT subsidiaries and private limited companies in Nepal. OCR, IRD tax, and FDI clearances.",
                'keywords' => "start business in nepal, company registration guide nepal, fitta fdi process nepal, it company setup kathmandu",
            ],
            [
                'path' => '/portfolio',
                'title' => "Client Outcomes & Case Studies | Peshal Bhattarai Venture Portfolio",
                'description' => "Inspect documented business outcomes, SaaS product re-architectures, AEO search campaigns, and offshore engineering squad scaling delivered for global clients.",
                'keywords' => "saas case studies, digital marketing case studies nepal, aeo ROI outcomes, decoupled architecture case study, intechnexus outcomes",
            ],
            [
                'path' => '/insights',
                'title' => "Insights & Strategy Hub | Executive Playbooks on Tech, Growth & Investment",
                'description' => "Read practitioner guides on IT outsourcing, scaling offshore squads in Nepal, AEO/GEO growth, SaaS product governance, and cross-border real estate wealth.",
                'keywords' => "it outsourcing guide, scale offshore squad nepal, aeo playbook, generative engine optimization, dubai off plan investment model",
            ],
            [
                'path' => '/blog',
                'title' => "Editorial Insights & Strategy Feed | Peshal Bhattarai",
                'description' => "First-hand technical playbooks, founder stories, and strategic guides covering Technology, AI, Digital Growth, Nepal Business, Dubai Real Estate, and Venture Building.",
                'keywords' => "peshal bhattarai blog, editorial strategy, tech leadership insights, digital growth playbooks",
            ],
            [
                'path' => '/work-with-me',
                'title' => "Work With Peshal Bhattarai | Executive Advisory & Venture Partnerships",
                'description' => "Engage Peshal Bhattarai for Fractional CTO leadership, remote tech squad assembly, digital growth marketing retainer execution, or joint ventures.",
                'keywords' => "work with peshal bhattarai, hire fractional cto, strategic business advisory nepal, offshore dev team partnership, digital marketing retainer",
            ],
            [
                'path' => '/now',
                'title' => "What I'm Doing Now (/now) | Peshal Bhattarai Active Focus 2026",
                'description' => "Current operational focus of Peshal Bhattarai: scaling IntechNexus software squads, executing AEO campaigns at Digital Terai, and Dubai real estate investments.",
                'keywords' => "peshal bhattarai now page, active focus 2026, intechnexus current projects, digital terai expansion, current venture operations",
            ],
            [
                'path' => '/contact',
                'title' => "Book a Strategic Briefing | Contact Peshal Bhattarai",
                'description' => "Schedule an executive briefing or business consultation with Peshal Bhattarai for tech leadership, offshore squad scaling, or digital growth partnerships.",
                'keywords' => "contact peshal bhattarai, book consultation peshal, executive briefing, intechnexus contact, digital terai consultation",
            ],
            [
                'path' => '/author/peshal-bhattarai',
                'title' => "Peshal Bhattarai | Author & Executive Contributor Profile",
                'description' => "Official author profile of Peshal Bhattarai. Explore executive strategy guides on software engineering squads, AEO/GEO growth, and cross-border investment.",
                'keywords' => "peshal bhattarai author, peshal bhattarai articles, tech executive author, digital marketing strategist",
            ],
            [
                'path' => '/privacy',
                'title' => "Privacy Policy | Peshal Bhattarai",
                'description' => "Privacy Policy detailing data collection, processing standards, and user privacy safeguards across peshalb.com.np.",
                'keywords' => "privacy policy peshalb.com.np, data protection",
            ],
            [
                'path' => '/terms',
                'title' => "Terms of Service | Peshal Bhattarai",
                'description' => "Terms of Service and legal usage agreements governing peshalb.com.np.",
                'keywords' => "terms of service peshalb.com.np, legal terms",
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
