<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class TaxPlanningWealthServiceContentSeeder extends Seeder
{
    public static function benefits(): array
    {
        return [
            'heading' => 'Our Services',
            'intro' => null,
            'items' => [
                [
                    'title' => 'Tax Planning & Advisory',
                    'description' => 'We provide strategic tax advice to help you make informed financial decisions, including:',
                    'items' => [
                        'Tax-effective business structures',
                        'Income tax planning',
                        'Capital Gains Tax (CGT) planning',
                        'Investment tax strategies',
                        'Year-end tax planning',
                        'Tax compliance support',
                    ],
                ],
                [
                    'title' => 'Wealth Creation Strategies',
                    'description' => 'Our advisors help you develop practical strategies to grow and preserve wealth through:',
                    'items' => [
                        'Investment planning support',
                        'Wealth accumulation strategies',
                        'Financial goal planning',
                        'Long-term growth strategies',
                        'Asset ownership reviews',
                    ],
                ],
                [
                    'title' => 'Business Tax Strategies',
                    'description' => 'We assist business owners with:',
                    'items' => [
                        'Tax minimisation strategies',
                        'Profit distribution planning',
                        'Cash flow and tax forecasting',
                        'Business succession planning',
                        'Growth-focused tax solutions',
                    ],
                ],
                [
                    'title' => 'Retirement & Superannuation Planning',
                    'description' => 'Prepare for the future with confidence through:',
                    'items' => [
                        'Retirement planning strategies',
                        'Superannuation contribution planning',
                        'Tax-effective retirement income strategies',
                        'Wealth preservation planning',
                    ],
                ],
                [
                    'title' => 'Family Wealth & Succession Planning',
                    'description' => 'We help families protect and transfer wealth efficiently through:',
                    'items' => [
                        'Family trust strategies',
                        'Wealth transfer planning',
                        'Estate planning support',
                        'Succession planning',
                        'Asset protection strategies',
                    ],
                ],
            ],
            'why_choose' => [
                'heading' => 'Why Choose Us?',
                'items' => [
                    [
                        'title' => 'Proactive Tax Advice',
                        'description' => 'We identify opportunities throughout the year to help reduce tax liabilities and improve financial outcomes.',
                    ],
                    [
                        'title' => 'Tailored Wealth Strategies',
                        'description' => 'Every client has unique goals. Our advice is customised to your financial circumstances and long-term objectives.',
                    ],
                    [
                        'title' => 'Long-Term Partnership',
                        'description' => 'We focus on creating sustainable strategies that support wealth growth, protection, and future financial security.',
                    ],
                ],
            ],
            'highlights' => [
                'heading' => 'Benefits of Effective Tax Planning',
                'items' => [
                    'Improved tax efficiency',
                    'Greater wealth accumulation opportunities',
                    'Better cash flow management',
                    'Reduced financial risk',
                    'Enhanced retirement readiness',
                    'Long-term asset and wealth protection',
                ],
            ],
            'cta' => [
                'heading' => 'Build, Grow & Protect Your Wealth',
                'description' => 'Whether you are an individual, investor, business owner, or family seeking to secure your financial future, our experienced advisors can help you develop strategies that support lasting success. Contact us today to discover how strategic tax planning and wealth management can help you achieve your financial goals.',
            ],
        ];
    }

    public function run(): void
    {
        Service::where('slug', 'tax-planning-wealth-strategies')->update([
            'title' => 'Tax Planning & Wealth Strategies',
            'short_description' => 'Maximising Wealth Through Strategic Tax Planning',
            'overview' => "Effective tax planning is about more than simply meeting compliance obligations—it is about creating opportunities to grow, protect, and preserve your wealth. With the right strategies in place, individuals, families, and businesses can improve tax efficiency while working towards their long-term financial goals.\n\nOur Tax Planning & Wealth Strategies services provide proactive, tailored advice designed to minimise tax liabilities, optimise financial outcomes, and support sustainable wealth creation.",
            'benefits' => static::benefits(),
            'process_steps' => [],
            'faqs' => [],
        ]);
    }
}
