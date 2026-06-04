<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->canAccessAdmin();
    }

    public function view(User $user, Article $article): bool
    {
        return $user->canAccessAdmin();
    }

    public function create(User $user): bool
    {
        return $user->canAccessAdmin();
    }

    public function update(User $user, Article $article): bool
    {
        return $user->canAccessAdmin();
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->hasRole(UserRole::SuperAdmin) || $user->hasRole(UserRole::Admin);
    }
}
