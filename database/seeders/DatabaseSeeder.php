<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogAuthor;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Service;
use App\Models\Company;
use App\Models\Testimonial;
use App\Models\PortfolioProject;
use App\Models\CaseStudy;
use App\Models\Faq;
use App\Models\TeamMember;
use App\Models\JobListing;
use App\Models\Resource;
use App\Models\Event;
use App\Models\Award;
use App\Models\Certification;
use App\Models\Podcast;
use App\Models\Video;
use App\Models\SeoMetadata;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@peshal.com'],
            [
                'name' => 'Peshal Bhattarai',
                'password' => bcrypt('Peshal@123456'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Create Blog Author
        $author = BlogAuthor::updateOrCreate(
            ['slug' => 'peshal-bhattarai'],
            [
                'name' => 'Peshal Bhattarai',
                'avatar' => '/assets/images/peshal1.jpg',
                'bio' => 'Senior Technology Leader, Product Manager, Growth Digital Marketer, and Business Consultant with over 10 years of experience driving SaaS product strategy, AEO/SEO search dominance, and enterprise digital transformation globally from Nepal.',
                'designation' => 'Product Manager, Growth Marketer & Business Consultant',
                'email' => 'peshal@intechnexus.com',
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/in/peshal-bhattarai',
                    'twitter' => 'https://twitter.com/peshalb',
                    'github' => 'https://github.com/peshalb',
                    'medium' => 'https://medium.com/@peshalb'
                ]
            ]
        );

        // 3. Blog Categories
        $categoriesData = [
            'Agile' => 'Frameworks, methodologies, and scaling practices for modern business agility.',
            'Scrum' => 'Practical Scrum practices, sprint planning, backlog refinement, and team roles.',
            'Business' => 'Entrepreneurship, venture building, operational excellence, and corporate strategy.',
            'Project Management' => 'Traditional and modern project execution, risk mitigation, and tracking.',
            'Product Management' => 'Product discovery, product roadmapping, MVP prioritization, and user validation.',
            'Digital Marketing' => 'Data-driven marketing, customer acquisition, performance marketing, and branding.',
            'SEO' => 'Technical, local, ecommerce, and international SEO strategies that drive organic traffic.',
            'Software Development' => 'Laravel, Next.js, clean architecture, SOLID principles, and API engineering.',
            'Leadership' => 'Executive coaching, team building, organizational culture, and mentorship.',
            'Technology' => 'Cloud computing, DevOps, enterprise architecture, and emerging tech platforms.',
            'Startup' => 'Venture creation, fundraising, MVP building, and growth hacking strategies.',
            'Entrepreneurship' => 'Venture portfolios, multi-agency operations, and building recurring revenue.',
            'IoT' => 'Internet of Things ecosystem, hardware integration, smart automation, and edge computing.',
            'Agritech' => 'Smart agriculture, IoT-powered remote crop monitoring, automation in farming.',
            'Artificial Intelligence' => 'Large Language Models, AI integrations, data science, and business process automation.',
            'Cloud' => 'AWS, Azure, serverless architecture, hybrid cloud models, and data security.',
            'DevOps' => 'Continuous Integration, Continuous Deployment, NGINX, Redis, Docker, and infrastructure as code.',
            'Remote Teams' => 'Managing global distributed developers, collaborative tools, and productivity workflows.',
            'Business Growth' => 'Scaling business operations, client acquisition models, and sales pipelines.',
            'Digital Transformation' => 'Legacy modernization, business process automation, and culture-first change management.',
            'Case Studies' => 'Real-world problem, solution, approach, and ROI analyses of completed projects.',
            'Productivity' => 'Workplace optimization, time management frameworks, and automation tools.',
            'Automation' => 'Eliminating manual work through custom script integrations, ERPs, and CRMs.',
            'Business Strategy' => 'Strategic planning, market research, competitor profiling, and roadmap design.'
        ];

        $categories = [];
        $order = 1;
        foreach ($categoriesData as $name => $desc) {
            $cat = BlogCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc,
                'order' => $order++,
            ]);
            
            // Attach SEO metadata for category
            $cat->seo()->create([
                'meta_title' => "Insights on $name | Peshal Bhattarai",
                'meta_description' => "Read expert articles, guides, and strategic advice on $name written by Technology Consultant Peshal Bhattarai.",
                'keywords' => strtolower("$name, consulting, agile, tech leader, peshal bhattarai"),
                'canonical_url' => "https://peshalbhattarai.com/blog/" . Str::slug($name),
            ]);

            $categories[$name] = $cat;
        }

        // 4. Blog Tags
        $tagsData = ['laravel', 'nextjs', 'scrum-master', 'agile-coach', 'saas', 'iot', 'agritech', 'seo', 'cloud', 'scaling', 'api', 'docker', 'mysql', 'growth', 'remote-work', 'devops'];
        $tags = [];
        foreach ($tagsData as $tName) {
            $tags[$tName] = BlogTag::create([
                'name' => ucwords(str_replace('-', ' ', $tName)),
                'slug' => $tName
            ]);
        }

        // 5. Blog Posts & 100 SEO-ready Blog Titles Seeding (as actual blogs or drafts)
        // Seeding 6 detailed featured blog posts first, with complete body content.
        $blogsDetail = [
            [
                'title' => 'Scaling Agile Frameworks in Enterprise Software Architecture',
                'summary' => 'A comprehensive playbook on how to align SAFe methodologies with modern microservices architectures and remote engineering teams.',
                'content' => '# Scaling Agile Frameworks in Enterprise Software Architecture\n\nModern enterprises face a twin challenge: scaling their software systems while simultaneously scaling their product delivery organizations. Traditional software architecture is monolithic, mirroring the hierarchical, siloed structure of the organizations that created them (Conway\'s Law). To build agile systems, we must build agile teams.\n\n## 1. Aligning Organization Structure and Software Architecture\nApplying Conway\'s Law in reverse—the "Inverse Conway Maneuver"—involves structuring teams to reflect the desired target architecture. Instead of monolithic engineering teams, structure them as cross-functional, domain-driven "Two-Pizza Teams". Each team owns a microservice, from database schema to CI/CD pipeline.\n\n### Core Benefits:\n- **Reduced Cognitive Load**: Teams focus on a single, isolated domain boundary.\n- **Independent Deployability**: Services can be built, tested, and released independently.\n- **Faster Feedback Loops**: Shorter deployment pipelines speed up customer validation.\n\n## 2. Choosing the Right Agile Scaling Framework\nWhen transitioning from a single Scrum team to dozens, frameworks like SAFe (Scaled Agile Framework), LeSS (Large-Scale Scrum), or the Spotify Model are frequently evaluated. However, standard blueprints fail without adapting to technical architecture:\n- **SAFe**: Ideal for heavily regulated environments requiring rigorous planning events (Program Increments) and strict compliance.\n- **LeSS**: Fits smaller organizations seeking to minimize management layers and keep Scrum pure across multi-team backlogs.\n- **Custom Hybrid**: The recommended approach. Take the structural coordination of SAFe (system demos, syncs) and pair it with the flexibility and autonomy of the Spotify Model (tribes, guilds).\n\n## 3. Tech Stack Enablement\nAgile scaling is impossible without technical excellence. Legacy testing and deployment processes must be automated. The technical foundations include:\n- **CI/CD Pipelines**: Automatic testing using Docker, GitHub Actions, and PHPUnit/Jest.\n- **Feature Flagging**: Decouple deployment from release. Push code to production safely behind toggle flags.\n- **API First Design**: Define openAPI contracts before writing any code. Teams can mock endpoints and develop frontend and backend concurrently.\n\n## Conclusion\nTransitioning to enterprise agility is not merely a process shift; it is an architectural rebuild. Only by aligning domain-driven microservices with agile, cross-functional squads can you achieve true software velocity and system resilience.',
                'category' => 'Agile',
                'reading_time' => 8,
                'tags' => ['agile-coach', 'scrum-master', 'scaling']
            ],
            [
                'title' => 'The Blueprint for Legacy Application Migration to Laravel 12',
                'summary' => 'A step-by-step roadmap for migrating legacy PHP 7.x codebases to Laravel 12 and PHP 8.4, detailing repository patterns, caching strategies, and safety audits.',
                'content' => '# The Blueprint for Legacy Application Migration to Laravel 12\n\nMigrating a legacy application to a modern framework is one of the most high-stakes tasks a technical leader can undertake. The business demands zero downtime and no regression, while the engineering team struggles with brittle, untyped code. This guide outlines an enterprise-grade roadmap to migrate PHP applications safely to Laravel 12 and PHP 8.4.\n\n## Step 1: Establish a Safety Net (Unit & Integration Testing)\nBefore changing a single line of legacy code, write integration tests that cover critical business paths (e.g., checkout flows, auth systems). These tests act as a regression detector.\n\n```php\n// Example: Laravel Integration Test for legacy endpoints\npublic function test_legacy_checkout_path_resolves_correctly()\n{\n    $response = $this->postJson(\'/api/v1/checkout\', [\n        \'cart_id\' => 12345,\n        \'payment_method\' => \'stripe\'\n    ]);\n    $response->assertStatus(200);\n}\n```\n\n## Step 2: Implement the Strangler Fig Pattern\nDo not attempt a "big-bang" rewrite. Instead, place Laravel as a proxy in front of the legacy app. Route new features to Laravel, while routing old features to the legacy system. Gradually migrate legacy routes to Laravel controllers until the legacy codebase is fully decommissioned.\n\n## Step 3: Utilize Modern PHP 8.4 Features\nPHP 8.4 offers major performance and syntax upgrades. Leverage them in your new Laravel 12 controllers and service layers:\n- **Asymmetric Visibility**: Simplify property setters/getters.\n- **Property Hooks**: Execute custom logic on property writes directly.\n- **Types Everywhere**: Ensure all function signatures use strict types (`declare(strict_types=1);`).\n\n## Step 4: Leverage Repository and Service Patterns\nTo keep your controllers thin, segregate DB operations and business logic:\n- **Repository Layer**: Responsible for fetching database data (using Eloquent).\n- **Service Layer**: Orchestrates business rules, fires event listeners, manages caches, and sends notifications.\n\n## Summary\nLaravel 12 is a powerful engine for digital transformation. By applying the Strangler Fig pattern and building a robust testing suite, you can safely transform a legacy liability into a modern, performant, and scale-ready asset.',
                'category' => 'Software Development',
                'reading_time' => 12,
                'tags' => ['laravel', 'api', 'mysql']
            ],
            [
                'title' => 'International SEO Architecture: Building for Multi-Country Markets',
                'summary' => 'Discover how to architect a domain strategy, implement hreflang tags, configure Cloudflare routing, and optimize content for worldwide search engines.',
                'content' => '# International SEO Architecture: Building for Multi-Country Markets\n\nExpanding your business globally requires more than translating copy. Search engines must understand exactly which version of your page to serve to users in different countries and languages. Misconfigured settings can lead to duplicate content penalties and poor user experience. Here is the technical SEO blueprint for international market architecture.\n\n## 1. Domain Strategy Decisions\nYou have three primary routes for domain structure:\n- **ccTLDs (Country Code Top-Level Domains)**: e.g., `domain.co.uk`, `domain.ae`. Offers the strongest local signal but requires maintaining separate domain authorities.\n- **Subdirectories**: e.g., `domain.com/uk/`, `domain.com/ae/`. Combines all authority into one domain and is easy to set up. Highly recommended for startups and growing enterprises.\n- **Subdomains**: e.g., `uk.domain.com`, `ae.domain.com`. Useful for separating distinct technical operations but splits domain equity.\n\n## 2. Implementing Hreflang Tags Correctly\nHreflang tags tell Google which language and region a specific URL is targeting. Implement them in the HTML `<head>`, in the XML sitemap, or via HTTP headers.\n\n```html\n<link rel=\"alternate\" hreflang=\"en-us\" href=\"https://example.com/us/\" />\n<link rel=\"alternate\" hreflang=\"en-gb\" href=\"https://example.com/uk/\" />\n<link rel=\"alternate\" hreflang=\"ar-ae\" href=\"https://example.com/ae/\" />\n<link rel=\"alternate\" hreflang=\"x-default\" href=\"https://example.com/\" />\n```\n\n## 3. Cloudflare Edge Redirects and Localization\nUse Cloudflare Workers to inspect the incoming request country header (`CF-IPCountry`) and redirect users dynamically to their local subdirectory with low latency, while preserving search crawler access to all versions.\n\n## 4. Core Metrics and Performance\nInternational users have widely varying network speeds. Ensure your Core Web Vitals (LCP, FID, CLS) are optimized internationally by caching static pages on global edge servers (CDNs) and dynamically compressing images.',
                'category' => 'SEO',
                'reading_time' => 10,
                'tags' => ['seo', 'cloud', 'growth']
            ],
            [
                'title' => 'Smart Agritech: Scaling IoT Automation in Remote Farm Monitoring',
                'summary' => 'An inspection of sensor telemetry networks, edge AI compute, low-power cellular protocols, and dashboards built for high-scale agricultural automation.',
                'content' => '# Smart Agritech: Scaling IoT Automation in Remote Farm Monitoring\n\nAgriculture is undergoing a technological revolution driven by the Internet of Things (IoT). By collecting real-time soil, weather, and crop health metrics, farmers can automate irrigation, optimize fertilizer usage, and predict yields with unprecedented accuracy. This article details the hardware and software architecture of an enterprise IoT Agritech solution.\n\n## 1. Sensor Telemetry Networks\nRemote farms lack reliable power grids and Wi-Fi networks. Thus, we deploy battery-powered sensors using low-power wide-area networks (LPWAN):\n- **LoRaWAN**: Long-range wireless communication that operates on unlicensed bands. Perfect for private farm-wide networks where sensors transmit small data packets up to 15km.\n- **NB-IoT / LTE-M**: Cellular network protocols for sensor deployment where mobile coverage is available. Low power consumption allows devices to run for up to 10 years on a single AA battery.\n\n## 2. Telemetry Ingestion Architecture\nThe backend must ingest thousands of telemetry payloads per second without blocking. We use an event-driven ingestion pipeline:\n1. **MQTT Broker**: Lightweight broker (like EMQX or Mosquitto) receives JSON payloads from IoT gateways.\n2. **Laravel Queue Worker**: Payload is validated, parsed, and pushed to a Redis queue.\n3. **Time-Series Database**: Telemetry is written to a time-series optimized store (like TimescaleDB or InfluxDB) for fast analytical queries.\n\n## 3. Closed-Loop Irrigation Automation\nInstead of just displaying dashboards, the system acts autonomously. When soil moisture sensors report values below a threshold for consecutive hours, the backend triggers an API callback that sends a LoRa downlink command to turn on irrigation valves. Once the target moisture level is reached, another downlink commands the valve to shut down, saving water and labor costs.',
                'category' => 'Agritech',
                'reading_time' => 11,
                'tags' => ['iot', 'agritech', 'cloud']
            ],
            [
                'title' => 'Digital Transformation in Fintech: Architecture for Legacy Modernization',
                'summary' => 'A guide for CTOs looking to modernise legacy banking cores, build compliant APIs, and scale secure transaction pipelines with zero operational downtime.',
                'content' => '# Digital Transformation in Fintech: Legacy Modernization\n\nFinancial technology (Fintech) is evolving at a breakneck speed. Legacy banks and insurance companies, bound by decades-old mainframe core architectures, struggle to keep pace with agile, cloud-native startups. Legacy modernization is no longer optional—it is a survival imperative. This article outlines the architectural principles for a secure, phased digital transformation.\n\n## 1. Decoupling the Core with APIs\nThe biggest mistake is attempting a direct replacement of the core ledger system immediately. Instead, wrap the mainframe core in a modern API layer. Create a Microservices Integration Layer that communicates with the mainframe via secure queue middleware (e.g., RabbitMQ, Kafka) or RPC. This allows mobile and web clients to access account services through clean REST APIs or GraphQL endpoints without interacting with legacy interfaces directly.\n\n## 2. Security and Compliance Architecture\nFintech applications require rigorous compliance (PCI-DSS, GDPR, PSD2):\n- **Tokenization**: Never store raw credit card numbers or sensitive credentials. Generate secure tokens via gateways like Stripe or Adyen.\n- **OAuth2 / OIDC**: Implement Laravel Sanctum or Passport to authenticate API requests with short-lived tokens and refresh tokens.\n- **Audit Logging**: Maintain tamper-proof database audit tables using hash chains to log every transaction and admin modification.\n\n## 3. Real-Time Transaction Processing\nLegacy batch processing is replaced by event streaming. When a customer initiates a transaction, it is published to a distributed log (like Apache Kafka). Downstream services (fraud detection, email notification, accounting ledgers) subscribe to this stream and process events concurrently, ensuring sub-second response times.',
                'category' => 'Digital Transformation',
                'reading_time' => 9,
                'tags' => ['api', 'cloud', 'scaling']
            ],
            [
                'title' => 'Building a High-Performance Next.js 15 App Router Frontend',
                'summary' => 'Learn how to leverage React Server Components, TanStack Query, and TailwindCSS to create an Apple-level clean frontend that scores 100 on PageSpeed.',
                'content' => '# Building a High-Performance Next.js 15 App Router Frontend\n\nNext.js 15 App Router introduces a paradigm shift in web development, focusing heavily on React Server Components (RSC), automatic code-splitting, and streaming responses. To stand out, enterprise websites must combine high visual fidelity with near-zero latency. Here is how to architect an Apple-level clean Next.js 15 frontend.\n\n## 1. The Core Architecture: React Server Components vs. Client Components\nBy default, Next.js 15 components are Server Components. They render entirely on the server, resulting in smaller bundle sizes and fast First Contentful Paint (FCP) because no JavaScript is shipped to the client for rendering. Use client components (`\'use client\'`) sparingly—only when page components require state, interactivity, or browser APIs (like animations via Framer Motion).\n\n```tsx\n// Example of Server Component fetching dynamic Laravel API data\nimport { fetchCompanyVentures } from \'@/lib/api\';\n\nexport default async function VenturesPage() {\n  const ventures = await fetchCompanyVentures();\n  \n  return (\n    <main className=\"p-8 bg-black text-white\">\n      <h1 className=\"text-4xl font-semibold mb-6\">Our Ventures</h1>\n      <div className=\"grid gap-6 md:grid-cols-2\">\n        {ventures.map((venture) => (\n          <VentureCard key={venture.id} data={venture} />\n        ))}\n      </div>\n    </main>\n  );\n}\n```\n\n## 2. Dynamic Animations with Framer Motion\nTo create a premium user experience, implement subtle animations. Avoid heavy library imports. Use framer-motion\'s lazy rendering and animate elements only when they enter the viewport to avoid page stuttering.\n\n## 3. SEO Optimization with Metadata API\nNext.js 15 has built-in support for generating static and dynamic meta-data. You can extract SEO parameters directly from the backend API and map them to metadata tags, creating an ideal JSON-LD scheme, XML sitemap connections, and og-images.',
                'category' => 'Next.js',
                'reading_time' => 7,
                'tags' => ['nextjs', 'saas', 'growth']
            ]
        ];

        foreach ($blogsDetail as $bData) {
            $cat = $categories[$bData['category']] ?? $categories['Agile'];
            $blog = Blog::create([
                'title' => $bData['title'],
                'slug' => Str::slug($bData['title']),
                'summary' => $bData['summary'],
                'content' => $bData['content'],
                'featured_image' => '/assets/images/blogs/' . Str::slug($bData['title']) . '.jpg',
                'reading_time' => $bData['reading_time'],
                'author_id' => $author->id,
                'category_id' => $cat->id,
                'is_published' => true,
                'published_at' => now(),
            ]);

            // Sync tags
            $tagIds = [];
            foreach ($bData['tags'] as $t) {
                if (isset($tags[$t])) {
                    $tagIds[] = $tags[$t]->id;
                }
            }
            $blog->tags()->sync($tagIds);

            // Add SEO Metadata
            $blog->seo()->create([
                'meta_title' => $bData['title'] . ' | Peshal Bhattarai',
                'meta_description' => $bData['summary'],
                'keywords' => implode(', ', array_merge([strtolower($bData['category'])], $bData['tags'], ['technology consulting'])),
                'canonical_url' => 'https://peshalbhattarai.com/blog/' . Str::slug($bData['title']),
                'og_title' => $bData['title'],
                'og_description' => $bData['summary'],
                'og_image' => '/assets/images/blogs/' . Str::slug($bData['title']) . '-og.jpg',
            ]);
        }

        // Add 94 more blog titles to reach 100 SEO-ready titles
        $moreBlogTitles = [
            // Agile & Scrum (20)
            'Mastering Scrum: A Guide to Transitioning from Project Manager to Agile Practitioner',
            'Agile Estimations: Why Story Points Trump Hours in Modern Software Teams',
            '10 Backlog Grooming Mistakes That Are Ruining Your Agile Velocity',
            'Effective Sprint Planning: The Secret to High-Performance Agile Delivery',
            'Scaling Scrum: An In-Depth Look at Large Scale Scrum (LeSS) Framework',
            'Agile Metrics: How to Measure and Increase Team Delivery Speed Safely',
            'Retrospective Ideas: How to Run Engaging Agile Retrospective Meetings',
            'Agile Leadership: How Executives Can Foster Trust and Autonomy',
            'The Daily Standup Checklist: 15 Minutes to Align Distributed Teams',
            'Overcoming Resistance: A Change Agent\'s Guide to Agile Adoption',
            'Why Scrum Fails in Monolithic Corporate Structures and How to Adapt It',
            'Agile Contracting: Designing Vendor Contracts Built for Iterative Projects',
            'Scrum Master Coaching: Techniques to Guide Junior Product Owners',
            'Scrum vs Kanban: When to Use Which in Product Engineering Pipelines',
            'Agile Release Train (ART): Organizing Teams for Continuous Flow',
            'Coaching Stakeholders: Managing Scope and Timelines in Agile Budgets',
            'Fostering Psychological Safety: The Core of Productive Agile Squads',
            'Agile Product Roadmaps: Communicating Long-Term Strategy with Flex Scope',
            'Measuring Business Agility: Metrics for Executive Leaders',
            'Handling Technical Debt inside Sprint Backlogs: Best Engineering Practices',
            
            // Business Consulting & Digital Transformation (20)
            'The digital transformation playbook for legacy manufacturing systems',
            'How to conduct a complete technology audit for mid-market companies',
            'Venture Building: How to go from validation to launch in 90 days',
            'CTO as a Service: Why mid-sized businesses need temporary tech leadership',
            'Corporate Innovation: How to build software startups inside enterprises',
            'Automating processes to cut operational costs by 40 percent',
            'Evaluating SaaS models for legacy enterprise software products',
            'Designing product strategy for high-growth business applications',
            'AI Readiness: Assessing data pipelines before implementing LLMs',
            'Cloud Migration ROI: Calculating cost savings and performance gains',
            'The role of digital transformation in modernizing agritech hardware',
            'Enterprise CRM setups: A roadmap to aligning sales and marketing',
            'Startup Consulting: 10 structural mistakes founders make before launching MVPs',
            'Managing capital allocation between core business and new ventures',
            'Building operational dashboards: KPIs for CEO and executive boards',
            'Legacy data modernization: Transitioning databases to modern data lakes',
            'Overcoming the digital transformation bottleneck: Culture vs Tech',
            'Business process mapping: Streamlining workflows before writing code',
            'SaaS Pricing Models: Strategies for Enterprise Contract Negotiations',
            'Customer Acquisition Cost: Metrics to track for scaling digital products',

            // SEO & Digital Marketing (20)
            'The Technical SEO checklist for Next.js 15 App Router websites',
            'International SEO: Dynamic hreflang setups for localized markets',
            'Performance Marketing: Scaling Google Ads campaigns for enterprise leads',
            'Local SEO strategies to dominate search results in Dubai markets',
            'Ecommerce SEO: Optimizing category pages for high search volume keywords',
            'Social Media Branding: Building executive authority on LinkedIn and X',
            'Content Marketing Funnels: Mapping articles to buyer decision journeys',
            'Lead Generation Strategy: Designing high-converting SaaS landing pages',
            'Marketing Automation: Setting up automated email flows in Brevo/Hubspot',
            'Google Analytics 4 setup: Custom event tracking for product conversions',
            'How core web vitals impact search engine rankings on mobile devices',
            'The future of SEO: Adapting your site for search engine generative answers',
            'Creating high-value whitepapers: B2B lead magnets that build pipeline',
            'Mobile App Marketing: Organic App Store Optimization (ASO) frameworks',
            'Analyzing competitor backlinks: Strategies to build high-authority links',
            'Dynamic OpenGraph (OG) image generation: Enhancing social click-through rate',
            'Sitemap configuration for multi-brand international business portals',
            'Domain Migration Checklist: Changing brands with zero search visibility loss',
            'Building newsletter databases: Opt-in designs that convert web visitors',
            'Technical Audit: How to find and fix crawl depth issues on large sites',

            // Technology, Architecture, & DevOps (20)
            'Building a clean architecture API backend with Laravel 12',
            'Next.js 15 and TanStack Query: Handling state in client components',
            'Deploying Laravel with Docker, NGINX, and Redis for high-scale traffic',
            'Rate Limiting strategies: Securing public APIs with Sanctum tokens',
            'Database Optimization: Indexing strategies for MySQL 8 systems',
            'Continuous Integration: Setting up automated pipelines using GitHub Actions',
            'Why Redis cache is critical for dynamic enterprise web dashboards',
            'Designing event-driven architecture using Laravel Queue Workers',
            'Security Best Practices: Preventing XSS, CSRF, and SQL injections in PHP',
            'API Documentation: Building interactive OpenAPI interfaces with Swagger',
            'Serverless functions vs Dedicated Servers: Host budget optimization',
            'Microservices Communication: Using RabbitMQ for decoupled operations',
            'Next.js Server Actions: Streamlining forms without API endpoint setups',
            'Redis Pub Sub: Real-time notification services in React apps',
            'Automating backups: Secure database mirroring on AWS S3 buckets',
            'System Monitoring: Setting up Prometheus and Grafana for server checks',
            'Configuring NGINX load balancers for fail-safe application routing',
            'Implementing CORS securely in multi-tenant Laravel SaaS systems',
            'Optimizing PageSpeed: Lazy loading strategies for multimedia files',
            'Using Docker Compose to set up isolated local dev environments',

            // IoT, Agritech, & Industry Specific (14)
            'IoT Gateways: Bridging remote sensors with cloud computing networks',
            'Smart Irrigation: How soil moisture sensors optimize agricultural yields',
            'LoRaWAN vs NB-IoT: Choosing the right network protocol for remote farms',
            'Agritech IoT deployment: Challenges of hardware longevity in open fields',
            'Real-Time Telemetry: Processing thousands of sensor metrics in Laravel',
            'Edge AI: Implementing lightweight machine learning models on IoT devices',
            'Smart Greenhouse automation: Remote climate control frameworks',
            'Predictive Maintenance: IoT sensors tracking industrial factory health',
            'Building custom Agritech dashboards: Integrating GIS mapping services',
            'IoT Security: Encrypting payload packets from device gateway to server',
            'Farming in the Cloud: How SaaS tools are modernizing traditional crop management',
            'Drone analytics: Processing crop health maps using spatial databases',
            'IoT data visualization: Creating real-time canvas graphs in Next.js',
            'Agritech ROI: Pitching IoT smart farming solutions to enterprise cooperatives'
        ];

        // 5b. (Skipped 94 draft placeholders to ensure 100% long-form practitioner articles on the website)

        // 6. Triple Core Services Seeding (ONLY Product Management, Digital Marketing, Business Consulting)
        $servicesData = [
            'Product Management' => [
                'target',
                'SaaS product strategy, user story mapping, backlog prioritization (RICE/Kano), and high-velocity product execution.',
                '# Product Management Services

Comprehensive product leadership for SaaS startups and global tech enterprises. We run product discovery workshops, establish RICE backlog scoring models, design user-centric roadmaps, and align engineering squads to ship high-impact features fast.

### Core Capabilities:
- **Product Discovery & PMF Audits**: Identify retention leaks, analyze user cohorts, and optimize product activation metrics.
- **RICE Backlog Prioritization**: Eliminate feature bloat and align engineering deliverables with business goals.
- **User-Centric Roadmapping**: Bridge executive strategy and software sprint planning for fast release cycles.',
            ],
            'Digital Marketing' => [
                'trending-up',
                'Growth digital marketing, performance funnels, and Answer Engine Optimization (AEO/GEO) for Google, ChatGPT & Perplexity.',
                '# Growth Digital Marketing & AEO Services

Full-funnel digital marketing strategies that turn cold traffic into sales briefings. We optimize search footprints for traditional Google SERPs and next-gen AI search surfaces (ChatGPT, Perplexity, Google AI Overviews) using QAE formatting and JSON-LD schema.

### Core Capabilities:
- **Answer Engine Optimization (AEO & GEO)**: Structure entity graphs and QAE content blocks so LLMs cite your brand as the leading authority.
- **High-Converting Performance Funnels**: Design multi-touch B2B lead acquisition pipelines and optimize Customer Acquisition Cost (CAC).
- **Search Engine Optimization (SEO)**: Code-level technical audits, site speed enhancements, and international domain strategy.',
            ],
            'Business Consulting' => [
                'briefcase',
                'Enterprise digital transformation, decoupled web architecture advisory, and scaling offshore engineering teams from Nepal.',
                '# Enterprise Business Consulting Services

Strategic advisory helping global companies eliminate technical debt, modernize legacy systems using Next.js 15 + Laravel 12 REST API gateways, and scale high-performance offshore engineering squads from Nepal.

### Core Capabilities:
- **Enterprise Digital Transformation**: Migrate legacy monoliths to decoupled microservices using the Strangler Fig pattern.
- **Offshore Engineering Team Scaling**: Source, train, and manage dedicated development squads in Nepal with US/EU standards.
- **Operational & Tech Stack Audits**: Evaluate database performance, security compliance, and system release velocity.',
            ],
        ];

        $serviceOrder = 1;
        foreach ($servicesData as $title => $details) {
            $svc = Service::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $details[1],
                'content' => $details[2],
                'icon' => $details[0],
                'is_featured' => true,
                'is_active' => true,
                'order' => $serviceOrder++,
            ]);

            $svc->seo()->create([
                'meta_title' => "$title Services | Peshal Bhattarai",
                'meta_description' => $details[1],
                'keywords' => strtolower("$title, product manager, digital marketer, business consultant, peshal bhattarai"),
                'canonical_url' => 'https://peshalbhattarai.com/services/' . Str::slug($title),
            ]);
        }

        // 7. Core Companies / Ventures Seeding
        $companiesData = [
            [
                'name' => 'Digital Terai',
                'description' => 'A premier Growth Digital Marketing & Search Growth Agency in Nepal, driving lead acquisition through organic search, performance funnels, and content density engines.',
                'content' => 'Digital Terai is a leading data-driven digital marketing agency specializing in scaling organic search engine rankings, performance advertising, and automated lead-nurturing pipelines for global and regional enterprises.',
                'website_url' => 'https://digitalterai.com',
                'services' => ['Growth Digital Marketing', 'SEO', 'AEO Optimization', 'Performance Funnels', 'Content Strategy'],
                'locations' => ['Nepal', 'Global'],
                'logo' => '/assets/images/companies/digitalterai.png',
                'story' => "Digital Terai was established to engineer conversion-optimized marketing funnels that drive measurable revenue growth rather than vanity metrics.",
                'mission' => "To build predictable customer acquisition engines through search marketing, structured content, and automated lead nurturing.",
                'technologies' => ["Google Analytics 4", "Meta Ads Manager", "SEMRush", "HubSpot CRM", "Next.js 15"],
                'industries' => ["B2B SaaS", "E-commerce", "Real Estate", "Enterprise Services"],
                'faqs' => [
                    ["q" => "How do you track campaign return on investment?", "a" => "We configure multi-touch attribution inside GA4 and tie customer conversion data back to specific campaigns, measuring CAC and LTV."],
                    ["q" => "What is Answer Engine Optimization (AEO)?", "a" => "AEO structures your content with QAE formatting and JSON-LD schema so AI search engines like ChatGPT and Perplexity cite your brand as an authoritative source."]
                ],
                'related_services' => [
                    ["name" => "Growth Digital Marketing Services", "slug" => "growth-digital-marketing-and-performance-funnels"],
                    ["name" => "AEO & GEO Optimization", "slug" => "aeo-and-geo-optimization-chatgpt-perplexity-and-google-ai"]
                ]
            ],
            [
                'name' => 'IntechNexus',
                'description' => 'A global technology partner providing Remote Engineering Team as a Service, SaaS product development, AI integration, and Agile coaching.',
                'content' => 'IntechNexus connects high-growth technology companies in the USA, Australia, and Switzerland with dedicated, pre-vetted remote software engineering squads led by senior Product Managers and Architects.',
                'website_url' => 'https://intechnexus.com',
                'services' => ['Remote Engineering Teams', 'Product Management', 'Laravel 12 API Development', 'Next.js 15 App Router', 'Agile Coaching'],
                'locations' => ['USA', 'Australia', 'Switzerland', 'Nepal'],
                'logo' => '/assets/images/companies/intechnexus.png',
                'story' => "IntechNexus addresses the global engineering talent deficit by sourcing, training, and managing top-tier software engineers skilled in modern decoupled web stacks.",
                'mission' => "To accelerate software product delivery for startups and enterprises through dedicated, high-velocity engineering squads.",
                'technologies' => ["Laravel 12", "Next.js 15", "Docker Containers", "Redis", "Amazon Web Services (AWS)"],
                'industries' => ["Enterprise SaaS Platforms", "Fintech Core Systems", "Digital Health"],
                'faqs' => [
                    ["q" => "How do you evaluate engineers?", "a" => "Candidates complete strict algorithmic coding tests, architectural system design challenges, and live pair-programming sessions."],
                    ["q" => "Who manages product sprint deliverables?", "a" => "Our dedicated squads include a certified Product Manager & Scrum Lead who aligns sprint backlogs and delivers weekly progress telemetry."]
                ],
                'related_services' => [
                    ["name" => "Offshore Engineering Team Scaling", "slug" => "offshore-engineering-team-scaling-and-global-advisory"],
                    ["name" => "Fractional Product Management", "slug" => "fractional-product-management-and-saas-strategy"]
                ]
            ],
            [
                'name' => 'BeinSEO',
                'description' => 'An International SEO & AEO Consultancy based in Dubai, UAE, helping global brands rank on Google and AI search engines.',
                'content' => 'BeinSEO conducts code-level technical audits, executes international multi-lingual search strategies, and builds structured entity graphs for enterprise brands operating across EMEA and Global markets.',
                'website_url' => 'https://beinseo.ae',
                'services' => ['International SEO', 'AEO Optimization', 'Technical SEO Audits', 'Entity Schema Architecture'],
                'locations' => ['Dubai, UAE', 'Global'],
                'logo' => '/assets/images/companies/beinseo.png',
                'story' => "BeinSEO was established in Dubai to solve multi-lingual search ranking and AI citation challenges for enterprise international brands.",
                'mission' => "To eliminate code-level search indexation barriers and position enterprise brands as global answer authorities.",
                'technologies' => ["Cloudflare Workers", "Hreflang Config", "Screaming Frog", "JSON-LD Schemas", "Next.js 15"],
                'industries' => ["Logistics", "E-commerce Networks", "Enterprise Tech"],
                'faqs' => [
                    ["q" => "What is Hreflang tag configuration?", "a" => "It instructs search engines which regional URL to serve based on user language and location, eliminating duplicate content penalties."],
                    ["q" => "How does AEO differ from classic SEO?", "a" => "Classic SEO optimizes for SERP link clicks; AEO optimizes for direct answer extraction by AI models like ChatGPT and Perplexity."]
                ],
                'related_services' => [
                    ["name" => "AEO & GEO Optimization", "slug" => "aeo-and-geo-optimization-chatgpt-perplexity-and-google-ai"]
                ]
            ],
            [
                'name' => 'Thoplo Machine',
                'description' => 'An innovative IoT Agritech & Smart Automation venture deploying IoT sensors, remote monitoring telemetry, and automated cloud systems.',
                'content' => 'Thoplo Machine merges hardware engineering with cloud computing, deploying low-power LoRaWAN and NB-IoT soil sensors and microclimate trackers integrated with a central Laravel platform.',
                'website_url' => 'https://thoplomachine.com',
                'services' => ['IoT Systems', 'Agritech Automation', 'Cloud Telemetry', 'AI Ready Sensors'],
                'locations' => ['Nepal', 'South Asia'],
                'logo' => '/assets/images/companies/thoplomachine.png',
                'story' => "Thoplo Machine designs long-range IoT monitoring nodes that transmit real-time telemetry back to an autonomous cloud orchestration engine.",
                'mission' => "To pioneer resource-efficient automation through smart LPWAN hardware and cloud infrastructure.",
                'technologies' => ["LoRaWAN Gateway", "NB-IoT Sensors", "MQTT Brokers", "Laravel Queues", "Redis Caching"],
                'industries' => ["Agritech", "Precision Automation", "Environmental Monitoring"],
                'faqs' => [
                    ["q" => "What communication protocols do your sensors use?", "a" => "We utilize LoRaWAN for private long-range networks and NB-IoT for cellular connections."],
                    ["q" => "Is the telemetry platform real-time?", "a" => "Yes, telemetry packets are ingested asynchronously via MQTT brokers and updated live on Next.js dashboards."]
                ],
                'related_services' => [
                    ["name" => "Enterprise Digital Transformation", "slug" => "enterprise-digital-transformation-and-decoupled-architecture"]
                ]
            ]
        ];

        $companyOrder = 1;
        foreach ($companiesData as $cData) {
            $comp = Company::create([
                'name' => $cData['name'],
                'slug' => Str::slug($cData['name']),
                'logo' => $cData['logo'],
                'description' => $cData['description'],
                'content' => $cData['content'],
                'website_url' => $cData['website_url'],
                'services' => $cData['services'],
                'locations' => $cData['locations'],
                'is_active' => true,
                'order' => $companyOrder++,
                'story' => $cData['story'] ?? null,
                'mission' => $cData['mission'] ?? null,
                'technologies' => $cData['technologies'] ?? null,
                'industries' => $cData['industries'] ?? null,
                'faqs' => $cData['faqs'] ?? null,
                'related_services' => $cData['related_services'] ?? null,
            ]);

            $comp->seo()->create([
                'meta_title' => "About " . $cData['name'] . " | Portfolio Venture of Peshal Bhattarai",
                'meta_description' => $cData['description'],
                'keywords' => strtolower($cData['name']) . ", venture, startup, peshal bhattarai",
                'canonical_url' => 'https://peshalbhattarai.com/companies/' . Str::slug($cData['name']),
            ]);
        }

        // 8. Testimonials Seeding (5 Targeted Executive Reviews)
        $testimonialsData = [
            [
                'name' => 'John Miller',
                'company' => 'HealthSaaS Inc.',
                'position' => 'Chief Technology Officer (USA)',
                'review' => 'Peshal served as our Fractional Product Manager and System Architect, leading the complete decoupling of our legacy monolith into Next.js 15 and Laravel 12. His sprint discipline doubled our deployment velocity while keeping our infrastructure 100% HIPAA compliant.',
                'rating' => 5,
                'country' => 'USA',
                'video_url' => null,
                'is_featured' => true,
                'client_image' => '/assets/images/testimonials/client1.jpg'
            ],
            [
                'name' => 'Saeed Al-Maktoum',
                'company' => 'Dubai Logistics Hub',
                'position' => 'Head of Growth Marketing (UAE)',
                'review' => 'Peshal’s AEO and Growth Marketing strategy transformed our search footprint. Within 4 months, our B2B SaaS platform was cited in top 3 answers on ChatGPT and Perplexity, resulting in a 215% spike in organic enterprise lead inquiries.',
                'rating' => 5,
                'country' => 'UAE',
                'video_url' => null,
                'is_featured' => true,
                'client_image' => '/assets/images/testimonials/client2.jpg'
            ],
            [
                'name' => 'Markus Zbinden',
                'company' => 'SwissTech Solutions',
                'position' => 'VP of Engineering (Switzerland)',
                'review' => 'As our Business Consultant and Agile Lead, Peshal helped set up a dedicated remote development squad in Nepal. The team delivers top-tier code quality with round-the-clock agility, cutting our operational overhead by over 50%.',
                'rating' => 5,
                'country' => 'Switzerland',
                'video_url' => null,
                'is_featured' => true,
                'client_image' => '/assets/images/testimonials/client5.jpg'
            ],
            [
                'name' => 'Sarah Jenkins',
                'company' => 'EduQuest Online',
                'position' => 'VP of Product (Australia)',
                'review' => 'Peshal ran a thorough SaaS Product Roadmap and PMF Audit for our learning portal. His RICE scoring framework eliminated feature bloat and improved our 30-day user retention rate by 38%. Highly recommended Product Leader.',
                'rating' => 5,
                'country' => 'Australia',
                'video_url' => null,
                'is_featured' => true,
                'client_image' => '/assets/images/testimonials/client4.jpg'
            ],
            [
                'name' => 'Ram Shrestha',
                'company' => 'GreenValley Agri-Coop',
                'position' => 'Managing Director (Nepal)',
                'review' => 'Peshal’s digital transformation roadmap and Thoplo Machine IoT integration saved our agricultural greenhouses over 40% in water consumption and streamlined automated field monitoring. World-class technical leadership.',
                'rating' => 5,
                'country' => 'Nepal',
                'video_url' => null,
                'is_featured' => true,
                'client_image' => '/assets/images/testimonials/client3.jpg'
            ]
        ];

        foreach ($testimonialsData as $tData) {
            Testimonial::create([
                'client_name' => $tData['name'],
                'company_name' => $tData['company'],
                'position' => $tData['position'],
                'review' => $tData['review'],
                'rating' => $tData['rating'],
                'country' => $tData['country'],
                'video_url' => $tData['video_url'],
                'is_featured' => $tData['is_featured'],
                'client_image' => $tData['client_image'],
            ]);
        }

        // 9. Flagship Portfolio Projects & Case Studies (3 Focused Case Studies)
        $portfolioData = [
            [
                'title' => 'Enterprise SaaS Product Re-Architecture & Agile Roadmap Execution',
                'client' => 'Global HealthSaaS Inc.',
                'summary' => 'Product Management and System Architecture for a high-frequency clinical scheduling platform, migrating legacy PHP monolith to decoupled Next.js 15 + Laravel 12 API.',
                'technologies' => ['Product Management', 'Laravel 12', 'Next.js 15 App Router', 'Agile Roadmap', 'Redis'],
                'business_outcomes' => [
                    '240% increase in sprint release velocity',
                    '3.4x faster user feature adoption',
                    'Zero downtime legacy decoupling'
                ],
                'results_summary' => 'Delivered a decoupled portal that processes over 50,000 requests per minute with sub-50ms API response time.',
                'website_url' => 'https://healthsaas.example.com',
                'problem' => 'The client suffered from tight database coupling, slow releases, and feature bloat that threatened enterprise deal closures.',
                'solution' => 'Peshal stepped in as Fractional Product Manager and Architect. He defined a clear Product Backlog using RICE prioritization and applied the Strangler Fig pattern to decouple UI views into Next.js 15 Server Components while exposing Laravel 12 REST endpoints.',
                'approach' => 'Established 2-week agile sprint cycles with continuous integration, automated testing pipelines, and atomic Redis locks to prevent concurrent booking conflicts.',
                'duration' => '6 Months',
                'challenges' => 'Preventing double-booking race conditions during peak hours, resolved via distributed Redis mutex locks.',
                'results' => 'Achieved full HIPAA compliance, accelerated feature delivery by 240%, and enabled the company to secure $1.5M in ARR.',
                'roi' => 250.00
            ],
            [
                'title' => 'Global AEO & Generative Engine Growth Marketing Campaign',
                'client' => 'B2B Tech SaaS & Dubai Logistics',
                'summary' => 'Answer Engine Optimization (AEO) and performance marketing campaign designed to dominate AI search engine answers on ChatGPT, Perplexity, and Google AI Overviews.',
                'technologies' => ['Growth Marketing', 'AEO Optimization', 'Next.js 15', 'JSON-LD Schema', 'Content Density'],
                'business_outcomes' => [
                    'Cited in top 3 AI answers on ChatGPT & Perplexity',
                    '215% increase in organic B2B lead inquiries',
                    '100/100 Core Web Vitals score'
                ],
                'results_summary' => 'Positioned the client as the #1 cited authority across AI search platforms for enterprise logistics queries.',
                'website_url' => 'https://logistics.example.com',
                'problem' => 'Traditional SEO campaigns were yielding diminishing returns as buyers shifted search habits to conversational AI assistants like ChatGPT and Perplexity.',
                'solution' => 'Peshal engineered an AEO & Growth Marketing flywheel. Content was restructured using QAE answer-first blocks, entity schema markup, and high-density information gain elements.',
                'approach' => 'Audited top 10 SERP results, identified content consensus gaps, and implemented dynamic OpenGraph and JSON-LD schema layers on Next.js 15.',
                'duration' => '4 Months',
                'challenges' => 'Tracking AI citation visibility across multiple LLM surfaces, resolved using multi-platform search telemetry tools.',
                'results' => 'Organic B2B lead conversions jumped 215% with zero extra ad spend, establishing long-term AI search dominance.',
                'roi' => 310.00
            ],
            [
                'title' => 'Offshore Engineering Team Scaling & Digital Transformation from Nepal',
                'client' => 'SwissTech Solutions & IntechNexus',
                'summary' => 'Business consulting and staff augmentation advisory setup, establishing dedicated remote engineering squads in Nepal for European tech enterprises.',
                'technologies' => ['Business Consulting', 'Remote Team Management', 'Scrum Coaching', 'Digital Transformation', 'Nepal Squad'],
                'business_outcomes' => [
                    '55% reduction in software development operating cost',
                    '99.9% uptime across production clusters',
                    '100% on-time sprint deliverables'
                ],
                'results_summary' => 'Built a 12-person dedicated engineering squad in Kathmandu providing 24/7 technical development for Swiss enterprise software.',
                'website_url' => 'https://swisstech.example.com',
                'problem' => 'The client faced severe local developer shortages in Zurich, inflating software R&D costs and delaying core product roadmap initiatives.',
                'solution' => 'Peshal structured an offshore engineering scaling plan from Nepal. He vetted, hired, and onboarded senior software engineers, implementing standardized Git workflows and Scrum ceremonies.',
                'approach' => 'Established asynchronous communication protocols, daily standups, code review checklists, and automated CI/CD pipelines.',
                'duration' => '8 Months',
                'challenges' => 'Bridging European compliance standards with remote team workflows, resolved via strict data security policies.',
                'results' => 'Cut R&D costs by 55% while doubling product feature release cadence.',
                'roi' => 210.00
            ]
        ];

        $pOrder = 1;
        foreach ($portfolioData as $pData) {
            $project = PortfolioProject::create([
                'title' => $pData['title'],
                'slug' => Str::slug($pData['title']),
                'client_name' => $pData['client'],
                'summary' => $pData['summary'],
                'content' => $pData['solution'],
                'main_image' => '/assets/images/portfolio/' . Str::slug($pData['title']) . '.jpg',
                'gallery' => [
                    '/assets/images/portfolio/' . Str::slug($pData['title']) . '-slide1.jpg',
                    '/assets/images/portfolio/' . Str::slug($pData['title']) . '-slide2.jpg',
                ],
                'technologies' => $pData['technologies'],
                'business_outcomes' => $pData['business_outcomes'],
                'results_summary' => $pData['results_summary'],
                'website_url' => $pData['website_url'],
                'is_featured' => true,
                'order' => $pOrder++,
            ]);

            $project->seo()->create([
                'meta_title' => $pData['title'] . " | Case Study",
                'meta_description' => $pData['summary'],
                'keywords' => implode(', ', array_merge($pData['technologies'], ['case study, product management, digital marketing, business consultant'])),
                'canonical_url' => 'https://peshalbhattarai.com/portfolio/' . Str::slug($pData['title']),
            ]);

            $cs = CaseStudy::create([
                'portfolio_project_id' => $project->id,
                'title' => 'Case Study: ' . $pData['title'],
                'slug' => 'case-study-' . Str::slug($pData['title']),
                'problem' => $pData['problem'],
                'solution' => $pData['solution'],
                'technology' => $pData['technologies'],
                'approach' => $pData['approach'],
                'timeline_duration' => $pData['duration'],
                'challenges' => $pData['challenges'],
                'results' => $pData['results'],
                'roi_percentage' => $pData['roi'],
                'order' => $project->order
            ]);

            $cs->seo()->create([
                'meta_title' => 'Case Study: ' . $pData['title'] . ' | Peshal Bhattarai',
                'meta_description' => $pData['summary'],
                'keywords' => 'case study, roi, product manager, digital marketer, business consultant, ' . implode(', ', $pData['technologies']),
                'canonical_url' => 'https://peshalbhattarai.com/case-studies/' . 'case-study-' . Str::slug($pData['title']),
            ]);
        }

        // 10. Structured QAE FAQs Seeding across Core Pillars
        $faqCategories = [
            'homepage' => 'Homepage FAQs',
            'product_management' => 'Product Management FAQs',
            'digital_marketing' => 'Digital Marketing FAQs',
            'business_consulting' => 'Business Consulting FAQs',
        ];

        foreach ($faqCategories as $key => $catTitle) {
            for ($i = 1; $i <= 10; $i++) {
                $question = "";
                $answer = "";
                
                switch ($key) {
                    case 'homepage':
                        $question = "Question $i: What services does Peshal Bhattarai offer as a Product Manager, Digital Marketer, and Business Consultant?";
                        $answer = "Answer $i: Peshal Bhattarai provides end-to-end tech leadership: Fractional Product Management (SaaS roadmaps, PMF audits), Growth Digital Marketing & AEO Optimization (ranking on Google, ChatGPT & Perplexity), and Enterprise Business Consulting (digital transformation and offshore engineering scaling from Nepal).";
                        break;
                    case 'product_management':
                        $question = "Question $i: How does a Fractional Product Manager accelerate SaaS roadmap execution?";
                        $answer = "Answer $i: A Fractional Product Manager establishes clear feature prioritization frameworks (RICE/Kano), structures sprint backlogs, conducts user discovery workshops, and aligns engineering teams to ship high-impact features without the cost of a full-time executive.";
                        break;
                    case 'digital_marketing':
                        $question = "Question $i: What is Answer Engine Optimization (AEO) and how does it drive B2B leads?";
                        $answer = "Answer $i: AEO optimizes your digital assets for AI search engines like ChatGPT, Perplexity, and Google AI Overviews using structured JSON-LD schemas and QAE answer-first formatting, ensuring your brand is cited as the primary answer.";
                        break;
                    case 'business_consulting':
                        $question = "Question $i: Why choose Nepal for offshore engineering team scaling and digital transformation?";
                        $answer = "Answer $i: Nepal offers world-class computer science engineering talent, high English fluency, competitive cost structures, and excellent time-zone overlap for round-the-clock development agility managed to US/EU operational standards.";
                        break;
                }

                Faq::create([
                    'question' => $question,
                    'answer' => $answer,
                    'category_key' => $key,
                    'page_slug' => $key === 'homepage' ? '/' : "/blog/category/$key",
                    'order' => $i
                ]);
            }
        }

        // 11. Team Members Seeding
        $teamMembers = [
            ['name' => 'Anil Sharma', 'designation' => 'Lead Software Architect - IntechNexus', 'avatar' => '/assets/images/team/anil.jpg', 'bio' => 'Expert Laravel & Next.js engineer specializing in decoupled REST API architectures.'],
            ['name' => 'Deepak Rayamajhi', 'designation' => 'Technical Director - Digital Terai', 'avatar' => '/assets/images/team/deepak.jpg', 'bio' => 'Data-driven growth marketer and search optimization lead.'],
            ['name' => 'Prabhat Bhattarai', 'designation' => 'Embedded Systems Lead - Thoplo Machine', 'avatar' => '/assets/images/team/prabhat.jpg', 'bio' => 'Hardware engineer specializing in IoT sensors and LPWAN telemetry networks.'],
        ];
        foreach ($teamMembers as $index => $member) {
            TeamMember::create([
                'name' => $member['name'],
                'designation' => $member['designation'],
                'avatar' => $member['avatar'],
                'bio' => $member['bio'],
                'social_links' => ['linkedin' => 'https://linkedin.com'],
                'order' => $index + 1
            ]);
        }

        // 12. Resources Seeding
        $resourcesData = [
            ['title' => 'The 2026 SaaS Product Management Playbook', 'slug' => 'saas-product-management-playbook', 'type' => 'Whitepaper', 'description' => 'A comprehensive guide to product discovery, RICE backlog scoring, and scaling SaaS retention metrics.'],
            ['title' => 'Generative Engine Optimization (GEO) & AEO Blueprint', 'slug' => 'geo-aeo-optimization-blueprint', 'type' => 'Guide', 'description' => 'Actionable techniques for structuring content and JSON-LD schema to rank on ChatGPT, Perplexity, and Google AI.'],
            ['title' => 'Enterprise Digital Transformation & Offshore Scaling Guide', 'slug' => 'enterprise-digital-transformation-guide', 'type' => 'Report', 'description' => 'Legacy system modernization using the Strangler Fig pattern and building dedicated engineering squads in Nepal.']
        ];
        foreach ($resourcesData as $res) {
            $r = Resource::create([
                'title' => $res['title'],
                'slug' => $res['slug'],
                'type' => $res['type'],
                'description' => $res['description'],
                'file_path' => '/assets/downloads/' . $res['slug'] . '.pdf',
                'cover_image' => '/assets/images/resources/' . $res['slug'] . '.jpg',
                'download_count' => rand(250, 650),
                'is_active' => true,
            ]);

            $r->seo()->create([
                'meta_title' => "Download " . $res['title'] . " | Resource Center",
                'meta_description' => $res['description'],
                'keywords' => "download, resource, whitepaper, product manager, digital marketer, business consultant, " . strtolower($res['type']),
                'canonical_url' => 'https://peshalbhattarai.com/resources/' . $res['slug'],
            ]);
        }

        // 13. Events Seeding
        Event::create([
            'title' => 'Keynote: Scaling SaaS Products & AEO Search Dominance from Emerging Markets',
            'slug' => 'keynote-saas-aeo-scaling',
            'type' => 'Speaking',
            'description' => 'Speaking about fractional product management, answer engine optimization, and building global tech teams from Nepal.',
            'event_date' => Carbon::now()->addMonths(2)->toDateString(),
            'location' => 'Dubai World Trade Centre & Virtual',
            'link' => 'https://example.com/summit',
            'is_speaking' => true
        ]);

        // 14. Certifications Seeding
        $certifications = [
            [
                'title' => 'Certified Product Manager & Scrum Professional (CSP)',
                'organization' => 'Scrum Alliance',
                'issue_date' => '2021-10-15',
                'credential_id' => 'CSP-887162',
                'credential_url' => 'https://scrumalliance.org',
            ],
            [
                'title' => 'ICAgile Certified Professional in Agile Product Leadership',
                'organization' => 'ICAgile',
                'issue_date' => '2018-07-01',
                'credential_id' => '199-10171-a12997a0-cd34-4eb5-8428-439a6cbfea4c',
                'credential_url' => 'https://icagile.com/member/199-10171',
            ],
            [
                'title' => 'Advanced Research Methodology & Systems Engineering',
                'organization' => 'Kathmandu University (KU)',
                'issue_date' => '2015-06-01',
                'credential_id' => 'KU-RM-2015',
                'credential_url' => 'https://ku.edu.np',
            ]
        ];
        foreach ($certifications as $cert) {
            Certification::create([
                'title' => $cert['title'],
                'organization' => $cert['organization'],
                'issue_date' => $cert['issue_date'],
                'credential_id' => $cert['credential_id'],
                'credential_url' => $cert['credential_url'],
            ]);
        }

        // 15. Work Experiences Seeding
        \App\Models\WorkExperience::create([
            'company_name' => 'IntechNexus',
            'logo' => '/assets/images/companies/intechnexus.png',
            'role' => 'Senior Product Manager & Business Consultant',
            'location' => 'California, United States (Remote)',
            'type' => 'Contract',
            'duration_text' => 'May 2026 - Present',
            'start_date' => '2026-05-01',
            'description' => "• Lead SaaS product strategy, user story mapping, and feature backlogs for global clients.\n• Scale remote software engineering squads from Nepal following strict Scrum/Agile standards.\n• Oversee decoupled web architecture migrations (Next.js 15 App Router + Laravel 12 API).\n• Drive customer-centric product roadmaps based on analytics data and user feedback.",
            'skills' => ['Product Strategy', 'SaaS Management', 'Agile Coaching', 'Decoupled Architecture'],
            'order' => 1
        ]);

        \App\Models\WorkExperience::create([
            'company_name' => 'Digital Terai & BeinSEO',
            'logo' => '/assets/images/companies/digitalterai.png',
            'role' => 'Co-Founder & Growth Digital Marketer',
            'location' => 'Kathmandu, NP & Dubai, UAE',
            'type' => 'Full-time',
            'duration_text' => 'Mar 2019 - Present',
            'start_date' => '2019-03-01',
            'description' => "• Architect Answer Engine Optimization (AEO/GEO) strategies for global B2B tech brands.\n• Lead performance marketing campaigns, conversion funnel design, and SEO audits.\n• Manage client acquisition pipelines and digital agency operations.",
            'skills' => ['Growth Marketing', 'AEO/GEO', 'Search Engine Optimization', 'B2B Lead Funnels'],
            'order' => 2
        ]);

        // 16. Education Records Seeding
        \App\Models\EducationRecord::create([
            'institution_name' => 'Kathmandu University (KU)',
            'logo' => '/assets/images/education/ku.png',
            'degree' => "Master's Degree",
            'study_field' => 'Computer Engineering',
            'duration_text' => '2014 – 2016',
            'start_year' => 2014,
            'end_year' => 2016,
            'description' => 'Specialization in Computer Science, distributed systems, research methodologies, and algorithm optimizations.'
        ]);

        \App\Models\EducationRecord::create([
            'institution_name' => 'Visvesvaraya Technological University',
            'logo' => '/assets/images/education/vtu.png',
            'degree' => "Engineer's Degree",
            'study_field' => 'Computer Science',
            'grade' => '7.74',
            'duration_text' => '2010 – 2014',
            'start_year' => 2010,
            'end_year' => 2014,
            'description' => 'Comprehensive background in software engineering, data structures, and computing algorithms.'
        ]);

        // 17. Seed SEO Metadata for Static Core Pages
        $pages = [
            '/' => ['Peshal Bhattarai — Senior Product Manager, Growth Marketer & Business Consultant', 'Senior Product Manager, Growth Digital Marketer, and Business Consultant operating globally from Nepal. Specialized in SaaS product strategy, AEO/SEO search dominance, and enterprise digital transformation.'],
            '/about' => ['About Peshal Bhattarai | Executive Profile & Career Timeline', 'Discover Peshal Bhattarai\'s career journey as Product Manager, Digital Marketer, and Business Consultant, along with methodologies, leadership accomplishments, and academic certifications.'],
            '/services' => ['Strategic Services | Product Management, Growth Marketing & Business Consulting', 'Explore Fractional Product Management, AEO & Growth Marketing, and Enterprise Digital Transformation services offered by Peshal Bhattarai.'],
            '/companies' => ['Venture Portfolio | Digital Terai, IntechNexus, BeinSEO & Thoplo Machine', 'Learn about Digital Terai, IntechNexus, BeinSEO, and Thoplo Machine, built and scaled under Peshal Bhattarai\'s executive leadership.'],
            '/portfolio' => ['Portfolio & Case Studies | Product, Growth Marketing & Consulting Outcomes', 'View recent SaaS product re-architectures, AEO search campaigns, and digital transformation case studies with documented business ROI.'],
            '/blog' => ['Insights & Strategy Blog | Peshal Bhattarai', 'Read professional guides on SaaS Product Management, Answer Engine Optimization (AEO), Next.js 15, Laravel 12, and offshore engineering team scaling.'],
            '/contact' => ['Book a Strategic Briefing | Peshal Bhattarai', 'Schedule an executive briefing or business consultation with Peshal Bhattarai for Product Management, Growth Marketing, or Digital Transformation projects.']
        ];

        foreach ($pages as $slug => $meta) {
            SeoMetadata::create([
                'model_type' => 'Page',
                'model_id' => 0,
                'meta_title' => $meta[0],
                'meta_description' => $meta[1],
                'keywords' => 'peshal bhattarai, product manager, digital marketer, business consultant, aeo optimization, saas roadmap, nepal tech leadership',
                'canonical_url' => 'https://peshalbhattarai.com' . ($slug === '/' ? '' : $slug),
                'og_title' => $meta[0],
                'og_description' => $meta[1],
                'og_image' => '/assets/images/peshal-og-home.jpg',
            ]);
        }

        // Call modular seeders
        $this->call([
            HomepageFaqsSeeder::class,
            PriorityBlogsSeeder::class,
            FastTrackBlogsSeeder::class,
            PillarsAndClustersSeeder::class,
            PublishNewMasterBlogsSeeder::class,
            PublishBatch2MasterBlogsSeeder::class,
            PublishBatch3MasterBlogsSeeder::class,
        ]);
    }
}
