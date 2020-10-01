<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Spoj implements Rule
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
        $client = new \Goutte\Client();
        $userPage = 'https://www.spoj.com/users/'.$value;
        $crawler = $client->request('GET', $userPage);
        if(count($crawler->filter('#user-profile-left')) > 0)
            return 1;
        else
            return 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please Enter a Valid Spoj Handle.';
    }
}
