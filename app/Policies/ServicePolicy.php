<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->canAccessAdmin();
    }

    public function create(User $user): bool
    {
        return $user->hasRole(UserRole::SuperAdmin) || $user->hasRole(UserRole::Admin);
    }

    public function update(User $user, Service $service): bool
    {
        return $user->hasRole(UserRole::SuperAdmin) || $user->hasRole(UserRole::Admin);
    }

    public function delete(User $user, Service $service): bool
    {
        return $user->hasRole(UserRole::SuperAdmin);
    }
}
