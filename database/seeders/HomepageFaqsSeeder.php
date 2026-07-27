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
                'question' => 'Who is Peshal Bhattarai?',
                'answer' => 'Peshal Bhattarai is a Technology Consultant, Business Consultant, Product Owner, and Agile Practitioner with over 10 years of experience helping businesses build software, improve operations, and accelerate digital transformation.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 1
            ],
            [
                'question' => 'What services do you offer?',
                'answer' => 'I provide business consulting, technology consulting, project management, Agile coaching, Scrum implementation, product management, software development, digital transformation, SEO consulting, and dedicated remote development teams.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 2
            ],
            [
                'question' => 'Which countries do you serve?',
                'answer' => 'I work with startups, SMEs, and enterprises across the United States, Europe, Australia, Switzerland, the UAE, and other international markets through remote collaboration.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 3
            ],
            [
                'question' => 'Can you build a dedicated remote development team?',
                'answer' => 'Yes. I help businesses hire and manage dedicated software development teams tailored to their technology stack, project goals, and budget.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 4
            ],
            [
                'question' => 'Do you work with startups?',
                'answer' => 'Yes. I specialize in helping startups validate ideas, build MVPs, create product roadmaps, and scale engineering teams.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 5
            ],
            [
                'question' => 'What industries do you specialize in?',
                'answer' => 'I have experience working across healthcare, agriculture, construction, education, hospitality, fintech, eCommerce, real estate, and digital services.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 6
            ],
            [
                'question' => 'Do you provide project management consulting?',
                'answer' => 'Yes. I help organizations improve project delivery using Agile, Scrum, Kanban, and hybrid project management methodologies.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 7
            ],
            [
                'question' => 'Can you help businesses with digital transformation?',
                'answer' => 'Yes. I assist organizations in modernizing processes, implementing technology solutions, and improving operational efficiency.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 8
            ],
            [
                'question' => 'How can I book a consultation?',
                'answer' => 'You can book a consultation through the contact page by filling out the inquiry form or scheduling a discovery call.',
                'category_key' => 'homepage',
                'page_slug' => '/',
                'order' => 9
            ],
            [
                'question' => 'Why should I choose your consulting services?',
                'answer' => 'With over a decade of experience in product development, software engineering, Agile delivery, and business consulting, I focus on practical solutions that align technology with business objectives.',
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
