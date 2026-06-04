<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = [
        'form_type', 'name', 'email', 'phone', 'company', 'service_interested', 'message', 'form_data',
        'ip_address', 'user_agent', 'status', 'read_at', 'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'approved_at' => 'datetime',
            'form_data' => 'array',
        ];
    }

    public function scopeFilter(Builder $query, ?string $status): Builder
    {
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        return $query;
    }

    public function scopeFormType(Builder $query, string $type): Builder
    {
        return $query->where('form_type', $type);
    }

    public function adminListUrl(): string
    {
        return match ($this->form_type) {
            'tax_return' => route('admin.tax-returns.index'),
            'business' => route('admin.business-forms.index'),
            default => route('admin.contacts.index'),
        };
    }

    public function adminListLabel(): string
    {
        return match ($this->form_type) {
            'tax_return' => 'Tax Return Submissions',
            'business' => 'Business Form Submissions',
            default => 'Contact Messages',
        };
    }

    public function markAsRead(): void
    {
        if ($this->status === 'new') {
            $this->update([
                'status' => 'read',
                'read_at' => now(),
            ]);
        }
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function formTypeLabel(): string
    {
        return match ($this->form_type) {
            'tax_return' => 'Tax Return Form',
            'business' => 'Business Form',
            default => 'Contact Form',
        };
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'new' => 'New',
            'read' => 'Read',
            'approved' => 'Approved',
            'replied' => 'Replied',
            'archived' => 'Archived',
            default => ucfirst($this->status),
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'new' => 'bg-blue-100 text-blue-800',
            'approved' => 'bg-green-100 text-green-800',
            'read' => 'bg-slate-100 text-slate-700',
            'archived' => 'bg-amber-100 text-amber-800',
            default => 'bg-slate-100 text-slate-700',
        };
    }
}
