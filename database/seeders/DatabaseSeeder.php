<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use App\Models\Company;
use App\Models\OfficeLocation;
use App\Models\Role;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\TimelineEvent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'slug' => UserRole::SuperAdmin->value],
            ['name' => 'Admin', 'slug' => UserRole::Admin->value],
            ['name' => 'Editor', 'slug' => UserRole::Editor->value],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], $role);
        }

        $superAdminRole = Role::where('slug', UserRole::SuperAdmin->value)->first();

        User::firstOrCreate(
            ['email' => 'admin@canberraaccountants.com.au'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('ChangeMe123!'),
                'role_id' => $superAdminRole->id,
                'is_active' => true,
            ]
        );

        $settings = [
            'site_name' => 'Canberra Accountants',
            'phone' => '(02) 6190 6075',
            'email' => 'info@canberraaccountants.com.au',
            'website_url' => 'https://www.canberraaccountants.com.au',
            'abn' => '76 676 815 080',
            'crn' => '577972',
            'tax_agent' => '26258136',
            'seo_default_title' => 'Canberra Accountants | Accounting & Tax Advisory',
            'seo_default_description' => 'Premium accounting, taxation, SMSF and business advisory services across Canberra, Sydney, Hobart, Adelaide and Australia-wide.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value, 'general');
        }

        $offices = [
            ['state' => 'Australian Capital Territory', 'address' => "Unit 12/3 Barrier Street\nFyshwick ACT 2609", 'postcode' => '2609', 'sort_order' => 1],
            ['state' => 'New South Wales', 'address' => "3/39 Marion Street\nParramatta NSW 2144", 'postcode' => '2144', 'sort_order' => 2],
            ['state' => 'Tasmania', 'address' => "Level 1/221 Liverpool Street\nHobart TAS 7000", 'postcode' => '7000', 'sort_order' => 3],
            ['state' => 'South Australia', 'address' => "5/198 Tapleys Hill Road\nSeaton SA 5023", 'postcode' => '5023', 'sort_order' => 4],
        ];

        foreach ($offices as $office) {
            OfficeLocation::firstOrCreate(['state' => $office['state']], $office);
        }

        $servicesData = [
            [
                'title' => 'Taxation Advisory & Compliance',
                'slug' => 'taxation-advisory-compliance',
                'short_description' => 'Expert tax compliance and strategic advisory for individuals and businesses.',
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
                'process_steps' => [
                    ['title' => 'Assessment', 'description' => 'Review your current tax position and obligations.'],
                    ['title' => 'Strategy', 'description' => 'Develop a tailored compliance and planning approach.'],
                    ['title' => 'Implementation', 'description' => 'Execute and lodge with ongoing support.'],
                ],
                'faqs' => [
                    ['question' => 'Who needs tax advisory services?', 'answer' => 'Individuals, sole traders, companies and trusts with Australian tax obligations.'],
                ],
                'sort_order' => 1,
            ],
            [
                'title' => 'Self-Managed Super Funds (SMSF)',
                'slug' => 'self-managed-super-funds-smsf',
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
                'process_steps' => [
                    ['title' => 'Establishment', 'description' => 'Set up your fund structure correctly from day one.'],
                    ['title' => 'Ongoing Administration', 'description' => 'Annual accounts, tax returns, member reporting and compliance.'],
                    ['title' => 'Strategic Review', 'description' => 'Ongoing advisory to optimise contributions, pensions and investment strategy.'],
                ],
                'faqs' => [],
                'sort_order' => 2,
            ],
            [
                'title' => 'Business Advisory & Growth Advisory',
                'slug' => 'business-advisory-growth-strategy',
                'short_description' => 'Helping Your Business Grow with Confidence',
                'overview' => "Successful businesses require more than day-to-day management. They need clear financial insight, strategic planning, and expert guidance to achieve sustainable growth.\n\nOur Business Advisory & Growth Advisory services help business owners improve performance, increase profitability, manage risks, and identify new opportunities. We work closely with businesses at every stage, providing practical advice tailored to their goals.",
                'benefits' => BusinessAdvisoryServiceContentSeeder::benefits(),
                'process_steps' => [],
                'faqs' => [],
                'sort_order' => 3,
            ],
            [
                'title' => 'Accounting & Financial Reporting',
                'slug' => 'accounting-financial-reporting',
                'short_description' => 'Accurate Financial Information for Better Business Decisions',
                'overview' => "Effective accounting and financial reporting are essential for managing a successful business. Timely and accurate financial information helps business owners understand performance, meet compliance requirements, and make informed decisions.\n\nOur Accounting & Financial Reporting services provide reliable financial records, meaningful insights, and professional support to help your business stay on track and achieve its goals.",
                'benefits' => AccountingFinancialReportingServiceContentSeeder::benefits(),
                'process_steps' => [],
                'faqs' => [],
                'sort_order' => 4,
            ],
            [
                'title' => 'Business Structuring & Asset Protection',
                'slug' => 'business-structuring-asset-protection',
                'short_description' => 'Building the Right Structure for Long-Term Success',
                'overview' => "Choosing the right business structure is one of the most important decisions for any business owner. An effective structure can improve tax efficiency, support growth, protect personal assets, and reduce future risks.\n\nOur Business Structuring & Asset Protection services help individuals, families, and businesses establish structures that align with their financial goals while safeguarding valuable assets.",
                'benefits' => BusinessStructuringServiceContentSeeder::benefits(),
                'process_steps' => [],
                'faqs' => [],
                'sort_order' => 5,
            ],
            [
                'title' => 'Tax Planning & Wealth Strategies',
                'slug' => 'tax-planning-wealth-strategies',
                'short_description' => 'Maximising Wealth Through Strategic Tax Planning',
                'overview' => "Effective tax planning is about more than simply meeting compliance obligations—it is about creating opportunities to grow, protect, and preserve your wealth. With the right strategies in place, individuals, families, and businesses can improve tax efficiency while working towards their long-term financial goals.\n\nOur Tax Planning & Wealth Strategies services provide proactive, tailored advice designed to minimise tax liabilities, optimise financial outcomes, and support sustainable wealth creation.",
                'benefits' => TaxPlanningWealthServiceContentSeeder::benefits(),
                'process_steps' => [],
                'faqs' => [],
                'sort_order' => 6,
            ],
        ];

        foreach ($servicesData as $data) {
            Service::updateOrCreate(['slug' => $data['slug']], array_merge($data, ['is_published' => true, 'show_in_nav' => true]));
        }

        TeamMember::updateOrCreate(
            ['slug' => 'james-mitchell'],
            [
                'name' => 'James Mitchell',
                'designation' => 'Managing Director',
                'qualifications' => 'CPA, BCom',
                'biography' => 'James leads Canberra Accountants with over 20 years of experience in taxation and business advisory across Australia.',
                'email' => 'james@canberraaccountants.com.au',
                'is_featured' => true,
                'is_leadership' => true,
                'sort_order' => 1,
            ]
        );

        TeamMember::updateOrCreate(
            ['slug' => 'sarah-chen'],
            [
                'name' => 'Sarah Chen',
                'designation' => 'Senior Tax Advisor',
                'qualifications' => 'CA, MTax',
                'biography' => 'Sarah specialises in complex tax planning and SMSF compliance for professional clients.',
                'is_featured' => true,
                'is_leadership' => true,
                'sort_order' => 2,
            ]
        );

        $category = ArticleCategory::firstOrCreate(
            ['slug' => 'tax-insights'],
            ['name' => 'Tax Insights', 'description' => 'Latest taxation news and strategies.']
        );

        $tag = ArticleTag::firstOrCreate(['slug' => 'tax-planning'], ['name' => 'Tax Planning']);

        $admin = User::first();
        $article = Article::updateOrCreate(
            ['slug' => 'year-end-tax-planning-tips'],
            [
                'article_category_id' => $category->id,
                'author_id' => $admin->id,
                'title' => 'Year-End Tax Planning Tips for Australian Businesses',
                'excerpt' => 'Essential strategies to optimise your tax position before 30 June.',
                'content' => '<p>As the financial year draws to a close, proactive tax planning can deliver significant savings for Australian businesses.</p><p>Review your deductions, consider asset purchases, and speak with your advisor about trust distributions.</p>',
                'meta_title' => 'Year-End Tax Planning Tips',
                'meta_description' => 'Expert year-end tax planning advice for Australian businesses.',
                'published_at' => now()->subDays(3),
                'is_published' => true,
                'is_featured' => true,
            ]
        );
        $article->tags()->sync([$tag->id]);

        Company::updateOrCreate(
            ['slug' => 'canberra-accountants-group'],
            ['name' => 'Canberra Accountants Group', 'description' => 'The flagship accounting practice of our national group.', 'sort_order' => 1]
        );

        Testimonial::firstOrCreate(
            ['client_name' => 'Michael Roberts'],
            [
                'client_title' => 'CEO',
                'company' => 'Roberts Holdings',
                'content' => 'Canberra Accountants transformed our tax strategy and provided exceptional advisory support during our expansion.',
                'rating' => 5,
                'sort_order' => 1,
            ]
        );

        TimelineEvent::firstOrCreate(
            ['year' => '2010', 'title' => 'Foundation'],
            ['description' => 'Canberra Accountants established in the Australian Capital Territory.', 'sort_order' => 1]
        );

        TimelineEvent::firstOrCreate(
            ['year' => '2018', 'title' => 'National Expansion'],
            ['description' => 'Opened offices in Sydney, Hobart and Adelaide.', 'sort_order' => 2]
        );
    }
}
