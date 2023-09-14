<?php

namespace App\Rules;

use App\Models\LoyalCustomer;
use Illuminate\Contracts\Validation\Rule;

class CheckPass implements Rule
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
        $pass = bcrypt($value);
        return LoyalCustomer::where('password', $pass)->exists();
    }

    public function message()
    {
        return 'Password không tồn tại trong hệ thống.';
    }
}
