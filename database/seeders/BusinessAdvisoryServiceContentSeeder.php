<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class BusinessAdvisoryServiceContentSeeder extends Seeder
{
    public static function benefits(): array
    {
        return [
            'heading' => 'Our Services',
            'intro' => null,
            'items' => [
                [
                    'title' => 'Strategic Business Planning',
                    'description' => 'We help businesses develop clear growth strategies through:',
                    'items' => [
                        'Business planning and goal setting',
                        'Performance monitoring',
                        'KPI development',
                        'Growth and expansion strategies',
                    ],
                ],
                [
                    'title' => 'Financial Performance & Cash Flow',
                    'description' => 'Gain a better understanding of your business finances with:',
                    'items' => [
                        'Financial analysis and reporting',
                        'Budgeting and forecasting',
                        'Cash flow management',
                        'Profitability improvement strategies',
                    ],
                ],
                [
                    'title' => 'Business Structure & Risk Management',
                    'description' => 'We provide guidance on:',
                    'items' => [
                        'Business structure reviews',
                        'Asset protection strategies',
                        'Risk assessments',
                        'Succession and continuity planning',
                    ],
                ],
                [
                    'title' => 'Growth Advisory',
                    'description' => 'Our advisors help businesses:',
                    'items' => [
                        'Identify growth opportunities',
                        'Improve operational efficiency',
                        'Expand into new markets',
                        'Develop scalable business models',
                    ],
                ],
                [
                    'title' => 'Funding & Business Transactions',
                    'description' => 'We assist with:',
                    'items' => [
                        'Business financing and loan support',
                        'Capital raising strategies',
                        'Business valuations',
                        'Business acquisition and sale advisory',
                    ],
                ],
            ],
            'why_choose' => [
                'heading' => 'Why Choose Us?',
                'items' => [
                    [
                        'title' => 'Experienced Professionals',
                        'description' => 'Our team combines financial, taxation, and business expertise to deliver practical solutions.',
                    ],
                    [
                        'title' => 'Tailored Advice',
                        'description' => 'Every business is different. We provide strategies designed around your specific goals and challenges.',
                    ],
                    [
                        'title' => 'Proactive Support',
                        'description' => 'We focus on future growth, helping businesses make informed decisions and seize new opportunities.',
                    ],
                ],
            ],
            'industries' => [
                'heading' => 'Industries We Serve',
                'items' => [
                    'Professional Services',
                    'Construction & Trades',
                    'Retail & E-commerce',
                    'Healthcare',
                    'Real Estate',
                    'Technology & Startups',
                    'Hospitality',
                    'Manufacturing',
                ],
            ],
            'cta' => [
                'heading' => "Let's Build Your Business Success",
                'description' => "Whether you're starting a business, improving profitability, expanding operations, or planning for the future, our Business Advisory & Growth Advisory team can help you achieve your goals. Contact us today to discuss how we can support your business growth and long-term success.",
            ],
        ];
    }

    public function run(): void
    {
        Service::where('slug', 'business-advisory-growth-strategy')->update([
            'title' => 'Business Advisory & Growth Advisory',
            'short_description' => 'Helping Your Business Grow with Confidence',
            'overview' => "Successful businesses require more than day-to-day management. They need clear financial insight, strategic planning, and expert guidance to achieve sustainable growth.\n\nOur Business Advisory & Growth Advisory services help business owners improve performance, increase profitability, manage risks, and identify new opportunities. We work closely with businesses at every stage, providing practical advice tailored to their goals.",
            'benefits' => static::benefits(),
            'process_steps' => [],
            'faqs' => [],
        ]);
    }
}
