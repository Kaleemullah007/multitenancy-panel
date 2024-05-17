<?php

namespace App\Models;

use App\Enum\TemplateType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];


    // show email or sms instead of 0,1
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

    // setting user type to string before saving into the database table
    protected  function userType(): Attribute
    {

        return Attribute::make(
            get: null,
            set: fn (mixed $value) => $value ? implode(',', $value) : null,
        );
    }

    // public function setUserTypeattributes($value)
    // {

    //     return $this->attributes['user_type'] = implode(',', $value);
    // }
}
