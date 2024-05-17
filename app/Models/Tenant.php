<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, SoftDeletes;



    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'password',
            'status',
            'user_id',


        ];
    }

    // Casting user password to hash before saving into the database
    protected function password(): Attribute
    {
        return Attribute::make(
            get: null,
            set: fn (string $value) => Hash::make($value),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // User plan history
    public function planHistory(): HasMany
    {
        return $this->hasMany(PlanHistory::class, 'user_id', 'user_id');
    }
}
