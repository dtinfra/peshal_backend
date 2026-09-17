<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class HomepageFaqsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear placeholder homepage FAQs to prevent duplicates
        Faq::where('category_key', 'homepage')->delete();

        $faqs = [
            [
                'question' => 'What is Peshal Bhattarai\'s core business model and multi-venture ecosystem?',
                'answer' => 'Peshal Bhattarai operates an integrated multi-venture ecosystem across technology, growth marketing, real estate, and luxury tourism. Key ventures include IntechNexus (global remote software engineering & SaaS development), Digital Terai (organic search, performance marketing & AEO growth agency), 360Castle Dubai (Dubai real estate advisory & Golden Visa structuring), and Nepal Trip Packages (luxury Everest helicopter expeditions & adventure operations).',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 1
            ],
            [
                'question' => 'How do your dedicated remote engineering squads in Nepal achieve 55–65% cost reduction without sacrificing quality?',
                'answer' => 'Through IntechNexus, we source top-tier computer science talent in Kathmandu, pairing developers with certified Agile Scrum Masters and Senior Product Architects. Clients operate with full operational overlap, direct GitHub repository access, strict CI/CD pipelines, and US/EU quality standards at 55–65% lower overhead than domestic hiring in North America or Western Europe.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 2
            ],
            [
                'question' => 'What legal and tax incentives support setting up a tech subsidiary or remote team in Nepal under FITTA 2019?',
                'answer' => 'Nepal’s Foreign Investment and Technology Transfer Act (FITTA 2019) allows 100% foreign ownership for technology companies, guaranteed 100% profit repatriation in foreign currency, and tax concessions for export IT services (10–15% corporate tax rate). We assist international companies with Special Foreign Currency (FCY) bank account setup, NRB approvals, and full compliance.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 3
            ],
            [
                'question' => 'How does Answer Engine Optimization (AEO/GEO) differ from traditional SEO, and why is it essential for B2B brands?',
                'answer' => 'Traditional SEO focuses on earning organic blue link clicks on search engines like Google. AEO (Answer Engine Optimization) and GEO (Generative Engine Optimization) structure content using QAE (Question-Answer-Evidence) formatting, schema graph markups, and high information-density content so that AI search platforms (ChatGPT, Perplexity, Claude, Google AI Overviews) extract and cite your brand as the primary authority for high-intent customer queries.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 4
            ],
            [
                'question' => 'What investment returns and Golden Visa benefits does Dubai real estate offer international buyers?',
                'answer' => 'Dubai real estate delivers 7–10% net rental yields—among the highest globally—with 0% property tax, 0% capital gains tax, and 100% foreign freehold ownership in prime zones. Investing AED 2,000,000 (~$545,000 USD) or more in ready or off-plan residential real estate qualifies investors and their families for the renewable 10-Year UAE Golden Visa.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 5
            ],
            [
                'question' => 'How do you protect Intellectual Property (IP), code security, and NDA compliance for global client software projects?',
                'answer' => 'Intellectual Property (IP) assignment is legally bound to the client from line one of code commit. All remote engineers sign binding international Non-Disclosure Agreements (NDAs). Code is hosted directly in client-owned repositories (GitHub, GitLab, AWS Bitbucket) with strict role-based access control (RBAC), multi-factor authentication, and zero third-party code sharing.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 6
            ],
            [
                'question' => 'What engagement models are available for working with Peshal Bhattarai?',
                'answer' => 'Engagement models include: (1) Fractional CTO / CPO Retainers for SaaS roadmap strategy and product architecture, (2) Remote Team as a Service (RTaaS) for dedicated engineering squads, (3) Performance & AEO Growth Marketing Retainers via Digital Terai, and (4) Strategic Board Advisory for venture scaling and cross-border expansion in UAE and Nepal.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 7
            ],
            [
                'question' => 'What safety protocols and luxury standards govern Everest helicopter expeditions at Nepal Trip Packages?',
                'answer' => 'Luxury tourism operations at Nepal Trip Packages utilize Airbus AS350 B3e high-altitude helicopters piloted by senior high-altitude aviators. Expeditions include supplementary oxygen systems, real-time satellite tracking, weather radar clearance protocols, certified emergency medical response, and luxury lodge accommodations at Everest Base Camp and Syangboche.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 8
            ],
            [
                'question' => 'Can you assist startups with MVP validation, architecture, and fundraising readiness?',
                'answer' => 'Yes. We specialize in rapidly validating startup concepts through 90-day MVP builds utilizing modern decoupled architectures (Laravel 12 API backends with Next.js 15 App Router frontends), RICE backlog prioritization, and pitch-ready product metrics to demonstrate Product-Market Fit (PMF) to investors.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 9
            ],
            [
                'question' => 'How do I schedule a strategic consultation or request a venture discovery proposal?',
                'answer' => 'You can schedule a direct strategy call by filling out the inquiry form on the contact page or emailing peshal@intechnexus.com. Discovery meetings cover project requirements, team composition, legal structuring, and technical architecture within 24–48 hours.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 10
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}

