<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super-admin';
    case Admin = 'admin';
    case Editor = 'editor';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::Admin => 'Admin',
            self::Editor => 'Editor',
        };
    }

    public function canManageUsers(): bool
    {
        return $this === self::SuperAdmin;
    }

    public function canManageSettings(): bool
    {
        return in_array($this, [self::SuperAdmin, self::Admin], true);
    }

    public function canDelete(): bool
    {
        return in_array($this, [self::SuperAdmin, self::Admin], true);
    }
}
