<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Exception\RequestException;

class Codeforces implements Rule
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

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', 'https://codeforces.com/api/user.info?handles='. $value);
            return 1;
        } catch (RequestException $e) {
            return 0;
        } 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please Enter a Valid Codeforces Handle.';
    }
}
