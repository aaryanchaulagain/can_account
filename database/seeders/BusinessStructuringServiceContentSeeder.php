<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class BusinessStructuringServiceContentSeeder extends Seeder
{
    public static function benefits(): array
    {
        return [
            'heading' => 'Our Services',
            'intro' => null,
            'items' => [
                [
                    'title' => 'Business Structure Advice',
                    'description' => 'We help determine the most suitable structure for your business, including:',
                    'items' => [
                        'Sole Trader',
                        'Partnership',
                        'Company',
                        'Trust',
                        'Family Trust',
                        'Joint Venture Structures',
                    ],
                    'footer' => 'Our recommendations are tailored to your business objectives, growth plans, and compliance requirements.',
                ],
                [
                    'title' => 'Asset Protection Strategies',
                    'description' => 'Protecting your wealth is essential for long-term financial security. We provide advice on:',
                    'items' => [
                        'Personal asset protection',
                        'Business asset protection',
                        'Family wealth protection',
                        'Risk management strategies',
                        'Ownership structure reviews',
                    ],
                ],
                [
                    'title' => 'Business Restructuring',
                    'description' => 'As businesses grow, their structure may need to evolve. We assist with:',
                    'items' => [
                        'Business restructuring',
                        'Entity reorganization',
                        'Ownership changes',
                        'Expansion planning',
                        'Succession planning',
                    ],
                ],
                [
                    'title' => 'Tax-Efficient Structuring',
                    'description' => 'We help businesses implement structures that support:',
                    'items' => [
                        'Tax efficiency',
                        'Profit distribution planning',
                        'Investment planning',
                        'Wealth accumulation strategies',
                        'Long-term financial growth',
                    ],
                ],
                [
                    'title' => 'Succession & Estate Planning Support',
                    'description' => 'We work with business owners to develop strategies that facilitate smooth ownership transitions and protect business continuity for future generations.',
                ],
            ],
            'why_choose' => [
                'heading' => 'Why Choose Us?',
                'items' => [
                    [
                        'title' => 'Strategic Advice',
                        'description' => 'We take a long-term approach, ensuring your structure supports both current operations and future growth.',
                    ],
                    [
                        'title' => 'Risk Reduction',
                        'description' => 'Our asset protection strategies help reduce exposure to financial and legal risks.',
                    ],
                    [
                        'title' => 'Tailored Solutions',
                        'description' => 'Every business and family situation is unique. We provide customized recommendations based on your specific needs and objectives.',
                    ],
                ],
            ],
            'highlights' => [
                'heading' => 'Benefits of Proper Structuring',
                'items' => [
                    'Improved asset protection',
                    'Greater tax efficiency',
                    'Reduced business risk',
                    'Enhanced flexibility for growth',
                    'Better succession planning',
                    'Stronger long-term financial security',
                ],
            ],
            'cta' => [
                'heading' => 'Protect Your Business and Your Future',
                'description' => 'Whether you are starting a new business, restructuring an existing entity, or looking to safeguard your assets, our experienced advisors can help you create a structure that supports growth while protecting what matters most. Contact us today to discuss your Business Structuring & Asset Protection needs.',
            ],
        ];
    }

    public function run(): void
    {
        Service::where('slug', 'business-structuring-asset-protection')->update([
            'title' => 'Business Structuring & Asset Protection',
            'short_description' => 'Building the Right Structure for Long-Term Success',
            'overview' => "Choosing the right business structure is one of the most important decisions for any business owner. An effective structure can improve tax efficiency, support growth, protect personal assets, and reduce future risks.\n\nOur Business Structuring & Asset Protection services help individuals, families, and businesses establish structures that align with their financial goals while safeguarding valuable assets.",
            'benefits' => static::benefits(),
            'process_steps' => [],
            'faqs' => [],
        ]);
    }
}
