<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        $members = TeamMember::orderBy('sort_order')->paginate(15);

        return view('admin.team.index', compact('members'));
    }

    public function create(): View
    {
        return view('admin.team.form', ['member' => new TeamMember]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_leadership'] = $request->boolean('is_leadership');
        $data['is_published'] = $request->boolean('is_published');
        $data['slug'] = Str::slug($data['slug'] ?? $data['name']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }
        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member created.');
    }

    public function edit(TeamMember $team): View
    {
        return view('admin.team.form', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_leadership'] = $request->boolean('is_leadership');
        $data['is_published'] = $request->boolean('is_published');
        if ($request->hasFile('photo')) {
            if ($team->photo) {
                Storage::disk('public')->delete($team->photo);
            }
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }
        $team->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team): RedirectResponse
    {
        $this->authorize('delete', $team);
        if ($team->photo) {
            Storage::disk('public')->delete($team->photo);
        }
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Team member deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'qualifications' => ['nullable', 'string'],
            'biography' => ['nullable', 'string'],
            'linkedin_url' => ['nullable', 'url'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'is_leadership' => ['boolean'],
            'sort_order' => ['integer'],
            'is_published' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
