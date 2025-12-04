<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hero;
use App\Models\About;
use App\Models\Service;
use App\Models\Project;
use Illuminate\Support\Str;

class DefaultContentSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Section
        if (Hero::count() === 0) {
            Hero::create([
                'title' => [
                    'ar' => 'شريككم نحو تحقيق الأحلام العقارية',
                    'en' => 'Your Partner Towards Achieving Real Estate Dreams',
                ],
                'subtitle' => [
                    'ar' => 'الجود.. رمز الإبداع العقاري والاستثمار الواعد',
                    'en' => 'Aljoud.. The Symbol of Real Estate Innovation and Promising Investment',
                ],
                'media' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1920&q=80',
            ]);
        }

        // About Section
        if (About::count() === 0) {
            About::create([
                'header' => [
                    'ar' => 'شريككم نحو تحقيق الأحلام العقارية',
                    'en' => 'Your Partner Towards Achieving Real Estate Dreams',
                ],
                'content' => [
                    'ar' => 'في شركة الجود للتطوير والاستثمار العقاري، نسعى لبناء مستقبل عقاري واعد من خلال مشاريعنا المبتكرة وخدماتنا الشاملة. نفخر بفريقنا من الخبراء الذين يعملون بلا كلل لتحقيق رؤية عملائنا وتلبية توقعاتهم. نلتزم بتقديم حلول عقارية متكاملة تضمن الجودة والكفاءة، مع التركيز على تحقيق أفضل العوائد لمستثمرينا.',
                    'en' => 'At Aljoud Real Estate Development and Investment Company, we strive to build a promising real estate future through our innovative projects and comprehensive services. We are proud of our team of experts who work tirelessly to achieve our clients\' vision and meet their expectations. We are committed to providing integrated real estate solutions that ensure quality and efficiency, with a focus on achieving the best returns for our investors.',
                ],
            ]);
        }

        // Services Section
        if (Service::count() === 0) {
            $services = [
                [
                    'title' => [
                        'ar' => 'التطوير العقاري',
                        'en' => 'Real Estate Development',
                    ],
                    'description' => [
                        'ar' => 'تحويل الأراضي والمباني إلى مشاريع متميزة بجودة عالية وتصميم معاصر.',
                        'en' => 'Transforming lands and buildings into distinguished projects with high quality and contemporary design.',
                    ],
                ],
                [
                    'title' => [
                        'ar' => 'التسويق العقاري',
                        'en' => 'Real Estate Marketing',
                    ],
                    'description' => [
                        'ar' => 'استراتيجيات تسويق متطورة لتعزيز الوجود وجذب المستثمرين والعملاء.',
                        'en' => 'Advanced marketing strategies to enhance presence and attract investors and clients.',
                    ],
                ],
                [
                    'title' => [
                        'ar' => 'إدارة الأملاك',
                        'en' => 'Property Management',
                    ],
                    'description' => [
                        'ar' => 'حلول متكاملة للصيانة، التأجير وإدارة العائدات بكفاءة عالية.',
                        'en' => 'Integrated solutions for maintenance, leasing, and revenue management with high efficiency.',
                    ],
                ],
                [
                    'title' => [
                        'ar' => 'الاستثمار العقاري',
                        'en' => 'Real Estate Investment',
                    ],
                    'description' => [
                        'ar' => 'استشارات استثمارية مبنية على البيانات والتوجهات السوقية الراهنة.',
                        'en' => 'Investment consultations based on data and current market trends.',
                    ],
                ],
                [
                    'title' => [
                        'ar' => 'الاستشارات العقارية',
                        'en' => 'Real Estate Consultations',
                    ],
                    'description' => [
                        'ar' => 'توجيه متخصص لمساعدة العملاء على اتخاذ قرارات مستنيرة.',
                        'en' => 'Specialized guidance to help clients make informed decisions.',
                    ],
                ],
                [
                    'title' => [
                        'ar' => 'الدراسات والأبحاث',
                        'en' => 'Studies and Research',
                    ],
                    'description' => [
                        'ar' => 'دراسات سوق شاملة وتحليلات دقيقة لدعم الاستراتيجيات الاستثمارية.',
                        'en' => 'Comprehensive market studies and accurate analyses to support investment strategies.',
                    ],
                ],
            ];

            foreach ($services as $service) {
                Service::create($service);
            }
        }

        // Projects Section - Skip projects seeding (handled by MockProjectsSeeder)
        // This ensures only 2 projects are created (one per category)

        $this->command->info('✅ Default content seeded successfully!');
    }
}

