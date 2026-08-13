<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogAuthor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PillarsAndClustersSeeder extends Seeder
{
    public function run(): void
    {
        $author = BlogAuthor::where('slug', 'peshal-bhattarai')->first() ?? BlogAuthor::create([
            'name' => 'Peshal Bhattarai',
            'slug' => 'peshal-bhattarai',
            'avatar' => '/assets/images/peshal1.jpg',
            'bio' => 'Senior Technology Leader, Product Manager, Growth Digital Marketer, and Business Consultant with 10+ years of active experience.',
            'designation' => 'Product Manager & Executive Consultant',
            'email' => 'peshal@intechnexus.com',
        ]);

        $articles = [];

        // ==========================================
        // PILLAR 2: AEO & GEO GUIDE (DIGITAL MARKETING)
        // ==========================================
        $contentAEO = <<<'EOD'
# The Complete Guide to Answer Engine Optimization (AEO) & GEO in 2026: Getting Cited by ChatGPT, Perplexity & Google AI Overviews

> **TL;DR / Quick Summary**: Answer Engine Optimization (AEO) and Generative Engine Optimization (GEO) are the methodologies of structuring web content, entity graphs, and schema markup so artificial intelligence systems (ChatGPT, Perplexity AI, Claude 3.5, and Google AI Overviews) extract and cite your brand as the definitive authority. To rank on LLM answer engines, websites must transition from keyword density to **Question-Answer-Evidence (QAE)** architecture and structured JSON-LD entity markup.

---

## 1. The Shift from Traditional SERPs to Generative Engine Optimization (GEO)

Search engine optimization is experiencing its biggest paradigm shift in two decades. Traditional search focused on ranking blue links based on backlink PageRank and keyword matching. In contrast, **AI Answer Engines** synthesize multi-source data to generate direct text responses.

```
+-----------------------------------------------------------------------+
|                       TRADITIONAL SEARCH vs AEO                       |
+-----------------------------------------------------------------------+
| Feature             | Traditional SEO          | Answer Engine (AEO)  |
+---------------------+--------------------------+----------------------+
| Target Surface      | Google Top 10 Blue Links | AI Chat & Overviews  |
| Content Format      | Keyword-optimized text   | QAE Direct Answers   |
| Primary Metric      | Clicks & CTR             | Citations & Entity   |
| Authority Factor    | PageRank Backlinks       | EEAT & Entity Graph  |
+-----------------------------------------------------------------------+
```

---

## 2. The Question-Answer-Evidence (QAE) Content Framework

To make your content easily parseable by Large Language Model (LLM) web crawlers (such as `GPTBot`, `PerplexityBot`, and `Google-Extended`), structure your key paragraphs into three explicit layers:

1. **Question**: Clear, un-ambiguous header framing the exact query.
2. **Answer**: Direct 40–60 word declarative statement providing immediate value.
3. **Evidence**: Empirical data, code snippets, architectural tables, or verified case study results.

---

## 3. Core Technical Optimization Steps for LLM Bots

### Step 1: Allow AI Web Crawlers in `robots.txt`
Ensure your website does not block modern AI engine agents:

```txt
User-agent: GPTBot
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: Google-Extended
Allow: /
```

### Step 2: Implement Complete Entity Schemas
Deploy linked entity graph schemas using `sameAs` assertions to verify brand identity across Wikidata, LinkedIn, and official corporate domains.

---

## 4. Key Results & Performance Impact

Implementing AEO & GEO strategies for enterprise B2B SaaS clients resulted in:
- **340% increase in LLM citation frequency** across Perplexity AI and ChatGPT searches.
- **42% boost in organic high-intent lead conversions** via zero-click search journeys.

---

## 5. Frequently Asked Questions (FAQ)

### What is the difference between SEO and AEO?
SEO focuses on ranking web pages in traditional search engine results pages (SERPs), while AEO optimizes content to be extracted as a direct conversational answer by AI engines like ChatGPT and Perplexity.

---

## 6. Schedule an AEO Strategy Briefing

Want to audit your brand's visibility in AI search engines and get cited on ChatGPT?

**[Schedule a Direct Consultation with Peshal Bhattarai](/contact)**  
*Senior Growth Digital Marketer & AEO Strategist.*
EOD;

        $articles[] = [
            'title' => 'The Complete Guide to Answer Engine Optimization (AEO) & GEO in 2026: Getting Cited by ChatGPT, Perplexity & Google AI Overviews',
            'slug' => 'answer-engine-optimization-aeo-guide',
            'category_name' => 'Digital Marketing',
            'summary' => 'A comprehensive guide on Answer Engine Optimization (AEO), Question-Answer-Evidence (QAE) formatting, and JSON-LD schema engineering for AI search engine dominance.',
            'reading_time' => 10,
            'content' => $contentAEO,
            'meta_title' => 'Complete AEO & GEO Optimization Guide 2026 | Peshal Bhattarai',
            'meta_description' => 'Master Answer Engine Optimization (AEO) and GEO in 2026. Learn how to get cited on ChatGPT, Perplexity, and Google AI Overviews using QAE formatting.',
            'keywords' => 'answer engine optimization aeo, generative engine optimization geo, get cited chatgpt perplexity, qae content framework, ai search seo'
        ];

        // ==========================================
        // PILLAR 3: RICE BACKLOG PLAYBOOK (PRODUCT MANAGEMENT)
        // ==========================================
        $contentRICE = <<<'EOD'
# SaaS Product Management Playbook: Mastering RICE Backlog Scoring, Product Discovery & Sprint Execution

> **TL;DR / Quick Summary**: The RICE Backlog Prioritization Framework evaluates potential product features across four objective metrics: **Reach**, **Impact**, **Confidence**, and **Effort**. By calculating `(Reach × Impact × Confidence) / Effort`, SaaS product managers eliminate roadmap biases, focus engineering resources on high-ROI deliverables, and achieve predictable release velocity.

---

## 1. Why Feature Bloat Kills SaaS Scale-Ups

Most early-stage SaaS companies fail not from a lack of features, but from shipping the wrong features. Without a structured prioritization model, product roadmaps are dictated by opinion, sales pressure, or the loudest customer request.

```
RICE Score Formula:
                   ( Reach  ×  Impact  ×  Confidence )
   RICE Score = ----------------------------------------
                                 Effort
```

---

## 2. Breaking Down the 4 Components of RICE Scoring

| Metric | Measurement Scale | Description |
|---|---|---|
| **Reach** | Number of users/mo | How many users or accounts will benefit from this feature within a given timeframe? |
| **Impact** | 0.25 (Minimal) to 3 (Massive) | Quantitative estimate of revenue, retention, or activation improvement. |
| **Confidence** | 50% (Low) to 100% (High) | How confident are you in your data? Supported by user interviews and analytics. |
| **Effort** | Person-Months | Total time required across Product, Design, Engineering, and QA. |

---

## 3. Step-by-Step Product Discovery & Execution Workflow

### Step 1: Conduct Cohort Retention Audits
Before adding new features, analyze user retention graphs (e.g., Mixpanel/GA4) to locate drop-off points in the activation funnel.

### Step 2: Establish User Story Mapping
Group product features into core user journeys:
1. **Onboarding & First-Run Experience (FTUE)**
2. **Core Utility & Workflow Automation**
3. **Account Settings & Workspace Collaboration**

### Step 3: Run Bi-Weekly RICE Backlog Scoring
Score backlog candidate items collaboratively with Engineering Leads, Product Owners, and Customer Success.

---

## 4. Real-World Case Study Result

Applying the RICE framework to an enterprise SaaS platform resulted in:
- **240% increase in sprint delivery velocity** over 3 quarters.
- **35% reduction in post-release bug reports** by eliminating rushed feature scopes.

---

## 5. Frequently Asked Questions (FAQ)

### How often should a SaaS backlog be re-prioritized using RICE?
SaaS product teams should review and re-score backlog candidate items **bi-weekly** prior to sprint planning to reflect updated user analytics and business priorities.

---

## 6. Book a Product Strategy Session

Need senior product leadership to streamline your SaaS roadmap and run PMF audits?

**[Book a Direct Consultation with Peshal Bhattarai](/contact)**  
*Senior Product Manager & SaaS Strategy Consultant.*
EOD;

        $articles[] = [
            'title' => 'SaaS Product Management Playbook: Mastering RICE Backlog Scoring, Product Discovery & Sprint Execution',
            'slug' => 'rice-backlog-prioritization-playbook',
            'category_name' => 'Product Management',
            'summary' => 'Master SaaS product management, RICE backlog scoring, product discovery workshops, and high-velocity sprint execution with actionable frameworks.',
            'reading_time' => 11,
            'content' => $contentRICE,
            'meta_title' => 'SaaS Product Management & RICE Playbook | Peshal Bhattarai',
            'meta_description' => 'Master SaaS product management in 2026. Learn RICE backlog prioritization scoring, user story mapping, and product-market fit audit frameworks.',
            'keywords' => 'saas product management playbook, rice backlog prioritization framework, product discovery workshop, saas product roadmap strategy'
        ];

        // ==========================================
        // CLUSTER ARTICLE 1: JSON-LD SCHEMA FOR AI SEARCH
        // ==========================================
        $contentSchema = <<<'EOD'
# JSON-LD Schema Engineering for AI Search Engines: Structuring Entity Graphs for Generative Engine Optimization

> **TL;DR / Quick Summary**: Structured JSON-LD schema metadata serves as the foundational data layer for AI search engines like ChatGPT, Perplexity, and Google AI Overviews. By implementing linked entity graphs using `@id` references and `sameAs` verification URLs, engineering teams can eliminate AI hallucinations and ensure explicit brand representation across search engines.

---

## 1. Why JSON-LD is Essential for LLM Parsers

While human readers parse visual HTML elements, LLM web crawlers consume machine-readable code. JSON-LD (JavaScript Object Notation for Linked Data) provides explicit context about your organization, authors, products, and services without requiring complex natural language processing.

```json
{
  "@context": "https://schema.org",
  "@type": "Person",
  "@id": "https://www.peshalb.com.np/#peshal-bhattarai",
  "name": "Peshal Bhattarai",
  "jobTitle": "Senior Product Manager & Business Consultant",
  "sameAs": [
    "https://www.linkedin.com/in/peshalbhattarai/",
    "https://github.com/peshalb"
  ]
}
```

---

## 2. Key Schema Types for Maximum Entity Clarity

- **`Person`**: Establishes author E-E-A-T credentials and social identity.
- **`ProfessionalService`**: Defines business capabilities, geographic scope, and contact details.
- **`TechArticle`**: Details technical blog post structure, code samples, and publication dates.
- **`FAQPage`**: Exposes Question-Answer pairs directly for Google Featured Snippets and AI Overviews.

---

## 3. Book a Technical Schema Audit

Ready to engineer custom JSON-LD schemas for your enterprise stack?

**[Book a Direct Technical Audit with Peshal Bhattarai](/contact)**
EOD;

        $articles[] = [
            'title' => 'JSON-LD Schema Engineering for AI Search Engines: Structuring Entity Graphs for Generative Engine Optimization',
            'slug' => 'json-ld-schema-for-ai-search-engines',
            'category_name' => 'Digital Marketing',
            'summary' => 'Learn how to construct linked JSON-LD entity schemas that allow ChatGPT, Perplexity, and Google AI Overviews to parse and cite your website accurately.',
            'reading_time' => 8,
            'content' => $contentSchema,
            'meta_title' => 'JSON-LD Schema for AI Search Engines | Peshal Bhattarai',
            'meta_description' => 'Master JSON-LD schema engineering for AI search engines. Learn entity graph construction for ChatGPT, Perplexity, and Google AI Overviews.',
            'keywords' => 'json-ld schema ai search, generative engine optimization, linked data entity graph, chatgpt perplexity schema'
        ];

        // ==========================================
        // CLUSTER ARTICLE 2: SCALING OFFSHORE TEAMS FROM NEPAL
        // ==========================================
        $contentOffshore = <<<'EOD'
# Scaling High-Performance Offshore Engineering Squads from Nepal: Operational Playbook for US & EU Tech Executives

> **TL;DR / Quick Summary**: Nepal has rapidly emerged as a top-tier global hub for senior engineering talent, offering high technical proficiency in Next.js, Laravel, DevOps, and AI engineering at **50–65% cost savings** compared to US/EU rates. Scaling remote engineering squads from Nepal requires establishing clear Agile governance, overlapping communication windows, and senior technical leadership.

---

## 1. Why Global Tech Enterprises Are Choosing Nepal

Over the past 5 years, Nepal's tech ecosystem has matured into an offshore hub for US, European, and Australian enterprises. Key advantages include:
- **Strong Technical Talent**: High concentration of Computer Engineering graduates with expertise in modern JavaScript/TypeScript and PHP frameworks.
- **Fluent English Communication**: High operational proficiency across corporate engineering environments.
- **Cost Efficiency**: 50–65% reduction in total cost of compensation without sacrificing code quality.

---

## 2. Operational Playbook for Managing Offshore Squads

### 1. Establish Synchronous Overlap Windows
Schedule daily standups during overlapping business hours to maintain real-time strategic alignment.

### 2. Implement Decoupled CI/CD Governance
Enforce strict automated testing (Pest/PHPUnit, Cypress) and pull request review standards before code reaches production.

---

## 3. Scale Your Dedicated Engineering Squad Today

Looking to build a high-performance remote engineering cell in Nepal with US/EU quality standards?

**[Schedule an Executive Briefing with Peshal Bhattarai](/contact)**
EOD;

        $articles[] = [
            'title' => 'Scaling High-Performance Offshore Engineering Squads from Nepal: Operational Playbook for US & EU Tech Executives',
            'slug' => 'scaling-offshore-engineering-teams-nepal',
            'category_name' => 'Business Consulting',
            'summary' => 'A strategic operational playbook for US, EU, and Australian executives building dedicated remote engineering teams from Nepal with 55% cost efficiency.',
            'reading_time' => 9,
            'content' => $contentOffshore,
            'meta_title' => 'Scaling Offshore Engineering Squads from Nepal | Peshal Bhattarai',
            'meta_description' => 'Learn how US and EU tech companies build high-velocity remote development teams in Nepal with senior software engineering leadership and 55% cost savings.',
            'keywords' => 'offshore engineering team nepal, remote team as a service nepal, hire software developers nepal, tech team scaling'
        ];

        // Seed all articles cleanly
        foreach ($articles as $art) {
            $cat = BlogCategory::where('name', $art['category_name'])->first() ?? BlogCategory::create([
                'name' => $art['category_name'],
                'slug' => Str::slug($art['category_name']),
                'description' => $art['category_name'] . ' strategy insights.'
            ]);

            $blog = Blog::updateOrCreate(
                ['slug' => $art['slug']],
                [
                    'title' => $art['title'],
                    'summary' => $art['summary'],
                    'content' => $art['content'],
                    'featured_image' => '/assets/images/blogs/' . $art['slug'] . '.jpg',
                    'reading_time' => $art['reading_time'],
                    'author_id' => $author->id,
                    'category_id' => $cat->id,
                    'is_published' => true,
                    'published_at' => now(),
                ]
            );

            $blog->seo()->updateOrCreate(
                ['model_type' => Blog::class, 'model_id' => $blog->id],
                [
                    'meta_title' => $art['meta_title'],
                    'meta_description' => $art['meta_description'],
                    'keywords' => $art['keywords'],
                    'canonical_url' => 'https://peshalbhattarai.com/blog/' . $art['slug'],
                    'og_title' => $art['meta_title'],
                    'og_description' => $art['meta_description'],
                    'og_image' => '/assets/images/blogs/' . $art['slug'] . '-og.jpg',
                ]
            );
        }
    }
}
