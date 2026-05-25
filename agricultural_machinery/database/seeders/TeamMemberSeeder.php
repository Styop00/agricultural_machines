<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Tyler Bennett',
                'role' => 'General Manager',
                'location' => 'Green Bay, WI',
                'bio' => 'Keeps the showroom, inventory, and customer experience moving with clear communication and practical advice.',
            ],
            [
                'name' => 'Ryan Mitchell',
                'role' => 'Sales Manager',
                'location' => 'Madison, WI',
                'bio' => 'Helps buyers compare equipment, review condition details, and choose the right machine for the job.',
            ],
            [
                'name' => 'Jake Morrison',
                'role' => 'Sales Associate',
                'location' => 'Milwaukee, WI',
                'bio' => 'Guides remote buyers through photos, inspection details, transport options, and quick follow-up questions.',
            ],
            [
                'name' => 'Madison Reed',
                'role' => 'Customer Experience Specialist',
                'location' => 'Appleton, WI',
                'bio' => 'Coordinates appointments, information requests, paperwork support, and post-sale communication.',
            ],
            [
                'name' => 'Caleb Foster',
                'role' => 'Service Coordinator',
                'location' => 'Oshkosh, WI',
                'bio' => 'Schedules inspections, maintenance support, and repair coordination for incoming and outgoing inventory.',
            ],
            [
                'name' => 'Grant Wallace',
                'role' => 'Inventory Specialist',
                'location' => 'Eau Claire, WI',
                'bio' => 'Keeps listings accurate with stock numbers, photos, specs, categories, and condition notes.',
            ],
            [
                'name' => 'Elliot Hayes',
                'role' => 'Delivery Coordinator',
                'location' => 'La Crosse, WI',
                'bio' => 'Plans nationwide delivery, pickup timing, and safe handoff from the yard to the buyer.',
            ],
            [
                'name' => 'Noah Parker',
                'role' => 'Warranty Advisor',
                'location' => 'Kenosha, WI',
                'bio' => 'Explains warranty options, guarantee details, eligibility, and support steps before purchase.',
            ],
        ];

        foreach ($members as $index => $member) {
            TeamMember::query()->updateOrCreate(
                ['name' => $member['name']],
                [
                    ...$member,
                    'avatar_url' => 'https://i.pravatar.cc/640?u=fieldpro-team-'.$index,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }
    }
}
