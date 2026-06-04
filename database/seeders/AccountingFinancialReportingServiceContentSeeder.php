<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class AccountingFinancialReportingServiceContentSeeder extends Seeder
{
    public static function benefits(): array
    {
        return [
            'heading' => 'Our Services',
            'intro' => null,
            'items' => [
                [
                    'title' => 'Bookkeeping & Accounting',
                    'description' => 'We help maintain accurate and up-to-date financial records through:',
                    'items' => [
                        'General bookkeeping services',
                        'Accounts payable and receivable management',
                        'Bank reconciliations',
                        'Payroll support',
                        'Financial record maintenance',
                    ],
                ],
                [
                    'title' => 'Financial Statements Preparation',
                    'description' => 'Our team prepares professional financial reports, including:',
                    'items' => [
                        'Profit & Loss Statements',
                        'Balance Sheets',
                        'Cash Flow Statements',
                        'Management Reports',
                        'Year-End Financial Statements',
                    ],
                ],
                [
                    'title' => 'Management Reporting',
                    'description' => 'Regular reporting helps you monitor business performance and identify opportunities for improvement. We provide:',
                    'items' => [
                        'Monthly and quarterly reporting',
                        'Budget vs actual analysis',
                        'KPI reporting',
                        'Business performance insights',
                        'Financial trend analysis',
                    ],
                ],
                [
                    'title' => 'Budgeting & Forecasting',
                    'description' => 'Plan for the future with confidence through:',
                    'items' => [
                        'Annual budgeting',
                        'Cash flow forecasting',
                        'Financial projections',
                        'Business planning support',
                        'Performance monitoring',
                    ],
                ],
                [
                    'title' => 'Compliance & Reporting',
                    'description' => 'We ensure your financial reporting meets regulatory and compliance requirements, helping reduce risk and maintain transparency.',
                ],
            ],
            'why_choose' => [
                'heading' => 'Why Choose Us?',
                'items' => [
                    [
                        'title' => 'Accurate & Reliable Reporting',
                        'description' => 'We provide clear and accurate financial information you can trust.',
                    ],
                    [
                        'title' => 'Business-Focused Insights',
                        'description' => 'Beyond compliance, we help you understand what your numbers mean and how they impact your business.',
                    ],
                    [
                        'title' => 'Timely Support',
                        'description' => 'Our team delivers reporting and advice when you need it, helping you make confident business decisions.',
                    ],
                ],
            ],
            'industries' => [
                'heading' => 'Industries We Support',
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
                'heading' => 'Stay Informed. Stay Compliant. Grow with Confidence.',
                'description' => 'Whether you need ongoing accounting support, financial reporting, or strategic financial insights, our experienced team is here to help your business succeed. Contact us today to learn how our Accounting & Financial Reporting services can support your business.',
            ],
        ];
    }

    public function run(): void
    {
        Service::where('slug', 'accounting-financial-reporting')->update([
            'title' => 'Accounting & Financial Reporting',
            'short_description' => 'Accurate Financial Information for Better Business Decisions',
            'overview' => "Effective accounting and financial reporting are essential for managing a successful business. Timely and accurate financial information helps business owners understand performance, meet compliance requirements, and make informed decisions.\n\nOur Accounting & Financial Reporting services provide reliable financial records, meaningful insights, and professional support to help your business stay on track and achieve its goals.",
            'benefits' => static::benefits(),
            'process_steps' => [],
            'faqs' => [],
        ]);
    }
}
