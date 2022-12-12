<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserCompletedRegistration implements Rule
{
    protected $email;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
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
        /** Check Exist && User Completed Registration*/
        $user = User::with('userDetail')->where('email', $value)->first();
        if ($user && !empty($user->userDetail)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('こちらのメールアドレスはユーザー情報登録が完了されました。別のメールアドレスでご登録お願いします。');
    }
}
