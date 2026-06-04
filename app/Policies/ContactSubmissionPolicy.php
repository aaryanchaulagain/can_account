<?php

namespace App\Policies;

use App\Models\ContactSubmission;
use App\Models\User;

class ContactSubmissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->canAccessAdmin();
    }

    public function view(User $user, ContactSubmission $submission): bool
    {
        return $user->canAccessAdmin();
    }

    public function update(User $user, ContactSubmission $submission): bool
    {
        return $user->canAccessAdmin();
    }

    public function delete(User $user, ContactSubmission $submission): bool
    {
        return $user->canAccessAdmin();
    }
}
