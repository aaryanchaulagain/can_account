<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class TaxationServiceContentSeeder extends Seeder
{
    public function run(): void
    {
        Service::where('slug', 'taxation-advisory-compliance')->update([
            'overview' => "Our taxation team ensures full ATO compliance while identifying legitimate opportunities to minimise tax liabilities through strategic planning.\n\nWe work with individuals, investors, and business owners to navigate Australia's tax system with confidence — from annual returns to complex capital gains and cross-border matters.",
            'benefits' => [
                'heading' => 'Individual Taxation',
                'intro' => 'Our advisers assist clients across:',
                'items' => [
                    [
                        'title' => 'Individual Tax Returns',
                        'description' => 'Comprehensive preparation and lodgement services designed to ensure compliance while identifying legitimate opportunities to maximise outcomes.',
                    ],
                    [
                        'title' => 'Property Investment Taxation',
                        'description' => 'Strategic advice regarding:',
                        'items' => [
                            'Rental property deductions',
                            'Depreciation considerations',
                            'Capital gains implications',
                            'Investment structuring strategies',
                        ],
                    ],
                    [
                        'title' => 'Capital Gains Tax Planning',
                        'description' => 'Specialist guidance regarding:',
                        'items' => [
                            'Property transactions',
                            'Investment asset disposals',
                            'CGT concessions',
                            'Long-term tax planning considerations',
                        ],
                    ],
                    [
                        'title' => 'Cryptocurrency Tax Reporting',
                        'description' => 'Support managing increasingly complex digital asset taxation obligations.',
                    ],
                    [
                        'title' => 'Foreign Income Reporting',
                        'description' => 'Cross-border taxation guidance and reporting obligations.',
                    ],
                ],
            ],
        ]);
    }
}
