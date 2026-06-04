<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class SmsfServiceContentSeeder extends Seeder
{
    public function run(): void
    {
        Service::where('slug', 'self-managed-super-funds-smsf')->update([
            'short_description' => 'Greater Control. Strategic Retirement Planning.',
            'overview' => "Self-Managed Super Funds provide flexibility and control over retirement investments but require careful governance and compliance management.\n\nOur SMSF specialists provide end-to-end support across the entire SMSF lifecycle.",
            'benefits' => [
                'heading' => 'Our SMSF Services',
                'intro' => null,
                'items' => [
                    [
                        'title' => 'SMSF Establishment',
                        'description' => 'We assist with:',
                        'items' => [
                            'SMSF structure establishment',
                            'Trustee arrangements',
                            'Trust deed preparation',
                            'ABN and TFN registrations',
                            'Investment strategy considerations',
                        ],
                    ],
                    [
                        'title' => 'SMSF Administration',
                        'description' => 'Our administration solutions include:',
                        'items' => [
                            'Annual financial statements',
                            'Member reporting',
                            'Contribution monitoring',
                            'Pension administration',
                            'Regulatory compliance management',
                        ],
                    ],
                    [
                        'title' => 'SMSF Taxation',
                        'description' => 'Specialist support regarding:',
                        'items' => [
                            'Annual SMSF tax returns',
                            'Contribution cap monitoring',
                            'Pension tax management',
                            'Transfer balance cap considerations',
                        ],
                    ],
                    [
                        'title' => 'SMSF Compliance & Audit Coordination',
                        'description' => 'We coordinate:',
                        'items' => [
                            'Independent audit requirements',
                            'Compliance documentation',
                            'Annual reporting obligations',
                        ],
                    ],
                    [
                        'title' => 'SMSF Strategic Advisory',
                        'description' => 'Advice regarding:',
                        'items' => [
                            'Retirement planning strategies',
                            'Contribution optimisation',
                            'Wealth preservation considerations',
                            'Long-term investment planning',
                        ],
                    ],
                ],
            ],
        ]);
    }
}
