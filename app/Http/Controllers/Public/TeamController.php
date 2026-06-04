<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Services\SeoService;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function __construct(protected SeoService $seo) {}

    public function index(): View
    {
        return view('public.team.index', [
            'seo' => $this->seo->meta('Our Team', 'Meet the experienced accountants and advisors at Canberra Accountants.'),
            'members' => TeamMember::published()->orderBy('sort_order')->get(),
        ]);
    }

    public function show(TeamMember $teamMember): View
    {
        abort_unless($teamMember->is_published, 404);

        return view('public.team.show', [
            'seo' => $this->seo->meta($teamMember->name, strip_tags(substr($teamMember->biography ?? '', 0, 160))),
            'member' => $teamMember,
        ]);
    }
}
