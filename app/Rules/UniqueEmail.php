<?php

namespace App\Rules;

use App\Models\LoyalCustomer;
use Illuminate\Contracts\Validation\Rule;

class UniqueEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !LoyalCustomer::where('email', $value)->exists();
    }

    public function message()
    {
        return 'Email đã tồn tại trong hệ thống.';
    }
}
