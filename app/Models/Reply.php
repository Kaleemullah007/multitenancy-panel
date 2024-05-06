<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(contact::class, 'receiver_id', 'id');
    }
}