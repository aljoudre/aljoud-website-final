<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectNearPlace;
use App\Models\ProjectButton;
use Illuminate\Support\Str;

class MockProjectsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing projects if needed
        // Project::truncate(); // Uncomment if you want to reset

        // Lands & Auctions Projects
        $landsProjects = [
            [
                'name' => [
                    'ar' => 'لوت ١ - الأراضي الذهبية',
                    'en' => 'Lot 1 - Golden Lands',
                ],
                'subtitle' => [
                    'ar' => 'قطعة أرض سكنية مميزة للبيع',
                    'en' => 'Premium Residential Land for Sale',
                ],
                'location' => [
                    'ar' => 'الرياض، حي الياسمين',
                    'en' => 'Riyadh, Al Yasmin District',
                ],
                'type' => [
                    'ar' => 'قطعة أرض',
                    'en' => 'Land Plot',
                ],
                'status' => [
                    'ar' => 'متاح',
                    'en' => 'Available',
                ],
                'status_color' => '#EEA67D',
                'category' => 'lands_auctions',
                'description' => [
                    'ar' => 'قطعة أرض سكنية فاخرة في موقع مميز بمساحة ٢٠٠٠ متر مربع. تتميز بالموقف الإستراتيجي القريب من الخدمات والمرافق الحيوية. الموقع مثالي لإقامة مشروع سكني متكامل أو استثمار مربح.',
                    'en' => 'Premium residential land in an exceptional location spanning 2000 square meters. Features strategic positioning near vital services and facilities. Perfect for building an integrated residential project or profitable investment.',
                ],
                'owner' => ['ar' => 'شركة الجود', 'en' => 'Aljoud Company'],
                'nearby_places' => [
                    ['ar' => 'مركز التسوق الياسمين', 'en' => 'Yasmin Shopping Center'],
                    ['ar' => 'مستشفى الملك فهد', 'en' => 'King Fahd Hospital'],
                    ['ar' => 'مطار الملك خالد', 'en' => 'King Khaled Airport'],
                ],
            ],
            [
                'name' => [
                    'ar' => 'لوت ٢ - الاستثمار الذهبي',
                    'en' => 'Lot 2 - Golden Investment',
                ],
                'subtitle' => [
                    'ar' => 'أرض تجارية للبيع بالمزاد',
                    'en' => 'Commercial Land for Auction',
                ],
                'location' => [
                    'ar' => 'جدة، طريق الكورنيش',
                    'en' => 'Jeddah, Corniche Road',
                ],
                'type' => [
                    'ar' => 'أرض تجارية',
                    'en' => 'Commercial Land',
                ],
                'status' => [
                    'ar' => 'مزاد قادم',
                    'en' => 'Upcoming Auction',
                ],
                'status_color' => '#028281',
                'category' => 'lands_auctions',
                'description' => [
                    'ar' => 'أرض تجارية استثنائية على الكورنيش بمساحة ٣٥٠٠ متر مربع. موقع مثالي لإقامة مجمع تجاري أو مبنى إداري. فرصة استثمارية نادرة لا تتكرر.',
                    'en' => 'Exceptional commercial land on the corniche spanning 3500 square meters. Perfect location for a commercial complex or administrative building. Rare investment opportunity.',
                ],
                'owner' => ['ar' => 'مؤسسة الجود', 'en' => 'Aljoud Foundation'],
                'nearby_places' => [
                    ['ar' => 'مركز البحر الأحمر', 'en' => 'Red Sea Center'],
                    ['ar' => 'مطار الملك عبدالعزيز', 'en' => 'King Abdulaziz Airport'],
                    ['ar' => 'جامعة الملك عبدالعزيز', 'en' => 'King Abdulaziz University'],
                ],
            ],
        ];

        // Residential & Commercial Projects
        $residentialProjects = [
            [
                'name' => [
                    'ar' => 'برج درة الجود',
                    'en' => 'Durat Aljoud Tower',
                ],
                'subtitle' => [
                    'ar' => 'أبراج سكنية وتجارية فاخرة',
                    'en' => 'Luxury Residential and Commercial Towers',
                ],
                'location' => [
                    'ar' => 'الرياض، طريق الملك عبدالله',
                    'en' => 'Riyadh, King Abdullah Road',
                ],
                'type' => [
                    'ar' => 'أبراج مختلطة',
                    'en' => 'Mixed Towers',
                ],
                'status' => [
                    'ar' => 'قيد الإنشاء',
                    'en' => 'Under Construction',
                ],
                'status_color' => '#005A58',
                'category' => 'residential_commercial',
                'description' => [
                    'ar' => 'أبراج درة الجود مشروع عقاري متكامل يجمع بين الفخامة والجودة العالية. يتضمن وحدات سكنية عصرية ومساحات تجارية وإدارية. تصميم معماري عصري يواكب رؤية ٢٠٣٠.',
                    'en' => 'Durat Aljoud Towers is an integrated real estate project combining luxury and high quality. Features modern residential units, commercial and administrative spaces. Modern architectural design aligned with Vision 2030.',
                ],
                'owner' => ['ar' => 'شركة الجود للتطوير', 'en' => 'Aljoud Development Company'],
                'developer' => ['ar' => 'الجود للإنشاءات', 'en' => 'Aljoud Construction'],
                'nearby_places' => [
                    ['ar' => 'مطار الملك خالد', 'en' => 'King Khaled Airport'],
                    ['ar' => 'مركز الملك عبدالله المالي', 'en' => 'King Abdullah Financial Center'],
                    ['ar' => 'مستشفى الحبيب', 'en' => 'Al-Habib Hospital'],
                ],
            ],
            [
                'name' => [
                    'ar' => 'مجمع أبراج البحر الأحمر',
                    'en' => 'Red Sea Towers Complex',
                ],
                'subtitle' => [
                    'ar' => 'مجمع سكني راقي على البحر',
                    'en' => 'Premium Beachfront Residential Complex',
                ],
                'location' => [
                    'ar' => 'جدة، كورنيش البحر الأحمر',
                    'en' => 'Jeddah, Red Sea Corniche',
                ],
                'type' => [
                    'ar' => 'سكني',
                    'en' => 'Residential',
                ],
                'status' => [
                    'ar' => 'متاح',
                    'en' => 'Available',
                ],
                'status_color' => '#EEA67D',
                'category' => 'residential_commercial',
                'description' => [
                    'ar' => 'مجمع أبراج فاخر يوفر إطلالات بانورامية على البحر الأحمر. يضم شقق وأجنحة فاخرة بخدمات خمس نجوم. تصاميم عصرية مع مرافق رياضية وترفيهية متكاملة.',
                    'en' => 'Luxury towers complex offering panoramic views of the Red Sea. Features luxury apartments and suites with five-star services. Modern designs with integrated sports and recreational facilities.',
                ],
                'owner' => ['ar' => 'الجود العقارية', 'en' => 'Aljoud Real Estate'],
                'contractor' => ['ar' => 'شركة الخليج للبناء', 'en' => 'Gulf Construction Company'],
                'nearby_places' => [
                    ['ar' => 'الشاطئ الذهبي', 'en' => 'Golden Beach'],
                    ['ar' => 'مركز البحري التجاري', 'en' => 'Bahri Commercial Center'],
                    ['ar' => 'مسجد الملك فهد', 'en' => 'King Fahd Mosque'],
                ],
            ],
        ];

        // Combine all projects
        $allProjects = array_merge($landsProjects, $residentialProjects);

        foreach ($allProjects as $projectData) {
            // Extract nearby places before creating project
            $nearbyPlaces = $projectData['nearby_places'] ?? [];
            unset($projectData['nearby_places']);

            // Create project
            $project = Project::create($projectData);

            // Add nearby places
            foreach ($nearbyPlaces as $index => $place) {
                ProjectNearPlace::create([
                    'project_id' => $project->id,
                    'name' => [
                        'ar' => $place['ar'],
                        'en' => $place['en'],
                    ],
                    'description' => [
                        'ar' => 'موقع مميز قريب من المشروع',
                        'en' => 'Prime location near the project',
                    ],
                    'order' => $index,
                ]);
            }

            // Add interest registration button
            ProjectButton::create([
                'project_id' => $project->id,
                'title' => [
                    'ar' => 'سجل اهتمامك',
                    'en' => 'Register Your Interest',
                ],
                'type' => 'form',
                'form_url' => 'https://forms.google.com/example',
                'order' => 0,
            ]);
        }

        $this->command->info('✅ Mock projects with near places and buttons created successfully!');
    }
}
