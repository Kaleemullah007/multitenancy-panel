<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'plan_id',
        'plan_name',
        'plan_price',
        'validaty',
        'start_date',
        'end_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function ScopeSuperAdmin()
    {

        return $this->whereNotIn('id', [2, auth()->id()]);
    }

    protected function ScopeExpiredUsers()
    {
        return $this->whereDate('end_date', '<=', now()->format('Y-m-d'))->whereNotNull('end_date')->where('actioned', 0);
    }
    public function tenant(): HasOne
    {
        return $this->hasOne(Tenant::class, 'user_id', 'id');
    }

    //  User Plan
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}