<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCaptache implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // dd(trim($value), session('captache'), session()->all());
        if (trim($value) != session('captache')) {
            $fail(__('contact.message.error_captache_invalid'));
        }
    }
}
