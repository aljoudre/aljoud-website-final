<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UiText;

class UiTextsSeeder extends Seeder
{
    public function run(): void
    {
        $uiTexts = [
            // Navigation
            [
                'key' => 'nav.home',
                'value' => ['ar' => 'الرئيسية', 'en' => 'Home'],
            ],
            [
                'key' => 'nav.about',
                'value' => ['ar' => 'من نحن', 'en' => 'About Us'],
            ],
            [
                'key' => 'nav.services',
                'value' => ['ar' => 'الخدمات', 'en' => 'Services'],
            ],
            [
                'key' => 'nav.projects',
                'value' => ['ar' => 'المشاريع', 'en' => 'Projects'],
            ],
            [
                'key' => 'nav.contact',
                'value' => ['ar' => 'اتصل بنا', 'en' => 'Contact Us'],
            ],
            
            // Section Titles
            [
                'key' => 'section.about.title',
                'value' => ['ar' => 'من نحن', 'en' => 'About Us'],
            ],
            [
                'key' => 'section.services.title',
                'value' => ['ar' => 'الخدمات', 'en' => 'Services'],
            ],
            [
                'key' => 'section.projects.title',
                'value' => ['ar' => 'المشاريع', 'en' => 'Projects'],
            ],
            [
                'key' => 'section.contact.title',
                'value' => ['ar' => 'اتصل بنا', 'en' => 'Contact Us'],
            ],
            
            // Footer
            [
                'key' => 'footer.company_name',
                'value' => ['ar' => 'شركة الجود للتطوير والاستثمار العقاري', 'en' => 'Aljoud Real Estate Development and Investment Company'],
            ],
            [
                'key' => 'footer.quick_links',
                'value' => ['ar' => 'روابط سريعة', 'en' => 'Quick Links'],
            ],
            [
                'key' => 'footer.contact_info',
                'value' => ['ar' => 'معلومات التواصل', 'en' => 'Contact Information'],
            ],
            [
                'key' => 'footer.follow_us',
                'value' => ['ar' => 'تابعنا', 'en' => 'Follow Us'],
            ],
            [
                'key' => 'footer.privacy_policy',
                'value' => ['ar' => 'سياسة الخصوصية', 'en' => 'Privacy Policy'],
            ],
            [
                'key' => 'footer.copyright',
                'value' => ['ar' => '&copy; 2025 شركة الجود للتطوير والاستثمار العقاري. جميع الحقوق محفوظة.', 'en' => '&copy; 2025 Aljoud Real Estate Development and Investment Company. All rights reserved.'],
            ],
            
            // Contact Section
            [
                'key' => 'contact.email',
                'value' => ['ar' => 'البريد الإلكتروني', 'en' => 'Email'],
            ],
            [
                'key' => 'contact.phone',
                'value' => ['ar' => 'رقم الهاتف', 'en' => 'Phone'],
            ],
            [
                'key' => 'contact.follow_us',
                'value' => ['ar' => 'تابعنا', 'en' => 'Follow Us'],
            ],
            
            // Contact Form
            [
                'key' => 'form.name',
                'value' => ['ar' => 'الاسم', 'en' => 'Name'],
            ],
            [
                'key' => 'form.phone',
                'value' => ['ar' => 'رقم الهاتف', 'en' => 'Phone Number'],
            ],
            [
                'key' => 'form.email',
                'value' => ['ar' => 'البريد الإلكتروني', 'en' => 'Email'],
            ],
            [
                'key' => 'form.message',
                'value' => ['ar' => 'الرسالة', 'en' => 'Message'],
            ],
            [
                'key' => 'form.submit',
                'value' => ['ar' => 'إرسال', 'en' => 'Submit'],
            ],
            [
                'key' => 'form.sending',
                'value' => ['ar' => 'جاري الإرسال...', 'en' => 'Sending...'],
            ],
            
            // Project Info Labels
            [
                'key' => 'project.owner',
                'value' => ['ar' => 'المالك', 'en' => 'Owner'],
            ],
            [
                'key' => 'project.developer',
                'value' => ['ar' => 'المطور', 'en' => 'Developer'],
            ],
            [
                'key' => 'project.contractor',
                'value' => ['ar' => 'المقاول', 'en' => 'Contractor'],
            ],
            
            // Categories
            [
                'key' => 'category.lands_auctions',
                'value' => ['ar' => 'الأراضي والمزادات', 'en' => 'Lands & Auctions'],
            ],
            [
                'key' => 'category.lands_auctions.description',
                'value' => ['ar' => 'استثمارات عقارية متخصصة في الأراضي والمزادات', 'en' => 'Specialized real estate investments in lands and auctions'],
            ],
            [
                'key' => 'category.residential_commercial',
                'value' => ['ar' => 'الأبراج السكنية والتجارية', 'en' => 'Residential & Commercial Towers'],
            ],
            [
                'key' => 'category.residential_commercial.description',
                'value' => ['ar' => 'مشاريع ضخمة وتطويرات متكاملة', 'en' => 'Large-scale projects and integrated developments'],
            ],
            [
                'key' => 'category.description',
                'value' => ['ar' => 'استكشف مشاريعنا المتميزة', 'en' => 'Explore our distinguished projects'],
            ],
            [
                'key' => 'category.no_projects',
                'value' => ['ar' => 'لا توجد مشاريع متاحة في هذه الفئة حالياً', 'en' => 'No projects available in this category at the moment'],
            ],
            [
                'key' => 'category.back_to_projects',
                'value' => ['ar' => 'العودة إلى المشاريع', 'en' => 'Back to Projects'],
            ],
            
            // Buttons
            [
                'key' => 'button.explore',
                'value' => ['ar' => 'استكشف المشاريع', 'en' => 'Explore Projects'],
            ],
            [
                'key' => 'button.register_interest',
                'value' => ['ar' => 'سجل اهتمامك', 'en' => 'Register Your Interest'],
            ],
            [
                'key' => 'button.view_gallery',
                'value' => ['ar' => 'عرض المعرض', 'en' => 'View Gallery'],
            ],
            [
                'key' => 'button.close',
                'value' => ['ar' => 'إغلاق', 'en' => 'Close'],
            ],
            [
                'key' => 'button.next',
                'value' => ['ar' => 'التالي', 'en' => 'Next'],
            ],
            [
                'key' => 'button.previous',
                'value' => ['ar' => 'السابق', 'en' => 'Previous'],
            ],
            [
                'key' => 'button.open_in_map',
                'value' => ['ar' => 'فتح في الخريطة', 'en' => 'Open in Map'],
            ],
            
            // Project Details Labels
            [
                'key' => 'project.about',
                'value' => ['ar' => 'عن المشروع', 'en' => 'About the Project'],
            ],
            [
                'key' => 'project.location',
                'value' => ['ar' => 'الموقع', 'en' => 'Location'],
            ],
            [
                'key' => 'project.nearby_places',
                'value' => ['ar' => 'الأماكن القريبة', 'en' => 'Nearby Places'],
            ],
            [
                'key' => 'project.gallery',
                'value' => ['ar' => 'معرض الصور', 'en' => 'Gallery'],
            ],
            [
                'key' => 'project.time_to_arrive',
                'value' => ['ar' => 'زمن الوصول', 'en' => 'Time to Arrive'],
            ],
            [
                'key' => 'project.minutes',
                'value' => ['ar' => 'دقيقة', 'en' => 'minutes'],
            ],
        ];

        foreach ($uiTexts as $uiText) {
            UiText::updateOrCreate(
                ['key' => $uiText['key']],
                ['value' => $uiText['value']]
            );
        }

        $this->command->info('✅ UI Texts seeded successfully!');
    }
}

