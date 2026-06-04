<?php

namespace App\Services;

use App\Models\SiteSetting;

class SeoService
{
    public function meta(
        ?string $title = null,
        ?string $description = null,
        ?string $image = null,
        ?string $url = null,
        string $type = 'website'
    ): array {
        $siteName = SiteSetting::get('site_name', 'Canberra Accountants');
        $defaultTitle = SiteSetting::get('seo_default_title', $siteName);
        $defaultDescription = SiteSetting::get('seo_default_description', 'Professional accounting, taxation and advisory services across Australia.');
        $defaultImage = SiteSetting::get('seo_default_image', asset('images/og-default.jpg'));

        $metaTitle = $title ? "{$title} | {$siteName}" : $defaultTitle;
        $metaDescription = $description ?? $defaultDescription;
        $canonical = $url ?? url()->current();
        $ogImage = $image ?? $defaultImage;

        return [
            'title' => $metaTitle,
            'description' => $metaDescription,
            'canonical' => $canonical,
            'og' => [
                'title' => $metaTitle,
                'description' => $metaDescription,
                'image' => $ogImage,
                'url' => $canonical,
                'type' => $type,
                'site_name' => $siteName,
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $metaTitle,
                'description' => $metaDescription,
                'image' => $ogImage,
            ],
        ];
    }

    public function organizationSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'AccountingService',
            'name' => SiteSetting::get('site_name', 'Canberra Accountants'),
            'url' => SiteSetting::get('website_url', 'https://www.canberraaccountants.com.au'),
            'telephone' => SiteSetting::get('phone', '(02) 6190 6075'),
            'email' => SiteSetting::get('email', 'info@canberraaccountants.com.au'),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Unit 12/3 Barrier Street',
                'addressLocality' => 'Fyshwick',
                'addressRegion' => 'ACT',
                'postalCode' => '2609',
                'addressCountry' => 'AU',
            ],
            'areaServed' => ['Canberra', 'Sydney', 'Hobart', 'Adelaide', 'Australia'],
        ];
    }
}
