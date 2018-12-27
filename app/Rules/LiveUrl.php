<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class LiveUrl implements Rule
{

    public $message = 'The :attribute url does not exist.';
    public $valueempty = false;
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
    public function passes($attribute, $url)
    {
      if (empty($url) || $this->valueempty) return true;
      // if( ! preg_match('/^http(s)?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $url) ){
      //     return false;
      // }
      // $client = new Client(['http_errors' => false]);
      // $res = $client->request('GET', $url);
      // $status = $res->getStatusCode();
      // return $status === 200;
      return checkurl($url);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    public function checkValueForEmpty($value) {
      $this->valueempty = empty($value);
      return $this;
    }

}
