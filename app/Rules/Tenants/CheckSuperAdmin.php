<?php

namespace App\Rules\Tenants;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckSuperAdmin implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $users = User::whereHas("roles", function ($q) {
            $q->Where(function ($query) {
                $query->whereIn("name", ['SuperAdmin']);
            });
        })->count();
        if (in_array('SuperAdmin', $value) && $users > 0) {
            $fail('The SuperAdmin can not more than one.');
        }
    }
}
