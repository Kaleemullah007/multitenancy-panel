<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Show replies of each replies
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class, 'receiver_id', 'id');
    }
}
