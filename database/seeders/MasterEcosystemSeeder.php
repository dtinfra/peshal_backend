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
        // 1. Seed Core Business Ecosystem Ventures with Deep Practitioner Content
        $venturesData = [
            [
                'name' => 'IntechNexus',
                'slug' => 'intechnexus',
                'tagline' => 'Software Engineering, Custom AI Solutions & Dedicated Remote Squads',
                'category' => 'technology',
                'logo' => '/assets/images/companies/intechnexus.png',
                'description' => 'A global technology partner delivering custom software engineering, modern SaaS product architecture, custom AI integrations, and dedicated remote development squads from Nepal for US, European, and global businesses.',
                'content' => '# IntechNexus: Software Engineering, AI & Remote Squad Assembly

IntechNexus serves as the high-velocity technology and product engineering engine within Peshal Bhattarai\'s business ecosystem. We bridge the global software talent gap by connecting ambitious startups, high-growth SaaS platforms, and enterprise companies with pre-vetted, top-tier software engineering squads operating out of Nepal.

Operating under strict Western software delivery standards, Agile Scrum methodologies, and 100% intellectual property (IP) assignment, IntechNexus enables technology leaders to scale engineering velocity while achieving **65% to 75% cost efficiencies** compared to US or European developer rates.

---

## 1. Core Strategic Capability Pillars

### A. Turnkey Dedicated Remote Software Squads
We assemble specialized, full-time engineering units tailored to your technical stack and product roadmap:
- **Dedicated Full-Stack Developers**: Senior & Mid-level engineers proficient in Next.js 15, React, Node.js, Laravel 12, Python, and TypeScript.
- **AI & Data Engineers**: Experts in building Retrieval-Augmented Generation (RAG) pipelines, fine-tuning open-source LLMs (Llama 3, Mistral), and vector database integration (Pinecone, Qdrant).
- **Cloud DevOps & Infrastructure Engineers**: Containerization, CI/CD automation, Kubernetes orchestrations, and cloud cost optimization across AWS, GCP, and Azure.
- **Agile Scrum Management & QA Automation**: Dedicated Scrum Masters and QA automation engineers ensuring zero regression, automated test coverage, and daily asynchronous/synchronous sprint updates.

### B. Modern Decoupled SaaS Product Architecture
We architect high-concurrency web and mobile applications designed for modular scale:
- **Frontend Architecture**: Server-Side Rendered (SSR) Next.js 15, React, and Tailwind CSS for instant page loads and maximum search engine visibility.
- **Backend Architecture**: High-throughput REST and GraphQL APIs powered by Laravel 12 or Python FastAPI, integrated with Redis edge caching and PostgreSQL/MySQL databases.
- **Microservices & Event-Driven Systems**: Decoupled message queues (RabbitMQ, Kafka) and serverless cloud functions designed to handle peak traffic spikes.

### C. Enterprise AI Integration & Intelligent Automation
Transform legacy business processes into automated, intelligent workflows:
- **Domain-Specific AI Chatbots**: Context-aware AI assistants trained on proprietary enterprise knowledge bases.
- **Document Processing Pipelines**: Automated OCR, semantic text extraction, and automated classification for financial and legal documents.
- **Predictive Analytics & Recommendation Engines**: Custom machine learning models integrated into existing Web/Mobile applications.

---

## 2. Squad Assembly & Onboarding Blueprint

We eliminate the friction of offshore hiring through a structured 5-stage team integration model:

| Stage | Milestone | Timeline | Deliverables |
| :--- | :--- | :--- | :--- |
| **01. Discovery** | Technical Stack & Culture Alignment | Day 1 – 3 | Skill matrix definition, senior lead interviews, security requirement review |
| **02. Selection** | Rigorous Technical Vetting | Day 4 – 7 | Live coding assessments, system design evaluations, soft skill verification |
| **03. Contracting** | Legal & IP Safeguards | Day 8 – 10 | Master Services Agreement (MSA), NDA, 100% IP assignment contracts |
| **04. Onboarding** | Environment & Repo Setup | Day 11 – 14 | Git repo access, Jira/Linear integration, CI/CD pipeline setup, sprint kickoff |
| **05. Sprint Scale** | Agile Scrum Execution | Ongoing | Daily standups, bi-weekly sprint demos, continuous code reviews |

---

## 3. Empirical Compensation & Rate Benchmarks (2026 Data)

| Developer Seniority | US Monthly Market Rate | Eastern Europe Monthly Rate | IntechNexus Squad Rate (Nepal) | Net Cost Savings |
| :--- | :--- | :--- | :--- | :--- |
| **Junior Developer (1-2 yrs)** | $6,000 – $8,000 | $3,000 – $4,500 | **$1,200 – $1,800** | **75% Savings** |
| **Mid Full-Stack Engineer (3-5 yrs)** | $10,000 – $14,000 | $5,000 – $7,500 | **$2,200 – $3,200** | **70% Savings** |
| **Senior Architect / Lead (6+ yrs)** | $15,000 – $22,000 | $8,000 – $12,000 | **$3,500 – $5,000** | **68% Savings** |
| **DevOps / Cloud Specialist** | $16,000 – $24,000 | $9,000 – $13,000 | **$4,000 – $5,500** | **72% Savings** |

---

## 4. Deep-Dive Strategy Articles & Related Guides

Explore technical blueprints and market entry strategies within our network:
- **[How to Hire & Manage Remote Software Developers in Nepal](/insights/how-to-hire-and-manage-remote-software-developers-in-nepal)**: Complete practitioner guide on salary benchmarks, legal compliance, and Scrum management.
- **[SaaS Product Architecture & Scalable Microservices](/insights/saas-product-architecture-microservices-cto-guide)**: Decoupled Next.js 15 & Laravel 12 API microservices design guide for CTOs.
- **[Start a Business in Nepal](/start-business-in-nepal)**: FITTA 2019 legal framework, 10-15% IT tax concessions, and 100% profit repatriation rights.',
                'website_url' => 'https://intechnexus.com',
                'my_role' => 'Founder & Managing Director',
                'locations' => ['Nepal', 'USA', 'Switzerland', 'Australia', 'Global'],
                'technologies' => ['Laravel 12', 'Next.js 15', 'TypeScript', 'Python AI', 'Docker', 'AWS Cloud', 'Redis', 'PostgreSQL'],
                'industries' => ['B2B SaaS', 'Fintech', 'Digital Health', 'Enterprise Automation', 'EdTech'],
                'faqs' => [
                    [
                        'question' => 'How does IntechNexus ensure high code quality and security for remote teams?',
                        'answer' => 'Every line of code submitted by our Nepal squads passes through automated static analysis, mandatory peer code reviews, and senior solution architect oversight. We enforce strict OWASP security standards, zero-trust cloud permissions, and SOC 2 / GDPR compliance protocols.'
                    ],
                    [
                        'question' => 'Who owns the Intellectual Property (IP) developed by IntechNexus squads?',
                        'answer' => 'You own 100% of all code, documentation, designs, and intellectual property. IP assignment clauses are legally binding and transferred automatically to your organization under our US/EU compliant contracts.'
                    ],
                    [
                        'question' => 'How quickly can a dedicated software development team be deployed?',
                        'answer' => 'Our standard onboarding timeline is 10 to 14 business days. For urgent requirements, we maintain a pipeline of pre-screened full-stack and DevOps engineers ready for immediate sprint integration.'
                    ],
                    [
                        'question' => 'What time zones do IntechNexus engineering squads operate in?',
                        'answer' => 'Our squads overlap with US East Coast, US West Coast, European (CET), and Australian (AEST) business hours. Daily async updates via Slack/Linear and daily synchronous standups ensure seamless workflow continuity.'
                    ],
                    [
                        'question' => 'What are the payment terms and billing models for dedicated squads?',
                        'answer' => 'We offer simple, transparent monthly B2B retainer invoicing in USD, EUR, or AUD. There are no hidden recruitment fees, local employment taxes, or capital equipment overheads.'
                    ]
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
                'description' => 'A premier digital growth and search agency engineering ROI-focused customer acquisition engines through code-level technical SEO, Answer Engine Optimization (AEO/GEO for AI platforms), performance ad funnels, and conversion optimization.',
                'content' => '# Digital Terai: Data-Driven Digital Growth & Search Engineering

Digital Terai is the digital marketing and search growth arm within Peshal Bhattarai\'s business ecosystem. We build high-converting customer acquisition funnels for global brands, B2B SaaS enterprises, e-commerce platforms, and luxury real estate ventures across Nepal, Dubai (GCC), and international markets.

By uniting technical search engine optimization (SEO), **Answer Engine Optimization (AEO)** for AI search platforms (ChatGPT, Perplexity, Google AI Overviews), high-ROI paid media management, and conversion rate engineering, Digital Terai turns search visibility into predictable, scalable revenue.

---

## 1. Core Service Pillars

### A. Technical SEO & Search Architecture
We engineer code-level search foundation for web applications:
- **Core Web Vitals Optimization**: Optimizing Largest Contentful Paint (LCP < 1.2s), Cumulative Layout Shift (CLS), and Interaction to Next Paint (INP).
- **Structured Schema Graphs**: Implementing custom JSON-LD schemas (`Organization`, `Article`, `FAQPage`, `HowTo`, `Product`) for rich search snippets.
- **International & Multi-Region SEO**: Configuring hreflang tags, dynamic canonical tags, and localized search architecture across global markets.

### B. Answer Engine Optimization (AEO / GEO)
Position your brand as the primary cited authority inside generative AI models:
- **Question-Answer-Evidence (QAE) Content Blocks**: Formatting content to directly answer high-intent user prompts with empirical evidence.
- **AI Citation Management**: Monitoring brand presence across ChatGPT, Perplexity, Claude, and Gemini to ensure inclusion in generative AI answers.
- **Information Gain & Data Density**: Publishing original data tables, benchmarks, and legal analyses that AI models index as reference sources.

### C. Performance Paid Media (PPC & Meta Ads)
Data-driven paid customer acquisition tailored for lower Customer Acquisition Costs (CAC):
- **Google Ads Mastery**: Managing high-intent Search, Performance Max (PMax), Display, and Remarketing campaigns.
- **Meta & LinkedIn Ads**: Precision B2B targeting and direct-response lead generation for enterprise tech and luxury property markets.
- **Multi-Touch Attribution Analytics**: Custom GA4 event tracking, server-side Google Tag Manager (sGTM), and revenue attribution models.

---

## 2. Proven Organic & Performance Growth Impact

| Campaign Metric | Traditional Approach | Digital Terai Engine | Performance Multiplier |
| :--- | :--- | :--- | :--- |
| **Organic Traffic Scale** | Unstructured Blog Content | Data-Dense Content Clusters + AEO | **3.5x – 5.0x Traffic Growth** |
| **Generative AI Citation Rate** | Standard HTML Pages | QAE Structured Schema Blocks | **+140% AI Model Inclusion** |
| **Average Page Load Speed** | 3.5s – 5.0s LCP | Next.js 15 & Image Edge Optimization | **< 1.2s LCP Score** |
| **Paid Media ROI / ROAS** | Single-Channel Bidding | Multi-Touch Funnel Optimization | **35% – 45% CAC Reduction** |

---

## 3. Related Growth Playbooks & Flagship Guides

Explore our detailed growth frameworks and strategy guides:
- **[Answer Engine Optimization (AEO) Playbook 2026](/insights/answer-engine-optimization-aeo-playbook-2026)**: Comprehensive guide to AI search engine citations and QAE content blocks.
- **[Digital Marketing & AEO ROI Benchmarks](/insights/digital-marketing-and-aeo-roi-benchmarks-nepal-dubai)**: CAC benchmarks, CPC metrics, and conversion data across South Asia & GCC.
- **[Start a Business in Dubai](/start-business-in-dubai)**: Learn how Digital Terai powers MENA market expansion and lead generation for Dubai enterprises.',
                'website_url' => 'https://digitalterai.com',
                'my_role' => 'Founder & Growth Director',
                'locations' => ['Nepal', 'Dubai (GCC)', 'USA', 'Australia', 'Global'],
                'technologies' => ['Google Analytics 4', 'Semrush', 'Screaming Frog', 'Meta Business Manager', 'Google Search Console', 'Ahrefs', 'Next.js 15'],
                'industries' => ['E-commerce', 'B2B Services', 'Dubai Real Estate', 'SaaS Growth', 'Hospitality'],
                'faqs' => [
                    [
                        'question' => 'How does Answer Engine Optimization (AEO) differ from traditional SEO?',
                        'answer' => 'Traditional SEO focuses on earning links to rank on Google search result pages. AEO formats your brand data into structured Question-Answer-Evidence (QAE) blocks and JSON-LD schemas so AI engines like ChatGPT, Perplexity, and Google AI Overviews cite your brand directly as the definitive answer.'
                    ],
                    [
                        'question' => 'What industries does Digital Terai specialize in?',
                        'answer' => 'We specialize in high-intent industries including B2B technology platforms, Dubai real estate, international travel operators, SaaS startups, and professional service enterprises.'
                    ],
                    [
                        'question' => 'How do you measure and report marketing return on investment (ROI)?',
                        'answer' => 'We deploy server-side Google Tag Manager (sGTM), GA4 custom conversion tracking, and CRM revenue attribution models, giving you 100% transparency into Cost Per Lead (CPL) and Customer Acquisition Cost (CAC).'
                    ],
                    [
                        'question' => 'Can Digital Terai handle technical SEO fixes on custom codebases?',
                        'answer' => 'Yes. Unlike traditional agencies that only provide static PDF recommendations, our technical search team works directly with engineers to patch Next.js, React, Laravel, or WordPress technical SEO bottlenecks directly in code.'
                    ],
                    [
                        'question' => 'What is the standard engagement model for Digital Terai services?',
                        'answer' => 'We offer monthly performance retainers for technical SEO & AEO execution, managed PPC ad performance, or turn-key digital growth audit sprints.'
                    ]
                ],
                'order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Nepal Trip Packages',
                'slug' => 'nepaltrippackages',
                'tagline' => 'Bespoke Luxury Expeditions, Private Everest Helicopter Tours & Adventure Operations',
                'category' => 'travel',
                'logo' => '/assets/images/companies/nepaltrippackages.png',
                'description' => 'A premier travel venture crafting customized luxury tours, VIP Everest helicopter fly-overs, Himalayan motorcycle journeys, photography expeditions, and B2B ground operations across Nepal for discerning global travelers.',
                'content' => '# Nepal Trip Packages: Luxury Travel Operations & Himalayan Expeditions

Nepal Trip Packages is a specialized travel venture dedicated to delivering high-end, customized travel experiences across Nepal. Operating with a commitment to absolute safety, luxury logistics, and authentic Himalayan immersion, we cater to high-net-worth travelers, corporate groups, and international B2B travel agency partners.

From private VIP Everest helicopter fly-overs to luxury lodge treks and off-road Himalayan motorcycle expeditions, Nepal Trip Packages redefines high-altitude adventure with uncompromised hospitality and precision flight operations.

---

## 1. Signature Tour Operations & Offerings

### A. VIP Everest Base Camp Helicopter Expedition
Our flagship single-day luxury mountain experience:
- **Kathmandu to Lukla Flight**: Scenic charter flight with private ground handling and clearance.
- **Everest Base Camp & Khumbu Glacier Fly-over**: Close-proximity aerial view of Mount Everest (8,848m), Lhotse, Nuptse, and the iconic Khumbu Icefall.
- **Kala Patthar Touchdown (5,545m)**: Exclusive high-altitude landing for panoramic high-resolution photography.
- **Gourmet Breakfast at Hotel Everest View (3,880m)**: Champagne breakfast overlooking the Himalayan skyline before return flight.

### B. Tailored Luxury Himalayan Treks
- **5-Star Luxury Mountain Lodge Stays**: Partnering with premier mountain lodges (Yeti Mountain Home, Everest Summit Lodges) offering heated rooms, en-suite bathrooms, and fine dining.
- **Private Sherpa Guides & High-Altitude Medics**: Dedicated certified high-altitude guides, portable hyperbaric chambers, and continuous pulse oximeter monitoring.
- **Satellite Connectivity**: Uninterrupted high-speed satellite communications throughout remote mountain trails.

### C. Customized Adventure & Photography Expeditions
- **Guided Himalayan Motorcycle Journeys**: Off-road expeditions through Upper Mustang and the Annapurna Circuit equipped with support 4x4 vehicles and mechanic crews.
- **Wildlife Safaris in Chitwan & Bardia**: Private jeep safaris tracking Bengal tigers and one-horned rhinoceroses with expert naturalists.

### D. B2B Ground Operations & White-Label Destination Management
- **Turnkey B2B Partner Support**: Providing complete ground logistics, permit processing, helicopter dispatch, and white-label itineraries for global travel operators.

---

## 2. Operational & Safety Blueprint Matrix

| Operational Component | Standard Trekking Operator | Nepal Trip Packages Standard |
| :--- | :--- | :--- |
| **Helicopter Charter Fleet** | Multi-passenger Shared Seats | **Private Airbus AS350 B3e (H125) Charter** |
| **High-Altitude Emergency Protocols** | Standard First Aid | **Satellite Dispatch + Automatic Medevac Guarantee** |
| **Accommodations** | Standard Teahouses | **Pre-Vetted Luxury Mountain Lodges & 5-Star Hotels** |
| **Ground Logistics & Permits** | Manual On-Site Processing | **Pre-Cleared Digital Permits & VIP Airport Transfer** |

---

## 3. Related Travel Guides & Strategic Links

Explore our specialized travel guides and mountain expedition blueprints:
- **[Private Everest Base Camp Helicopter Expedition Guide](/insights/private-everest-base-camp-helicopter-expedition-guide)**: Full itinerary breakdown, flight safety protocols, and packing checklist.
- **[Start a Business in Nepal](/start-business-in-nepal)**: Discover economic growth, hospitality sector opportunities, and FDI frameworks in Nepal.
- **[Book / Request Helicopter Reservation](/contact?category=travel)**: Direct booking inquiry and customized itinerary planning.',
                'website_url' => 'https://nepaltrippackages.com',
                'my_role' => 'Founder & Business Architect',
                'locations' => ['Kathmandu', 'Pokhara', 'Everest Region', 'Annapurna Circuit', 'Global Partners'],
                'technologies' => ['Custom Booking Engine', 'Next.js 15', 'Stripe Multi-Currency', 'CRM Dispatch', 'GPS Flight Tracking'],
                'industries' => ['Luxury Travel', 'Adventure Tourism', 'Himalayan Expeditions', 'B2B Travel Distribution'],
                'faqs' => [
                    [
                        'question' => 'What is the flight itinerary for the Everest Base Camp Helicopter Tour?',
                        'answer' => 'The flight departs Kathmandu early morning, refuels at Lukla, flies over Everest Base Camp and the Khumbu Glacier, lands briefly at Kala Patthar (5,545m) for photo opportunities, and stops at Hotel Everest View (3,880m) for a gourmet breakfast before returning to Kathmandu.'
                    ],
                    [
                        'question' => 'How does Nepal Trip Packages handle high-altitude acclimatization and safety?',
                        'answer' => 'Our flight paths and trekking routes are designed around strict acclimatization thresholds. All private guides carry emergency oxygen cylinders, medical first-aid kits, and satellite communication devices with instant helicopter evacuation dispatch capability.'
                    ],
                    [
                        'question' => 'Do you provide white-label destination management for international travel agencies?',
                        'answer' => 'Yes. We serve as the trusted on-ground B2B partner in Nepal for international luxury travel agencies, providing customized white-label itineraries, private helicopter charters, and VIP concierge services.'
                    ],
                    [
                        'question' => 'What is the best time of year to book an Everest helicopter expedition?',
                        'answer' => 'The optimal weather windows are Spring (March to May) and Autumn (September to December), offering crystal-clear mountain visibility, stable flight conditions, and pleasant temperatures.'
                    ],
                    [
                        'question' => 'Are customized private itineraries available for families or corporate groups?',
                        'answer' => 'Yes. Every itinerary can be fully customized with private helicopter transfers, luxury 5-star accommodations, flexible rest days, and tailored activities.'
                    ]
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
                'description' => 'A premier Dubai real estate investment platform matching international buyers, technology founders, and family offices with high-yielding off-plan developments, luxury ready villas, and turnkey 10-Year UAE Golden Visa residency.',
                'content' => '# 360Castle: Dubai Real Estate & Property Advisory

360Castle operates as the real estate investment and property advisory platform within Peshal Bhattarai\'s business ecosystem. We connect global entrepreneurs, high-net-worth investors, and family offices with top-tier Dubai property portfolios designed for strong capital appreciation, risk-adjusted rental yields, and long-term UAE residency.

Whether you are seeking high-yield off-plan residential developments or luxury ready villas in prime communities, 360Castle delivers end-to-end transaction advisory, developer vetting, and **10-Year UAE Golden Visa** application management.

---

## 1. Core Property Advisory Specializations

### A. High-Yield Off-Plan Property Selection
We secure priority allocation in Dubai\'s most lucrative off-plan developments:
- **Tier-1 Developer Partnerships**: Direct access to master developments by Emaar Properties, Nakheel, Sobha Realty, and Damac.
- **Investor Payment Plan Structuring**: Flexible 50/50, 60/40, or post-handover payment plans minimizing initial capital outlay.
- **Capital Growth Modeling**: Selecting high-growth corridors (Dubai South, Business Bay, Dubai Creek Harbour) projected for 18% to 24% Internal Rate of Return (IRR).

### B. Luxury Ready Villa & Apartment Portfolios
- **Prime Location Matching**: Exclusive waterfront villas, penthouses, and luxury residences in Palm Jumeirah, Dubai Hills Estate, Downtown Dubai, and Emirates Hills.
- **High Cash-Flow Rental Assets**: Curating residential properties delivering **6.5% to 8.5% gross annual rental yields**—outperforming London, NYC, and Singapore.
- **Turnkey Property Management**: Short-term holiday home management and long-term tenant placement for international absentee owners.

### C. 10-Year UAE Golden Visa Structuring
- **AED 2,000,000 Threshold Qualification**: Guiding buyers to qualify for the renewable 10-Year UAE Golden Visa through single or combined property purchases (valued at ~$545,000 USD+).
- **Title Deed & DLD Processing**: Direct handling of Dubai Land Department (DLD) registration, mortgage approvals, and visa application submission.

---

## 2. Global Capital & Yield Benchmark Comparison

| Financial Capital | Gross Rental Yield | Capital Gains Tax | Annual Property Tax | Residency Incentive |
| :--- | :--- | :--- | :--- | :--- |
| **Dubai (UAE)** | **6.5% – 8.5%** | **0% Tax** | **0% Tax** | **10-Year Golden Visa (AED 2M)** |
| **London (UK)** | 3.8% – 4.5% | Up to 28% CGT | Council Tax Rates | None |
| **New York (USA)** | 3.5% – 4.2% | Up to 20%+ Federal | 0.8% – 2.0% Annual | EB-5 ($800k+ Minimum) |
| **Singapore** | 2.8% – 3.4% | 0% Tax | Up to 36% Tiered | GIP (SGD 10M+ Capital) |

---

## 3. Related Investment Guides & Strategic Links

Explore our specialized financial models and market blueprints:
- **[Dubai Real Estate Investment Guide for Founders](/insights/dubai-real-estate-investment-guide-for-founders)**: Deep-dive into rental yields, tax advantages, and Golden Visa qualification.
- **[Off-Plan vs. Ready Villas Financial Model](/insights/dubai-off-plan-vs-ready-villas-financial-model)**: Empirical IRR financial modeling and 3-phase property exit strategies.
- **[Start a Business in Dubai](/start-business-in-dubai)**: Free Zone vs Mainland jurisdiction guide, 9% corporate tax rules, and company setup.',
                'website_url' => 'https://360castle.com',
                'my_role' => 'Founder & Real Estate Partner',
                'locations' => ['Dubai, UAE', 'Abu Dhabi', 'GCC Region', 'International Markets'],
                'technologies' => ['3D Virtual Tour Renderers', 'PropTech Matching Engine', 'Dubai Land Department (DLD) API', 'MLS Data Integration'],
                'industries' => ['Dubai Real Estate', 'Off-Plan Investment', 'Luxury Housing', 'Property Advisory'],
                'faqs' => [
                    [
                        'question' => 'How can an international investor qualify for a 10-Year UAE Golden Visa through 360Castle?',
                        'answer' => 'Under current UAE regulations, foreign buyers qualify for a 10-Year Golden Visa by purchasing residential property with a total value of AED 2,000,000 (~$545,000 USD) or higher. Off-plan properties from accredited master developers qualify, and mortgage financing is permitted up to 80%.'
                    ],
                    [
                        'question' => 'What is the average gross rental yield for residential property in Dubai?',
                        'answer' => 'Dubai residential properties generate average gross rental yields of 6.5% to 8.5% annually, depending on location and unit type. Prime areas like Business Bay, Dubai Marina, and Jumeirah Village Circle (JVC) frequently exceed 8% returns.'
                    ],
                    [
                        'question' => 'Are there any personal income or capital gains taxes on Dubai property sales?',
                        'answer' => 'No. Dubai charges 0% personal income tax and 0% capital gains tax on property sales. Foreign owners enjoy 100% tax-free rental income and capital appreciation.'
                    ],
                    [
                        'question' => 'What is the financial difference between off-plan properties and ready villas?',
                        'answer' => 'Off-plan developments offer lower entry prices, developer payment plans (e.g. 50/50), and higher potential capital appreciation (18-24% projected IRR). Ready villas provide immediate rental income (6.5-8.5% yield) and instant occupancy for Golden Visa residency.'
                    ],
                    [
                        'question' => 'How does 360Castle assist international property buyers remotely?',
                        'answer' => 'We offer full remote purchasing support including 3D virtual walkthroughs, digital Dubai Land Department (DLD) registration, escrow account verification, and power-of-attorney representation.'
                    ]
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

            // Add/Update SEO Metadata for Venture
            SeoMetadata::updateOrCreate(
                [
                    'model_type' => Venture::class,
                    'model_id' => $v->id,
                ],
                [
                    'meta_title' => "{$v->name} | {$v->tagline}",
                    'meta_description' => $v->description,
                    'keywords' => strtolower("{$v->name}, {$v->category}, peshal bhattarai venture, business builder, " . implode(', ', $v->technologies)),
                    'canonical_url' => "https://www.peshalb.com.np/ventures/{$v->slug}",
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
