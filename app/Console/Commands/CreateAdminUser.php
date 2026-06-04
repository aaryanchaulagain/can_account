<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
class CreateAdminUser extends Command
{
    protected $signature = 'admin:create-user
                            {--name= : Full name}
                            {--email= : Email address}
                            {--password= : Password (min 8 chars)}
                            {--role=super-admin : Role slug: super-admin, admin, editor}';

    protected $description = 'Create a new admin panel user';

    public function handle(): int
    {
        $role = Role::where('slug', $this->option('role'))->first();

        if (! $role) {
            $this->error('Role not found. Run: php artisan db:seed');

            return self::FAILURE;
        }

        $name = $this->option('name') ?: $this->ask('Name');
        $email = $this->option('email') ?: $this->ask('Email');
        $password = $this->option('password') ?: $this->secret('Password (min 8 characters)');

        if (strlen($password) < 8) {
            $this->error('Password must be at least 8 characters.');

            return self::FAILURE;
        }

        if (User::where('email', $email)->exists()) {
            $this->error('A user with this email already exists.');

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role_id' => $role->id,
            'is_active' => true,
        ]);

        $this->info('Admin user created successfully.');
        $this->line("Email: {$email}");
        $this->line('Login at: '.url('/admin/login'));

        return self::SUCCESS;
    }
}
