<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Generate SEO meta tags
     */
    public static function metaTags(array $data = []): array
    {
        $defaults = [
            'title' => 'Aljoud Real Estate - شركة الجود للتطوير والاستثمار العقاري',
            'description' => 'شركة الجود للتطوير والاستثمار العقاري - مشاريع عقارية متميزة في المملكة العربية السعودية',
            'keywords' => 'عقارات، استثمار عقاري، تطوير عقاري، مشاريع سكنية، مشاريع تجارية، السعودية',
            'image' => asset('assets/images/logo.png'),
            'url' => url()->current(),
            'type' => 'website',
            'site_name' => 'الجود للتطوير والاستثمار العقاري',
            'locale' => app()->getLocale(),
        ];

        $data = array_merge($defaults, $data);

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'keywords' => $data['keywords'],
            'image' => $data['image'],
            'url' => $data['url'],
            'type' => $data['type'],
            'site_name' => $data['site_name'],
            'locale' => $data['locale'],
        ];
    }

    /**
     * Generate structured data (JSON-LD)
     */
    public static function structuredData(array $data = []): array
    {
        $defaults = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'الجود للتطوير والاستثمار العقاري',
            'url' => url('/'),
            'logo' => asset('assets/images/logo.png'),
        ];

        return array_merge($defaults, $data);
    }
}

