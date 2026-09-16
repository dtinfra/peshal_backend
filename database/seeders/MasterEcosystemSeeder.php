<?php

namespace Database\Seeders;

use App\Models\Venture;
use App\Models\TimelineEvent;
use App\Models\NowPageSetting;
use App\Models\SeoMetadata;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MasterEcosystemSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Core Business Ecosystem Ventures
        $venturesData = [
            [
                'name' => 'IntechNexus',
                'slug' => 'intechnexus',
                'tagline' => 'Software Engineering, AI Solutions & Dedicated Remote Teams',
                'category' => 'technology',
                'logo' => '/assets/images/companies/intechnexus.png',
                'description' => 'A global technology partner delivering custom software engineering, SaaS product development, AI integrations, and dedicated remote development teams for USA, European, and global clients.',
                'content' => '# IntechNexus: Software Engineering & AI Solutions

IntechNexus is the technology and product engineering engine within Peshal Bhattarai\'s business ecosystem. We help ambitious startups, SaaS companies, and mid-market enterprises build scalable web applications, deploy custom AI models, and assemble high-velocity dedicated remote engineering teams from Nepal.

### Core Specializations:
- **Dedicated Remote Engineering Teams**: Senior full-stack developers, UI/UX designers, and DevOps engineers operating under US/EU delivery standards.
- **SaaS & Custom Software Development**: Modern decoupled web architectures (Laravel 12, Next.js 15, React, Python) engineered for high concurrency.
- **AI Solutions & Automation**: Custom LLM fine-tuning, RAG pipelines, and intelligent workflow automation.
- **Product Architecture & CTO Advisory**: Fractional technology leadership, system audits, and cloud infrastructure optimization.',
                'website_url' => 'https://intechnexus.com',
                'my_role' => 'Founder & Managing Director',
                'locations' => ['Nepal', 'USA', 'Switzerland', 'Australia'],
                'technologies' => ['Laravel 12', 'Next.js 15', 'TypeScript', 'Python', 'Docker', 'AWS', 'Redis'],
                'industries' => ['B2B SaaS', 'Fintech', 'Digital Health', 'Enterprise Automation'],
                'faqs' => [
                    ['question' => 'How does IntechNexus build remote dev teams?', 'answer' => 'We recruit top 5% tech talent in Nepal, conduct rigorous coding and system architecture assessments, and manage team output using agile Scrum frameworks.'],
                    ['question' => 'What tech stacks do you specialize in?', 'answer' => 'Our core engineering stack includes Next.js 15, Laravel 12, Python AI tooling, Docker, and AWS cloud infrastructure.']
                ],
                'order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Digital Terai',
                'slug' => 'digitalterai',
                'tagline' => 'Data-Driven Search Engine & Performance Growth Agency',
                'category' => 'digital_growth',
                'logo' => '/assets/images/companies/digitalterai.png',
                'description' => 'A premier digital growth and search agency specializing in technical SEO, Answer Engine Optimization (AEO/GEO), Google Ads, Meta Ads, and performance marketing funnels.',
                'content' => '# Digital Terai: Data-Driven Digital Growth & Search

Digital Terai is the digital growth arm of Peshal Bhattarai\'s ecosystem. We engineer ROI-focused customer acquisition engines that combine technical SEO, Google Ads, Answer Engine Optimization (AEO for ChatGPT & Perplexity), and conversion rate optimization.

### Core Specializations:
- **Search Engine Optimization (SEO)**: Comprehensive code-level technical audits, international hreflang setups, and content density strategies.
- **Answer Engine Optimization (AEO/GEO)**: Structuring entity schemas and QAE blocks to ensure AI search models cite your brand as an authority.
- **Performance Advertising**: Google Ads, Meta Ads, and LinkedIn campaign management optimized for Customer Acquisition Cost (CAC).
- **High-Converting Web Experiences**: Fast, responsive Next.js web applications built for conversion rate optimization.',
                'website_url' => 'https://digitalterai.com',
                'my_role' => 'Founder & Growth Director',
                'locations' => ['Nepal', 'Global'],
                'technologies' => ['Google Analytics 4', 'Semrush', 'Screaming Frog', 'Meta Business Manager', 'Next.js 15'],
                'industries' => ['E-commerce', 'B2B Services', 'Real Estate', 'Hospitality', 'EdTech'],
                'faqs' => [
                    ['question' => 'What is Answer Engine Optimization (AEO)?', 'answer' => 'AEO structures your content into QAE blocks and entity schemas so AI engines like ChatGPT, Claude, and Perplexity cite your brand when users ask industry questions.'],
                    ['question' => 'How do you measure marketing performance?', 'answer' => 'We set up GA4 custom conversion events and multi-touch attribution to track leads directly to business revenue.']
                ],
                'order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Nepal Trip Packages',
                'slug' => 'nepaltrippackages',
                'tagline' => 'Bespoke Luxury & Adventure Experiences Across Nepal',
                'category' => 'travel',
                'logo' => '/assets/images/companies/nepaltrippackages.png',
                'description' => 'A premier travel venture crafting customized luxury tours, Everest helicopter expeditions, motorcycle adventures, photography journeys, and B2B travel partnerships across Nepal.',
                'content' => '# Nepal Trip Packages: Premium Travel & Adventure Operations

Nepal Trip Packages is a specialized travel venture dedicated to delivering unforgettable, high-end travel experiences across Nepal for discerning international travelers, corporate groups, and global travel agency partners.

### Core Specializations:
- **Luxury Expedition & Helicopter Tours**: Exclusive Everest Base Camp helicopter fly-overs, luxury mountain resort retreats, and VIP arrivals.
- **Customized Adventure & Motorcycle Tours**: Guided Himalayan motorcycle journeys, trekking itineraries, and wildlife safaris.
- **B2B Travel Partnerships**: White-label ground operations and destination management services for global travel agencies.',
                'website_url' => 'https://nepaltrippackages.com',
                'my_role' => 'Founder & Business Architect',
                'locations' => ['Kathmandu', 'Pokhara', 'Himalayas', 'Global Markets'],
                'technologies' => ['Custom Booking Engine', 'Next.js 15', 'Stripe Payments', 'CRM Routing'],
                'industries' => ['Luxury Travel', 'Adventure Tourism', 'B2B Travel Distribution'],
                'faqs' => [
                    ['question' => 'Do you handle B2B travel agency partnerships?', 'answer' => 'Yes, we provide full ground operation support, VIP logistics, and white-label itineraries for international travel operators.'],
                    ['question' => 'Are custom luxury itineraries available?', 'answer' => 'Absolutely. Every tour can be tailored with helicopter transfers, 5-star mountain lodging, and private guides.']
                ],
                'order' => 3,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => '360Castle',
                'slug' => '360castle',
                'tagline' => 'Dubai Real Estate & Premium Property Investment Advisory',
                'category' => 'real_estate',
                'logo' => '/assets/images/companies/360castle.png',
                'description' => 'A Dubai real estate and property investment platform connecting international buyers, entrepreneurs, and investors with premium luxury villas, off-plan developments, and commercial real estate.',
                'content' => '# 360Castle: Dubai Real Estate & Property Advisory

360Castle serves as the real estate and investment arm connecting international buyers and business founders with high-yielding Dubai real estate opportunities, luxury villas, and off-plan property investments.

### Core Specializations:
- **Luxury Residential Properties**: Exclusive villas, penthouses, and waterfront apartments in Dubai Downtown, Palm Jumeirah, and Dubai Hills.
- **Off-Plan Investment Selection**: Early access to top-tier off-plan developments with high capital appreciation potential.
- **International Investor Advisory**: Complete assistance for international buyers exploring Dubai property portfolios and Golden Visa eligibility.',
                'website_url' => 'https://360castle.com',
                'my_role' => 'Founder & Real Estate Partner',
                'locations' => ['Dubai, UAE', 'International'],
                'technologies' => ['3D Virtual Tours', 'Property Matching CRM', 'MLS Data Integration'],
                'industries' => ['Dubai Real Estate', 'Property Investment', 'Luxury Housing'],
                'faqs' => [
                    ['question' => 'Can foreign investors buy real estate in Dubai?', 'answer' => 'Yes, foreign nationals can purchase 100% freehold properties in designated Dubai areas with attractive rental yields.'],
                    ['question' => 'Do you assist with Golden Visa inquiries?', 'answer' => 'We connect qualifying property investors with certified UAE legal partners for Golden Visa processing.']
                ],
                'order' => 4,
                'is_featured' => true,
                'is_active' => true,
            ]
        ];

        foreach ($venturesData as $vData) {
            $v = Venture::updateOrCreate(
                ['slug' => $vData['slug']],
                $vData
            );

            // Add SEO Metadata for Venture
            SeoMetadata::updateOrCreate(
                [
                    'model_type' => Venture::class,
                    'model_id' => $v->id,
                ],
                [
                    'meta_title' => "{$v->name} | {$v->tagline}",
                    'meta_description' => $v->description,
                    'keywords' => strtolower("{$v->name}, {$v->category}, peshal bhattarai venture, business builder"),
                    'canonical_url' => "https://peshalb.com.np/ventures/{$v->slug}",
                    'og_title' => "{$v->name} | Peshal Bhattarai Ecosystem",
                    'og_description' => $v->description,
                    'og_image' => $v->logo,
                ]
            );
        }

        // 2. Seed Journey Timeline Events
        $timelineData = [
            [
                'year' => '2014',
                'title' => "Engineer's Degree in Computer Science (VTU)",
                'category' => 'education',
                'description' => "Earned an Engineer's Degree in Computer Science & Engineering from Visvesvaraya Technological University (VTU), building core foundations in data structures, algorithms, and software engineering.",
                'content' => 'Commenced software engineering career, architecting database schemas and building high-throughput web service architectures.',
                'order' => 1,
            ],
            [
                'year' => '2016',
                'title' => 'M.Eng. in Computer Engineering (Kathmandu University)',
                'category' => 'education',
                'description' => 'Completed Master of Engineering (M.Eng.) in Computer Engineering at Kathmandu University (KU), specializing in distributed systems, algorithm optimization, and mobile ad-hoc network (MANET) protocol research.',
                'content' => 'Co-authored published research on energy-efficient routing protocols with KU faculty while stepping into technical Product Management and Agile Scrum squad leadership.',
                'order' => 2,
            ],
            [
                'year' => '2018',
                'title' => 'Founded Digital Terai',
                'category' => 'venture',
                'description' => 'Launched Digital Terai in Nepal as a specialized growth digital marketing agency, driving search engine rankings, Google/Meta ad performance, and web development for global clients.',
                'content' => 'Grew Digital Terai into a leading search and performance marketing agency delivering measurable ROI for international clients.',
                'order' => 3,
            ],
            [
                'year' => '2021',
                'title' => 'Founded IntechNexus',
                'category' => 'technology',
                'description' => 'Established IntechNexus to provide Software Engineering as a Service, custom SaaS architecture, and dedicated remote development teams for USA, European, and Australian businesses.',
                'content' => 'Built a high-performance remote development model connecting top tech talent in Nepal with international tech leaders.',
                'order' => 4,
            ],
            [
                'year' => '2023',
                'title' => 'Expanded Travel & Real Estate Operations',
                'category' => 'travel',
                'description' => 'Expanded the business ecosystem into luxury adventure travel (Nepal Trip Packages) and Dubai property investment advisory (360Castle).',
                'content' => 'Diversified operations into high-growth sectors, linking global investors and premium travelers with Nepal and UAE opportunities.',
                'order' => 5,
            ],
            [
                'year' => '2026',
                'title' => 'PeshalB.com.np Ecosystem Headquarters',
                'category' => 'current',
                'description' => 'Consolidated all personal brand authority, insights, and lead routing into PeshalB.com.np as the digital headquarters connecting global market opportunities.',
                'content' => 'Building, learning, exploring, and connecting across Nepal, Dubai, and international markets.',
                'order' => 6,
            ],
        ];

        foreach ($timelineData as $tData) {
            TimelineEvent::updateOrCreate(
                ['year' => $tData['year'], 'title' => $tData['title']],
                $tData
            );
        }

        // 3. Seed Initial Now Page Settings
        NowPageSetting::updateOrCreate(
            ['id' => 1],
            [
                'building' => [
                    'Scaling IntechNexus remote engineering squads for US & EU SaaS companies',
                    'Expanding Answer Engine Optimization (AEO/GEO) capabilities inside Digital Terai',
                    'Refining 360Castle Dubai property matching system for international buyers',
                ],
                'exploring' => [
                    'Nepal market entry frameworks for foreign founders and tech companies',
                    'Dubai business ecosystem growth and cross-border tech ventures',
                    'AI-assisted workflow automation for software engineering teams',
                ],
                'learning' => [
                    'Next.js 15 App Router server actions & edge caching patterns',
                    'LLM fine-tuning techniques for domain-specific answer engines',
                ],
                'reading' => [
                    'The Lean Startup by Eric Ries',
                    'Zero to One by Peter Thiel',
                    'High Output Management by Andrew Grove',
                ],
                'current_focus' => 'Building high-performing technology teams, expanding digital growth operations across Nepal & Dubai, and exploring strategic international business opportunities.',
                'last_updated_at' => now(),
            ]
        );
    }
}
