<?php

namespace App\Models;

use App\Enum\TemplateType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    // Casting 0,1 to string for showing email or sms
    protected function casts(): array
    {
        return [
            'template_type' => TemplateType::class,
        ];
    }

    //  show only active email templates
    protected function scopeActive()
    {
        return $this->where('status', 1);
    }
}
