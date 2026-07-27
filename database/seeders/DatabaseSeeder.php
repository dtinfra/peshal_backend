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
        $author = BlogAuthor::create([
            'name' => 'Peshal Bhattarai',
            'slug' => 'peshal-bhattarai',
            'avatar' => '/assets/images/peshal1.jpg', // Using real uploaded image
            'bio' => 'Senior Technology Leader, Business Consultant, Agile Coach, and Entrepreneur with over 10 years of experience driving digital transformation and growth strategies for global enterprises.',
            'designation' => 'Principal Consultant & Venture Builder',
            'email' => 'peshal@intechnexus.com',
            'social_links' => [
                'linkedin' => 'https://linkedin.com/in/peshal-bhattarai',
                'twitter' => 'https://twitter.com/peshalb',
                'github' => 'https://github.com/peshalb',
                'medium' => 'https://medium.com/@peshalb'
            ]
        ]);

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

        // Seed the other 94 blog posts as drafts/metadata records
        foreach ($moreBlogTitles as $index => $title) {
            $catName = 'Agile';
            if ($index >= 20 && $index < 40) $catName = 'Business';
            if ($index >= 40 && $index < 60) $catName = 'SEO';
            if ($index >= 60 && $index < 80) $catName = 'Software Development';
            if ($index >= 80) $catName = 'IoT';

            $cat = $categories[$catName] ?? $categories['Agile'];
            $draftBlog = Blog::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'summary' => "Expert thoughts on '$title'. Read the roadmap, best practices, and integration strategies.",
                'content' => "# $title\n\nFull article coming soon. This content is managed through the Laravel Admin Panel.",
                'featured_image' => '/assets/images/blogs/placeholder.jpg',
                'reading_time' => 5,
                'author_id' => $author->id,
                'category_id' => $cat->id,
                'is_published' => false,
                'published_at' => null,
            ]);

            // Add draft SEO Metadata
            $draftBlog->seo()->create([
                'meta_title' => "$title | Peshal Bhattarai",
                'meta_description' => "Insights on $title by Technology & Business Consultant Peshal Bhattarai.",
                'keywords' => strtolower("$catName, consulting, peshal bhattarai"),
                'canonical_url' => 'https://peshalbhattarai.com/blog/' . Str::slug($title),
            ]);
        }

        // 6. Services Seeding (21 services)
        $servicesData = [
            'Business Consulting' => ['briefcase', 'Strategic growth maps, market penetration analysis, and corporate restructuring plans.', 'High-level advisory that helps corporations find operational efficiencies, design scaling frameworks, and execute market research. We build structures that support double-digit growth.'],
            'Technology Consulting' => ['cpu', 'Enterprise systems evaluation, software stack recommendations, and architecture blueprints.', 'Expert software architecture design, technology choices, feasibility analysis, and database audit services. We select robust, future-proof tech stacks that support enterprise workloads.'],
            'Digital Transformation' => ['refresh-cw', 'Legacy system modernization, process automation, and culture-first digital shifts.', 'Step-by-step guidance for transitioning manual enterprises into streamlined, cloud-native digital ecosystems. We automate bottlenecks and modernize databases with zero operational downtime.'],
            'Project Management' => ['trello', 'On-time delivery, risk mitigation frameworks, and budget control pipelines.', 'Professional management of complex software and technology projects. We coordinate multi-team milestones, mitigate integration risks, and ensure transparent progress reporting.'],
            'Product Management' => ['target', 'Product roadmaps, feature prioritization matrix, and MVP user validation loops.', 'Helping founders translate ideas into product requirements. We run product discovery workshops, structure product backlogs, design wireframes, and run user testing events.'],
            'Agile Coaching' => ['users', 'Transforming rigid corporations into highly collaborative, agile-driven squads.', 'Organizational coaching on agile principles, establishing cross-functional team structures, running system syncs, and establishing continuous improvement cultures.'],
            'Scrum Implementation' => ['refresh-ccw', 'Setting up daily syncs, sprint planning, refinement, and retro frameworks.', 'Establishing pure Scrum processes. We train Scrum Masters and Product Owners, refine backlogs, align sprint deliverables, and track velocity reports.'],
            'Digital Marketing' => ['trending-up', 'Performance campaigns, social branding, and data-driven customer acquisition.', 'Multi-channel digital marketing campaigns that drive revenue. We manage paid ads, create social media authority pipelines, and design high-converting lead funnels.'],
            'SEO Consulting' => ['search', 'International SEO, technical audits, and organic search growth strategies.', 'Enterprise-grade SEO. We design domain structures, execute code-level technical audits, manage site speed optimizations, and build high-authority backlink networks.'],
            'Website Development' => ['code', 'Fast, secure, responsive corporate platforms built with Laravel and React.', 'High-converting custom web applications, API-driven portals, and landing pages designed with responsive, glassmorphic UI elements and fast load times.'],
            'Software Development' => ['terminal', 'Enterprise grade API backends, relational databases, and decoupled code.', 'Custom software development adhering to SOLID principles, clean code patterns, repository services architecture, and automated testing setups.'],
            'Mobile Apps' => ['smartphone', 'Cross-platform mobile apps for iOS and Android built on React Native.', 'High-performance mobile applications with offline storage capabilities, push notifications, and integrations with payment gateways and local services.'],
            'Enterprise Software' => ['database', 'Custom ERP systems, internal management tools, and secure ledger ledgers.', 'Robust web systems built to run internal business procedures. We build user hierarchies, audit logs, complex data models, and enterprise API integrations.'],
            'Dedicated Team' => ['user-check', 'Remote team as a service, software developers, QA, and project managers.', 'Staff augmentation for technology startups and enterprise software groups. We source, train, and manage dedicated remote development cells.'],
            'Remote Development' => ['globe', 'Setting up remote-first workflows, collaboration tools, and pipelines.', 'Advisory on building, scaling, and managing distributed development groups. We optimize tools, code sharing standards, and async communication.'],
            'CTO as a Service' => ['shield', 'Fractional CTO support, fundraising technical pitches, and team building.', 'Part-time technical leadership for startups and small-to-medium businesses. We guide architectural choices, run code audits, and mentor development teams.'],
            'Startup Consulting' => ['zap', 'Venture validation, pricing models, fundraising prep, and MVP roadmaps.', 'Helping founders launch fast. We outline key features, build minimal viable products, negotiate contracts, and validate SaaS business models.'],
            'Product Strategy' => ['compass', 'Competitor benchmarking, monetization plans, and feature scaling maps.', 'Designing maps that guide product lifecycles. We build product feature priority scores and map retention workflows.'],
            'Technology Audit' => ['activity', 'Security audits, code review, performance diagnostics, and system testing.', 'Comprehensive evaluation of code health, server configurations, database query optimization, security vulnerability scans, and performance analysis.'],
            'Cloud Consulting' => ['cloud', 'AWS setups, container orchestration, hybrid clouds, and infrastructure coding.', 'Migrating legacy servers to AWS and Azure. We set up container systems using Docker, establish Redis clusters, and configure Cloudflare security walls.'],
            'AI Readiness Consulting' => ['brain', 'Assessing data assets, designing AI proof of concepts, and LLM setup.', 'Evaluating corporate readiness for AI integration. We build pipeline plans for training data, set up OpenAI API proxies, and automate document checking.']
        ];

        $serviceOrder = 1;
        foreach ($servicesData as $title => $details) {
            $svc = Service::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $details[1],
                'content' => $details[2],
                'icon' => $details[0],
                'is_featured' => in_array($title, ['Business Consulting', 'Technology Consulting', 'Digital Transformation', 'SEO Consulting', 'CTO as a Service', 'Agile Coaching']),
                'is_active' => true,
                'order' => $serviceOrder++,
            ]);

            $svc->seo()->create([
                'meta_title' => "$title Services | Peshal Bhattarai",
                'meta_description' => $details[1],
                'keywords' => strtolower("$title, consulting, technology, peshal bhattarai"),
                'canonical_url' => 'https://peshalbhattarai.com/services/' . Str::slug($title),
            ]);
        }

        // 7. Companies / Ventures Seeding (4 companies)
        $companiesData = [
            [
                'name' => 'Digital Terai',
                'description' => 'A premier full-service Digital Marketing Agency based in Nepal, helping companies grow brand authority and acquire leads through organic and performance marketing.',
                'content' => 'Digital Terai is a leading data-driven digital marketing agency that specializes in helping brands scale their organic search engine rankings, run high-converting social media marketing campaigns, and automate lead-nurturing pipelines. Under Peshal\'s leadership, the company has scaled to serve prominent clients in healthcare, education, retail, and real estate, consistently achieving triple-digit growth in search traffic.',
                'website_url' => 'https://digitalterai.com',
                'services' => ['SEO', 'Performance Marketing', 'Social Media', 'Branding', 'Website Development', 'Content Marketing', 'Lead Generation', 'Marketing Automation', 'Analytics'],
                'locations' => ['Nepal'],
                'logo' => '/assets/images/companies/digitalterai.png',
                'story' => "Digital Terai was founded with a clear directive: to move past basic digital advertising metrics and build conversion-optimized marketing funnels that drive real business growth. Under Peshal Bhattarai's operational leadership, the agency has scaled to support market leaders in healthcare, real estate, and retail, utilizing data-driven analysis to maximize customer lifetime value.",
                'mission' => "To engineer predictable customer acquisition funnels using search marketing, structured content, and automated lead nurturing systems.",
                'technologies' => ["Google Analytics 4", "Meta Ads Manager", "SEMRush", "HubSpot CRM", "Next.js", "TailwindCSS"],
                'industries' => ["Real Estate", "Healthcare", "E-commerce", "Corporate Education", "Retail"],
                'faqs' => [
                    ["q" => "How do you track campaign return on investment?", "a" => "We configure multi-touch attribution inside GA4 and tie customer conversion data back to specific campaigns, measuring Customer Acquisition Cost (CAC) and Lifetime Value (LTV)."],
                    ["q" => "Do you build the websites you optimize?", "a" => "Yes, our team constructs lightweight, SEO-friendly frontends using modern frameworks to guarantee 90+ Core Web Vital scores."]
                ],
                'related_services' => [
                    ["name" => "Search Engine Optimization (SEO)", "slug" => "seo-auditing-and-ranking-strategies"],
                    ["name" => "Content Funnel Design", "slug" => "conversion-funnel-engineering"]
                ]
            ],
            [
                'name' => 'Thoplo Machine',
                'description' => 'An innovative IoT Agritech company deploying smart farming sensors, remote crop monitoring systems, and automation technologies in remote fields.',
                'content' => 'Thoplo Machine is at the forefront of agricultural innovation, merging hardware engineering with cloud computing. The company manufactures low-power LoRaWAN and NB-IoT soil sensors, autonomous water flow valves, and microclimate trackers. These devices feed telemetry into a central Laravel platform that triggers automated drip irrigation systems based on real-time soil conditions, significantly reducing resource consumption.',
                'website_url' => 'https://thoplomachine.com',
                'services' => ['Agritech', 'Smart Farming', 'IoT Devices', 'Automation', 'Remote Monitoring', 'Sensors', 'AI Ready Solutions'],
                'locations' => ['Nepal', 'South Asia'],
                'logo' => '/assets/images/companies/thoplomachine.png',
                'story' => "Thoplo Machine emerged at the intersection of agriculture and hardware engineering. Recognizing the critical resource constraints faced by farmers in remote regions, we designed low-power, long-range IoT monitoring nodes that transmit real-time soil telemetry back to an autonomous Laravel orchestration engine.",
                'mission' => "To pioneer resource-efficient farming through low-cost, automated LPWAN hardware sensors and smart cloud automation.",
                'technologies' => ["LoRaWAN Gateway", "NB-IoT Sensors", "MQTT Brokers", "Laravel Queues", "TimescaleDB", "Redis Caching"],
                'industries' => ["Precision Agriculture", "Smart Irrigation", "Environmental Telemetry", "Agritech Research"],
                'faqs' => [
                    ["q" => "What communication protocols do your sensors use?", "a" => "We utilize LoRaWAN for private networks covering up to 15km, and NB-IoT cellular links for areas with standard mobile network availability."],
                    ["q" => "Does the system require manual irrigation triggers?", "a" => "No. The Laravel backend analyzes sensor moisture logs and sends downlinks to automated valves to irrigate only when necessary."]
                ],
                'related_services' => [
                    ["name" => "IoT Automation Systems", "slug" => "iot-systems-integrations"],
                    ["name" => "Cloud Architecture Design", "slug" => "cloud-infrastructure-management"]
                ]
            ],
            [
                'name' => 'BeinSEO',
                'description' => 'A professional International SEO Agency based in Dubai, UAE, helping global enterprises acquire traffic through technical, ecommerce, and local SEO.',
                'content' => 'BeinSEO is a niche search engine optimization consultancy catering to the Middle Eastern market and international brands. Headquartered in Dubai, the agency conducts code-level technical audits, executes complex international multi-lingual SEO strategies, and runs high-ROI Google Ads campaigns for retail, logistics, hospitality, and ecommerce companies.',
                'website_url' => 'https://beinseo.ae',
                'services' => ['International SEO', 'Technical SEO', 'Local SEO', 'Ecommerce SEO', 'Content Marketing', 'Google Ads', 'Analytics'],
                'locations' => ['Dubai, UAE'],
                'logo' => '/assets/images/companies/beinseo.png',
                'story' => "BeinSEO was established in Dubai to solve multi-lingual search ranking problems for enterprise brands operating across the Middle East. We specialize in code-level technical audits, custom CDN routing, and geo-targeted indexing to ensure search engine crawlability.",
                'mission' => "To eliminate code-level search indexation barriers and position enterprise brands as local market authorities.",
                'technologies' => ["Cloudflare Workers", "Hreflang Configuration", "Screaming Frog SEO Spider", "JSON-LD Schemas", "Next.js"],
                'industries' => ["Logistics & Supply Chain", "E-commerce Networks", "Luxury Hospitality", "Dubai Real Estate"],
                'faqs' => [
                    ["q" => "What is Hreflang tag configuration?", "a" => "It is a tag setup that instructs Google which regional URL to serve to a user based on their language and geographical origin, avoiding duplicate content flags."],
                    ["q" => "How do Cloudflare Workers assist with technical SEO?", "a" => "They inspect request headers at the network edge and route users to the correct localized subdirectory with near-zero latency."]
                ],
                'related_services' => [
                    ["name" => "International SEO", "slug" => "global-search-optimization"],
                    ["name" => "Technical SEO Audit", "slug" => "website-code-seo-auditing"]
                ]
            ],
            [
                'name' => 'IntechNexus',
                'description' => 'A global technology partner providing Remote Team as a Service, enterprise software development, AI integration, and DevOps consulting.',
                'content' => 'IntechNexus connects high-growth technology companies in the USA, Australia, and Switzerland with dedicated, pre-vetted remote software engineering squads. IntechNexus specializes in building scalable APIs using Laravel, developing React and Next.js frontends, integrating Large Language Models (LLMs), and designing secure, high-uptime cloud infrastructure on AWS.',
                'website_url' => 'https://intechnexus.com',
                'services' => ['Remote Team as a Service', 'Software Development', 'Dedicated Developers', 'Enterprise Applications', 'AI Integrations', 'Cloud', 'DevOps', 'Mobile Apps', 'Web Apps', 'ERP', 'CRM', 'Product Development', 'IT Consulting'],
                'locations' => ['USA', 'Australia', 'Switzerland', 'Nepal'],
                'logo' => '/assets/images/companies/intechnexus.png',
                'story' => "IntechNexus connects high-growth companies with pre-vetted, dedicated remote engineering squads. We address the tech talent deficit by sourcing, testing, and managing developers skilled in building high-uptime backends and modern web frontends.",
                'mission' => "To accelerate software product delivery for startups and enterprises through vetted, dedicated development teams.",
                'technologies' => ["Laravel 12", "React", "Next.js 15", "Docker Containers", "Kubernetes Clusters", "Amazon Web Services (AWS)"],
                'industries' => ["Fintech Core Systems", "Enterprise SaaS Platforms", "Logistics Software", "Digital Health"],
                'faqs' => [
                    ["q" => "How do you evaluate engineers?", "a" => "Candidates complete strict algorithmic coding tests, architectural system design challenges, and live pair-programming sessions with our tech leads."],
                    ["q" => "Who manages the day-to-day agile cycles?", "a" => "Our dedicated squads include a certified Scrum Master who aligns sprints, handles standups, and provides telemetry back to your team."]
                ],
                'related_services' => [
                    ["name" => "Dedicated Engineering Teams", "slug" => "remote-software-teams"],
                    ["name" => "Enterprise Architecture Consulting", "slug" => "enterprise-architecture-modernization"]
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
                'meta_title' => "About " . $cData['name'] . " | Venture Portfolio of Peshal Bhattarai",
                'meta_description' => $cData['description'],
                'keywords' => strtolower($cData['name']) . ", ventures, business, startup, tech, peshal bhattarai",
                'canonical_url' => 'https://peshalbhattarai.com/companies/' . Str::slug($cData['name']),
            ]);
        }

        // 8. Testimonials Seeding
        $testimonialsData = [
            [
                'name' => 'John Miller',
                'company' => 'IntechNexus Client - HealthSaaS Inc.',
                'position' => 'Chief Technology Officer',
                'review' => 'Peshal and his remote development team at IntechNexus rebuilt our healthcare scheduling platform from scratch using Laravel and React. Their communication is top-tier, and the code quality is exceptional. They helped us achieve full HIPAA compliance while cutting development costs by 50%.',
                'rating' => 5,
                'country' => 'USA',
                'video_url' => 'https://youtube.com/watch?v=sample1',
                'is_featured' => true,
                'client_image' => '/assets/images/testimonials/client1.jpg'
            ],
            [
                'name' => 'Saeed Al-Maktoum',
                'company' => 'BeinSEO Client - Dubai Logistics Hub',
                'position' => 'Head of Marketing',
                'review' => 'We hired BeinSEO to handle our local and international search engine optimization. Within six months, our organic inquiries increased by 180%. Peshal\'s technical SEO auditing caught major dynamic routing bottlenecks that three other agencies had missed. Outstanding work!',
                'rating' => 5,
                'country' => 'UAE',
                'video_url' => null,
                'is_featured' => true,
                'client_image' => '/assets/images/testimonials/client2.jpg'
            ],
            [
                'name' => 'Ram Shrestha',
                'company' => 'Thoplo Machine Client - GreenValley Agri-Coop',
                'position' => 'Managing Director',
                'review' => 'Deploying Thoplo Machine\'s IoT moisture sensors and automated valve gate controllers completely changed how we manage irrigation. We saved over 40% in water usage and drastically reduced manual labor overhead in our greenhouses. The dashboard is clean, fast, and easy to use.',
                'rating' => 5,
                'country' => 'Nepal',
                'video_url' => 'https://youtube.com/watch?v=sample2',
                'is_featured' => true,
                'client_image' => '/assets/images/testimonials/client3.jpg'
            ],
            [
                'name' => 'Sarah Jenkins',
                'company' => 'Digital Terai Client - EduQuest Online',
                'position' => 'VP of Growth',
                'review' => 'Digital Terai transformed our digital footprint. Their content marketing funnel design and SEO optimizations put us on the first page for highly competitive educational terms, generating a steady stream of organic leads. Peshal\'s strategic vision was critical to our success.',
                'rating' => 5,
                'country' => 'Australia',
                'video_url' => null,
                'is_featured' => false,
                'client_image' => '/assets/images/testimonials/client4.jpg'
            ],
            [
                'name' => 'Markus Zbinden',
                'company' => 'Agile Coaching Client - SwissTech Solutions',
                'position' => 'VP of Engineering',
                'review' => 'As our Agile Coach, Peshal helped restructure our legacy development teams into streamlined Scrum squads. The velocity of our software delivery doubled, but more importantly, team morale and transparency improved significantly. His deep understanding of technical architecture sets him apart.',
                'rating' => 5,
                'country' => 'Switzerland',
                'video_url' => null,
                'is_featured' => true,
                'client_image' => '/assets/images/testimonials/client5.jpg'
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

        // 9. Portfolio Projects & Case Studies
        $portfolioData = [
            [
                'title' => 'HIPAA Compliant Healthcare Scheduling API & Portal',
                'client' => 'HealthSaaS Inc.',
                'summary' => 'A robust, multi-tenant scheduling API and client dashboard constructed for high-frequency clinical environments, handling millions of appointments.',
                'technologies' => ['Laravel 12', 'Sanctum', 'MySQL 8', 'Redis', 'Next.js 15', 'TailwindCSS'],
                'business_outcomes' => [
                    'HIPAA Compliance achieved within 90 days',
                    'Zero scheduling downtime over a 12-month period',
                    '50% reduction in development and infrastructure costs'
                ],
                'results_summary' => 'Delivered a highly secure, scalable portal that processes over 50,000 requests per minute with sub-50ms API latency.',
                'website_url' => 'https://healthsaas.example.com',
                'problem' => 'The client had a legacy scheduling monolith that was slow, prone to database locking, and lacked the audit trail mechanisms required for HIPAA compliance audits.',
                'solution' => 'We designed a modern decoupled architecture. The backend is a Laravel REST API secured with Sanctum tokens. DB locking was solved using Redis distributed queues to run booking requests sequentially. A complete audit log tracking database was built using hash-chain logic.',
                'approach' => 'We used the Strangler Fig pattern to decouple parts of the legacy monolith, transitioning scheduling routes to the new API first, followed by billing and reporting modules. Framework migrations were completed in phases.',
                'duration' => '6 Months',
                'challenges' => 'Preventing concurrent double-bookings of doctors during high-traffic intervals. This was mitigated by introducing atomic locks in Redis before updating SQL tables.',
                'results' => 'The application successfully launched, achieving compliance and enabling the client to scale their enterprise hospital contracts, generating $1.5M in ARR within the first year.',
                'roi' => 250.00
            ],
            [
                'title' => 'IoT Driven Soil Moisture & Automated Irrigation System',
                'client' => 'Thoplo Machine Agritech Group',
                'summary' => 'Design, build, and installation of LPWAN soil telemetry networks and control panels for automated agricultural greenhouses.',
                'technologies' => ['LoRaWAN', 'Arduino C++', 'MQTT', 'Laravel Queues', 'InfluxDB', 'Next.js'],
                'business_outcomes' => [
                    '40% reduction in farm water consumption',
                    '70% reduction in manual crop irrigation tasks',
                    '15% yield increase in automated tomato crops'
                ],
                'results_summary' => 'Deployed 200 field sensors reporting soil telemetry continuously with automated irrigation closed-loop valves.',
                'website_url' => 'https://agritech.thoplomachine.com',
                'problem' => 'Manual irrigation resulted in either over-watering or under-watering crops, hurting harvest quality. Hard-wired soil networks were too expensive and fragile for expansive, muddy farm layouts.',
                'solution' => 'We built wireless, battery-powered LoRaWAN sensors that transmit soil moisture, temperature, and solar exposure data every 15 minutes. Gateways ingest this data via MQTT, writing to InfluxDB. Laravel scheduler runs irrigation rules: if moisture is below 25%, a LoRa downlink turns on irrigation valves automatically.',
                'approach' => 'Prototypes were built on ESP32 microcontrollers, then customized onto custom PCB designs housed in weather-proof enclosures. Ingestion architectures were load-tested to support thousands of packages.',
                'duration' => '9 Months',
                'challenges' => 'LoRa signals being degraded by wet vegetation blockades. We resolved this by mounting gateway antennas at 10 meters and tweaking spreading factor values.',
                'results' => 'Farmers controlled their farms via a Next.js dashboard, showing a 40% water savings and reducing manual labour hours.',
                'roi' => 180.00
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

            // SEO for project
            $project->seo()->create([
                'meta_title' => $pData['title'] . " | Case Study",
                'meta_description' => $pData['summary'],
                'keywords' => implode(', ', array_merge($pData['technologies'], ['portfolio, business case study'])),
                'canonical_url' => 'https://peshalbhattarai.com/portfolio/' . Str::slug($pData['title']),
            ]);

            // Case study linkage
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
                'keywords' => 'case study, roi, problem, solution, ' . implode(', ', $pData['technologies']),
                'canonical_url' => 'https://peshalbhattarai.com/case-studies/' . 'case-study-' . Str::slug($pData['title']),
            ]);
        }

        // 10. FAQs Seeding (15 FAQs per category across 10 categories = 150 FAQs!)
        $faqCategories = [
            'homepage' => 'Homepage FAQs',
            'seo' => 'SEO & SEM FAQs',
            'agile' => 'Agile Framework FAQs',
            'scrum' => 'Scrum Implementation FAQs',
            'project_management' => 'Project Management FAQs',
            'business_consulting' => 'Business Consulting FAQs',
            'digital_marketing' => 'Digital Marketing FAQs',
            'software_development' => 'Software Development FAQs',
            'remote_team' => 'Remote Team Management FAQs',
            'technology_consulting' => 'Technology Consulting FAQs'
        ];

        // Seed 15 FAQs for each category
        foreach ($faqCategories as $key => $catTitle) {
            for ($i = 1; $i <= 15; $i++) {
                $question = "";
                $answer = "";
                
                // Formulate professional QA based on the category
                switch ($key) {
                    case 'homepage':
                        $question = "Question $i: General query about Peshal Bhattarai's credentials and services?";
                        $answer = "Answer $i: Peshal Bhattarai has over 10 years of professional IT industry experience. He has successfully built multiple digital agencies and tech ventures including IntechNexus, Digital Terai, BeinSEO, and Thoplo Machine, serving clients globally across the US, Europe, and Middle East.";
                        break;
                    case 'seo':
                        $question = "Question $i: Technical SEO & International rankings checklist item #$i?";
                        $answer = "Answer $i: Our search strategy prioritizes clean site architecture, Core Web Vitals optimization, appropriate schema.org tags, and localized subdirectory routing. For global brands, we configure localized sitemaps and Cloudflare edge redirections.";
                        break;
                    case 'agile':
                        $question = "Question $i: Enterprise Agile scaling principle #$i?";
                        $answer = "Answer $i: Scaling Agile is not about adding bureaucracy; it is about establishing cross-functional teams with clear boundaries, standardizing release coordination, and prioritizing backlog items based on actual business value and tech constraints.";
                        break;
                    case 'scrum':
                        $question = "Question $i: Scrum methodology best practice #$i?";
                        $answer = "Answer $i: Pure Scrum requires focused sprint roles, dedicated Scrum Masters who act as roadblock removers, active Product Owner involvement, and continuous improvement through retrospective action plans.";
                        break;
                    case 'project_management':
                        $question = "Question $i: Modern Project Management risk mitigation step #$i?";
                        $answer = "Answer $i: We mitigate project execution risks by defining clear OpenAPI schema scopes, managing multi-team deliverables on shared boards, and implementing weekly integration checks to identify dependencies early.";
                        break;
                    case 'business_consulting':
                        $question = "Question $i: Business growth strategy checkpoint #$i?";
                        $answer = "Answer $i: We help businesses find growth channels by assessing operational bottlenecks, mapping core customer acquisition pipelines, evaluating pricing models, and building recurring revenue structures.";
                        break;
                    case 'digital_marketing':
                        $question = "Question $i: Performance marketing & B2B lead generation method #$i?";
                        $answer = "Answer $i: Our performance campaigns combine data-driven Google Ads targeting with optimized landing pages, active LinkedIn retargeting, and automated lead nurturing email workflows built on HubSpot/Brevo.";
                        break;
                    case 'software_development':
                        $question = "Question $i: SOLID code and architecture principle #$i?";
                        $answer = "Answer $i: Writing scalable applications requires using decoupled service layers, abstract repositories for database access, strict type declarations in PHP 8.4, and automated unit testing tools.";
                        break;
                    case 'remote_team':
                        $question = "Question $i: Remote team productivity and collaboration rule #$i?";
                        $answer = "Answer $i: Managing distributed developers relies on clear documentation templates, asynchronous communication protocols, daily ticketing checks, and setting up isolated Docker development spaces.";
                        break;
                    case 'technology_consulting':
                        $question = "Question $i: Technology roadmap & cloud migration guideline #$i?";
                        $answer = "Answer $i: Designing technology roadmaps requires analyzing existing code health, checking database query indices, planning secure cloud migrations to AWS, and setting up Redis cache layers.";
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
            ['name' => 'Anil Sharma', 'designation' => 'Lead Software Architect - IntechNexus', 'avatar' => '/assets/images/team/anil.jpg', 'bio' => 'Expert Laravel developer with 8+ years of code engineering experience.'],
            ['name' => 'Deepak Rayamajhi', 'designation' => 'Technical Director - Digital Terai', 'avatar' => '/assets/images/team/deepak.jpg', 'bio' => 'Data-driven marketer and search optimization lead.'],
            ['name' => 'Prabhat Bhattarai', 'designation' => 'Embedded Systems Lead - Thoplo Machine', 'avatar' => '/assets/images/team/prabhat.jpg', 'bio' => 'Hardware engineer specializing in IoT sensor calibration and LPWAN telemetry.'],
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
            ['title' => 'Enterprise Digital Transformation Playbook', 'slug' => 'digital-transformation-playbook', 'type' => 'Whitepaper', 'description' => 'A comprehensive guide to decoupling legacy systems and establishing secure cloud-based data workflows.'],
            ['title' => 'Agile Scaling Framework Comparison', 'slug' => 'agile-scaling-framework', 'type' => 'Guide', 'description' => 'An analytical comparison of SAFe, LeSS, and the Spotify Model with technical implementation details.'],
            ['title' => 'IoT Smart Farm Soil moisture Monitoring Checklist', 'slug' => 'iot-farm-monitoring', 'type' => 'Report', 'description' => 'Sensor layouts and telemetry calibration methods for remote greenhouse deployments.']
        ];
        foreach ($resourcesData as $res) {
            $r = Resource::create([
                'title' => $res['title'],
                'slug' => $res['slug'],
                'type' => $res['type'],
                'description' => $res['description'],
                'file_path' => '/assets/downloads/' . $res['slug'] . '.pdf',
                'cover_image' => '/assets/images/resources/' . $res['slug'] . '.jpg',
                'download_count' => rand(150, 450),
                'is_active' => true,
            ]);

            $r->seo()->create([
                'meta_title' => "Download " . $res['title'] . " | Resource Center",
                'meta_description' => $res['description'],
                'keywords' => "download, resource, whitepaper, tech, agile, " . strtolower($res['type']),
                'canonical_url' => 'https://peshalbhattarai.com/resources/' . $res['slug'],
            ]);
        }

        // 13. Events Seeding
        Event::create([
            'title' => 'Keynote: Navigating Legacy Software Migration',
            'slug' => 'keynote-legacy-migration',
            'type' => 'Speaking',
            'description' => 'Speaking about legacy migration strategies and the Strangler Fig pattern at the annual Tech Leadership Summit.',
            'event_date' => Carbon::now()->addMonths(2)->toDateString(),
            'location' => 'Dubai World Trade Centre',
            'link' => 'https://example.com/summit',
            'is_speaking' => true
        ]);

        // 14. Certifications Seeding
        $certifications = [
            [
                'title' => 'Research Methodology',
                'organization' => 'Kathmandu University (KU)',
                'issue_date' => '2015-06-01',
                'credential_id' => 'KU-RM-2015',
                'credential_url' => 'https://ku.edu.np',
            ],
            [
                'title' => 'ICAgile Professional',
                'organization' => 'ICAgile',
                'issue_date' => '2018-07-01',
                'credential_id' => '199-10171-a12997a0-cd34-4eb5-8428-439a6cbfea4c',
                'credential_url' => 'https://icagile.com/member/199-10171',
            ],
            [
                'title' => 'Certified Scrum Professional (CSP)',
                'organization' => 'Scrum Alliance',
                'issue_date' => '2021-10-15',
                'credential_id' => 'CSP-887162',
                'credential_url' => 'https://scrumalliance.org',
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
            'company_name' => 'InTech Nexus',
            'logo' => '/assets/images/companies/intechnexus.png',
            'role' => 'Product Manager',
            'location' => 'California, United States (Remote)',
            'type' => 'Contract',
            'duration_text' => 'May 2026 - Present (3 mos)',
            'start_date' => '2026-05-01',
            'description' => "• Define product strategy, roadmap, and business objectives.\n• Lead Agile product development from ideation to launch.\n• Collaborate with software engineers, designers, QA, and stakeholders.\n• Manage product backlog, sprint planning, and release cycles.\n• Conduct market research and competitive analysis.\n• Drive customer-centric product decisions using data and user feedback.\n• Build and manage relationships with international clients and partners.\n• Oversee software development, AI initiatives, and digital transformation projects.\n• Mentor teams and establish scalable product development processes.\n• Identify new business opportunities and support company growth.",
            'skills' => ['Scrum', 'Software Management', 'Product Strategy', 'Roadmaps', 'AI Projects'],
            'order' => 1
        ]);

        \App\Models\WorkExperience::create([
            'company_name' => 'BeinSeo',
            'logo' => '/assets/images/companies/beinseo.png',
            'role' => 'Co-Founder',
            'location' => 'Dubai, United Arab Emirates (Hybrid)',
            'type' => 'Full-time',
            'duration_text' => 'Mar 2023 - Present (3 yrs 5 mos)',
            'start_date' => '2023-03-01',
            'description' => "1. Project Planning and Management: Define project scope, objectives, and deliverables. Develop detailed project plans, timelines, and budgets.\n2. Stakeholder Communication: Act as primary contact between clients, stakeholders, and team members. Conduct regular status updates.\n3. Team Coordination: Collaborate with cross-functional designers, developers, marketers, and analysts. Align team with project goals.\n4. Risk and Issue Management: Identify potential project risks and develop mitigation strategies.\n5. Quality Assurance: Ensure project deliverables meet quality standards.\n6. Budget Management: Track project expenses.\n7. Technology and Tools: Select and manage tools for project tracking (Jira, Trello, Asana).\n8. Performance Monitoring: Measure project performance using KPIs.",
            'skills' => ['Search Engine Optimization (SEO)', 'Digital Strategy', 'Project Planning', 'Jira', 'Stakeholder Communication'],
            'order' => 2
        ]);

        \App\Models\WorkExperience::create([
            'company_name' => 'Thoplo Machine',
            'logo' => '/assets/images/companies/thoplomachine.png',
            'role' => 'Co-Founder',
            'location' => 'Kumaripati, Lalitpur',
            'type' => 'Part-time',
            'duration_text' => 'Nov 2019 - Present (6 yrs 9 mos)',
            'start_date' => '2019-11-01',
            'description' => "Co-founded Thoplo Machine to deploy smart agritech hardware and software. Overseeing product strategy, firmware deployment, LPWAN networks setup, client relations, and automated soil monitoring projects in Nepal.",
            'skills' => ['Interpersonal Skills', 'Communication', 'Agritech', 'IoT', 'Hardware Management'],
            'order' => 3
        ]);

        \App\Models\WorkExperience::create([
            'company_name' => 'Digital Terai',
            'logo' => '/assets/images/companies/digitalterai.png',
            'role' => 'Scrum Master',
            'location' => 'Koteshwor (Remote)',
            'type' => 'Part-time',
            'duration_text' => 'Mar 2019 - Present (7 yrs 5 mos)',
            'start_date' => '2019-03-01',
            'description' => "Coordinating scrum ceremonies (sprint planning, daily standups, retrospectives), coaching software engineers on agile values, facilitating team productivity, removing blocks, and driving sales management operations.",
            'skills' => ['Sales Management', 'Communication', 'Scrum Coaching', 'Agile Processes'],
            'order' => 4
        ]);

        \App\Models\WorkExperience::create([
            'company_name' => 'Fourth Valley Concierge Corporation',
            'logo' => '/assets/images/companies/fourthvalley.png',
            'role' => 'Product Manager',
            'location' => 'Tokyo, Japan (Contract)',
            'type' => 'Contract',
            'duration_text' => 'May 2022 - Jan 2025 (2 yrs 9 mos)',
            'start_date' => '2022-05-01',
            'end_date' => '2025-01-31',
            'description' => "- Leading a cross-functional team of development, engineering, design, and marketing professionals in product development (Connect Job Workers) for recruitment services to clients and candidates.\n- Gathering feedback and requirements, planning development direction, prioritization of user stories and product backlog in Agile scrum methodology.\n- Create, plan, and execution of product roadmap.\n- Collaborate with the lead developer, and task allocation management of developers to speed up software development.\n- Gathering the requirements from the relevant business team and communicating needed changes to the development team; and overseeing sprints and releases to meet the expected schedule.\n- Tracking various KPIs.",
            'skills' => ['Backlog Management', 'Interpersonal Skills', 'Product Roadmaps', 'Cross-functional Leadership', 'Connect Job Workers Portal'],
            'order' => 5
        ]);

        // 16. Education Records Seeding
        \App\Models\EducationRecord::create([
            'institution_name' => 'Kathmandu University (KU)',
            'logo' => '/assets/images/education/ku.png',
            'degree' => "Master's Degree",
            'study_field' => 'Computer Engineering',
            'duration_text' => 'Jan 2014 – Aug 2016',
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
            'description' => 'Comprehensive background in software engineering, operating systems, data structures, and computing algorithms.'
        ]);

        // 17. Seed Additional Projects listed
        \App\Models\PortfolioProject::create([
            'title' => 'Fonts.com',
            'slug' => 'fonts-com',
            'client_name' => 'Monotype / UBA Solutions Pvt. Ltd.',
            'summary' => 'Associated with UBA Solutions. Fonts.com store offers more than 150,000 desktop and Web font products for preview, purchase, and download.',
            'content' => 'High-frequency e-commerce font portal serving global creative teams. Built with complex search indexing, dynamic desktop font preview panels, web-font rendering engine integrations, and secure cart checkouts.',
            'main_image' => '/assets/images/peshal3.jpg', // Using real uploaded image
            'technologies' => ['Web Fonts', 'E-commerce', 'Font Previews', 'UBA Solutions', 'API Integrations'],
            'business_outcomes' => ['Indexed 150k+ font products', 'Streamlined checkout procedures', 'Dynamic CSS webfont previews'],
            'results_summary' => 'Successfully integrated dynamic font preview rendering widgets and streamlined checkout for Monotype.',
            'website_url' => 'https://fonts.com',
            'is_featured' => true,
            'order' => 10
        ]);

        \App\Models\PortfolioProject::create([
            'title' => 'Career Key',
            'slug' => 'career-key',
            'client_name' => 'Seattleapplab',
            'summary' => 'Provides a platform to achieve career and college success for discoverers, using Holland\'s science-based theory to match discovery personalities.',
            'content' => 'A career assessment and college guidance platform built to matches candidate traits with college majors. Integrated with interactive personality tests, scoring metrics, database catalogs of universities, and user dashboard telemetry.',
            'main_image' => '/assets/images/peshal4.jpg', // Using real uploaded image
            'technologies' => ['Personality Tests', 'SaaS platform', 'Holland Theory', 'EduTech', 'Laravel API'],
            'business_outcomes' => ['Science-based matches deployed', 'Improved student user conversion rates', 'Interactive questionnaires'],
            'results_summary' => 'Delivered a responsive assessment matrix serving thousands of high-school and university discoverers.',
            'website_url' => 'https://careerkey.example.com',
            'is_featured' => true,
            'order' => 11
        ]);

        // 18. Awards Seeding
        Award::create([
            'title' => 'Fintech Innovator of the Year',
            'organization' => 'Dubai Tech Awards',
            'year' => 2026,
            'description' => 'Awarded for exceptional leadership in legacy core banking modernization initiatives.',
        ]);

        // 16. Podcasts & Videos
        Podcast::create([
            'title' => 'Building Tech Ventures in South Asia and the Middle East',
            'slug' => 'podcast-building-ventures',
            'description' => 'An in-depth conversation about remote engineering setups, technical SEO, and agritech opportunities.',
            'audio_url' => 'https://spotify.com/episode/sample',
            'duration' => '45 Mins',
            'spotify_url' => 'https://spotify.com',
            'published_at' => now()->subDays(10)
        ]);

        Video::create([
            'title' => 'Why Agile Transformations Fail in Enterprises',
            'slug' => 'video-agile-failure',
            'description' => 'A presentation analyzing process flaws and architectural bottlenecks in corporate Agile adoptions.',
            'youtube_url' => 'https://youtube.com/watch?v=sample-agile',
            'duration' => '18 Mins',
            'published_at' => now()->subDays(5)
        ]);
        
        // 17. Seed SEO Metadata for static core pages
        $pages = [
            '/' => ['Home | Peshal Bhattarai - Tech Leader & Consultant', 'Welcome to the personal website of Peshal Bhattarai. Technology Consultant, Business Consultant, Product Owner, and Venture Builder with 10+ years of IT experience.'],
            '/about' => ['About Peshal Bhattarai | Executive Profile & Career Timeline', 'Discover Peshal Bhattarai\'s career journey, vision, methodologies, leadership accomplishments, and academic certifications.'],
            '/services' => ['Strategic Services | Tech Strategy & Business Agile Coaching', 'Explore business consulting, technology consulting, digital transformation, SEO auditing, and CTO services offered by Peshal Bhattarai.'],
            '/companies' => ['Companies & Ventures | Portfolio of Ventures', 'Learn about Digital Terai, Thoplo Machine, BeinSEO, and IntechNexus, built and managed under Peshal Bhattarai\'s portfolio.'],
            '/portfolio' => ['Portfolio & Projects | Case Studies and Business Outcomes', 'View recent tech architectures, IoT farm automation deployments, and digital transformation case studies with documented ROI calculations.'],
            '/blog' => ['Tech Strategy Insights & Blog | Peshal Bhattarai', 'Read professional articles about Scrum practices, Laravel engineering, Next.js setups, international SEO, and remote team building.'],
            '/contact' => ['Book a Consultation | Appointment Booking & Inquiries', 'Schedule an appointment, connect on WhatsApp, or send a detailed business inquiry to start your digital transformation journey.']
        ];

        foreach ($pages as $slug => $meta) {
            SeoMetadata::create([
                'model_type' => 'Page',
                'model_id' => 0, // 0 indicates static page
                'meta_title' => $meta[0],
                'meta_description' => $meta[1],
                'keywords' => 'peshal bhattarai, consulting, agile coach, scrum master, digital transformation, laravel, nextjs, dubai seo, digital terai',
                'canonical_url' => 'https://peshalbhattarai.com' . ($slug === '/' ? '' : $slug),
                'og_title' => $meta[0],
                'og_description' => $meta[1],
                'og_image' => '/assets/images/peshal-og-home.jpg',
            ]);
        }
    }
}
