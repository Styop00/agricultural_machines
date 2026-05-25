<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Melissa Carter',
                'location' => 'Columbus, OH',
                'context' => 'Vehicle Purchase',
                'quote' => 'I was honestly nervous buying online, but everything turned out great. The inspection details were clear, the photos were accurate, and the team kept me updated the entire time.',
            ],
            [
                'name' => 'Anthony Ramirez',
                'location' => 'San Antonio, TX',
                'context' => 'Nationwide Delivery',
                'quote' => 'Solid experience from start to finish. No pushy sales talk, just straight answers and fair pricing. The machine showed up on time and exactly how they described it.',
            ],
            [
                'name' => 'Jason Miller',
                'location' => 'Phoenix, AZ',
                'context' => 'Remote Buyer',
                'quote' => 'Bought my harvester sight unseen and was pleasantly surprised. Communication was consistent and they answered all my questions quickly. Delivery went smooth.',
            ],
            [
                'name' => 'Nicole Bennett',
                'location' => 'Charlotte, NC',
                'context' => 'Delivery Support',
                'quote' => 'Everything was handled quickly and professionally. I appreciated how responsive the team was throughout the process. The machine matched the listing perfectly.',
            ],
            [
                'name' => 'Marcus Green',
                'location' => 'Des Moines, IA',
                'context' => 'Warranty Support',
                'quote' => 'The warranty explanation was simple and honest. They helped us understand coverage before purchase and followed up after delivery.',
            ],
            [
                'name' => 'Samantha Reed',
                'location' => 'Boise, ID',
                'context' => 'Service Coordination',
                'quote' => 'The service team helped schedule inspection work around our operating hours. It felt organized, professional, and easy from the first call.',
            ],
        ];

        foreach ($testimonials as $index => $testimonial) {
            Testimonial::query()->updateOrCreate(
                ['name' => $testimonial['name']],
                [
                    ...$testimonial,
                    'image_url' => "https://picsum.photos/seed/fieldpro-testimonial-{$index}/900/520",
                    'avatar_url' => "https://i.pravatar.cc/160?u=fieldpro-testimonial-{$index}",
                    'sort_order' => $index + 1,
                    'is_featured' => true,
                ],
            );
        }
    }
}
