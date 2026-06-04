@extends('layouts.admin')

@section('title', $member->exists ? 'Edit Team Member' : 'Add Team Member')

@section('content')
<div class="max-w-2xl relative z-10" x-data="teamPhotoForm()">
    <h1 class="text-2xl font-semibold text-navy-900 mb-6">@yield('title')</h1>

    <form
        method="POST"
        action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}"
        enctype="multipart/form-data"
        class="bg-white rounded-xl shadow-sm p-6 sm:p-8 space-y-5"
    >
        @csrf
        @if($member->exists) @method('PUT') @endif

        {{-- Profile photo --}}
        <div>
            <label class="block text-sm font-medium text-navy-900 mb-2">Profile photo</label>
            <div class="flex flex-col sm:flex-row gap-6 items-start">
                <div class="shrink-0">
                    <div class="w-32 h-32 rounded-xl border-2 border-dashed border-slate-300 overflow-hidden bg-slate-50 flex items-center justify-center">
                        <img
                            x-show="photoPreview || existingPhoto"
                            :src="photoPreview || existingPhoto"
                            alt="Profile preview"
                            class="w-full h-full object-cover"
                        >
                        <span x-show="!photoPreview && !existingPhoto" class="text-slate-400 text-xs text-center px-2">No photo</span>
                    </div>
                </div>
                <div class="flex-1 w-full">
                    <input
                        type="file"
                        name="photo"
                        accept="image/jpeg,image/png,image/webp"
                        @change="previewPhoto($event)"
                        class="w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-navy-900 file:text-white file:cursor-pointer"
                    >
                    <p class="mt-2 text-xs text-slate-500">JPG, PNG or WebP. Max 2MB. Recommended: square image, at least 400×400px.</p>
                    @error('photo')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-navy-900 mb-1">Name <span class="text-red-500">*</span></label>
            <input id="name" name="name" value="{{ old('name', $member->name) }}" required class="w-full rounded-lg border-slate-300">
            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="designation" class="block text-sm font-medium text-navy-900 mb-1">Designation <span class="text-red-500">*</span></label>
            <input id="designation" name="designation" value="{{ old('designation', $member->designation) }}" required class="w-full rounded-lg border-slate-300" placeholder="e.g. Senior Tax Advisor">
            @error('designation')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="biography" class="block text-sm font-medium text-navy-900 mb-1">Biography</label>
            <textarea id="biography" name="biography" rows="4" class="w-full rounded-lg border-slate-300">{{ old('biography', $member->biography) }}</textarea>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label for="email" class="block text-sm font-medium text-navy-900 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $member->email) }}" class="w-full rounded-lg border-slate-300">
            </div>
            <div>
                <label for="linkedin_url" class="block text-sm font-medium text-navy-900 mb-1">LinkedIn URL</label>
                <input id="linkedin_url" type="url" name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url) }}" class="w-full rounded-lg border-slate-300">
            </div>
        </div>

        <div class="flex flex-wrap gap-4 text-sm">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $member->is_featured)) class="rounded text-navy-900">
                Featured on homepage
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_leadership" value="1" @checked(old('is_leadership', $member->is_leadership)) class="rounded text-navy-900">
                Leadership team
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $member->is_published ?? true)) class="rounded text-navy-900">
                Published
            </label>
        </div>

        <div class="pt-2 flex flex-wrap items-center gap-3">
            <button type="submit" class="px-8 py-3 bg-navy-900 text-white font-semibold rounded-lg hover:bg-navy-800 cursor-pointer">Save</button>
            <a href="{{ route('admin.team.index') }}" class="px-6 py-3 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">Cancel</a>
        </div>
    </form>

    @if($member->exists)
    <form
        action="{{ route('admin.team.destroy', $member) }}"
        method="POST"
        class="mt-4 flex justify-end"
        onsubmit="return confirm('Delete this team member permanently?')"
    >
        @csrf
        @method('DELETE')
        <button type="submit" class="admin-btn-delete px-6 py-3 text-sm">Delete Team Member</button>
    </form>
    @endif
</div>

<script>
function teamPhotoForm() {
    return {
        photoPreview: null,
        existingPhoto: @json($member->photo_url),
        previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                this.photoPreview = URL.createObjectURL(file);
            }
        }
    };
}
</script>
@endsection
