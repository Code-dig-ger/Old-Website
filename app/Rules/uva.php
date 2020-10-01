<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class uva implements Rule
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
        $response = $client->request('GET', 'https://uhunt.onlinejudge.org/api/uname2uid/'. $value);
        $id = strval($response->getBody());
        if($id == "0")
            return 0;
        else
            return 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please Enter a Valid UVA Handle.';
    }
}
