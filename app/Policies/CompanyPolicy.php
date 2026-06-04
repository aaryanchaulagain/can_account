<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Company;
use App\Models\User;

class CompanyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->canAccessAdmin();
    }

    public function create(User $user): bool
    {
        return $user->canAccessAdmin();
    }

    public function update(User $user, Company $company): bool
    {
        return $user->canAccessAdmin();
    }

    public function delete(User $user, Company $company): bool
    {
        return $user->hasRole(UserRole::SuperAdmin) || $user->hasRole(UserRole::Admin);
    }
}
