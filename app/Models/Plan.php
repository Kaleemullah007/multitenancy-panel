<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    function ScopeActivePlans()
    {
        return $this->where('status', 1);
    }
}