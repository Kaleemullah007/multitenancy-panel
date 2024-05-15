<?php

namespace App\Models;

use App\Enum\TemplateType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compaign extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected function casts(): array
    {
        return [
            'type' => TemplateType::class,
        ];
    }

    public function emailTemplate(): BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class, 'email_template_id', 'id');
    }


    protected function userType(): Attribute
    {
        return Attribute::make(
            get: null,
            set: fn (array $value) => implode(',', $value),
        );
    }

    // public function setUserTypeattributes($value)
    // {
    //     $this->attributes['user_type'] = implode(',', $value);
    // }
}
