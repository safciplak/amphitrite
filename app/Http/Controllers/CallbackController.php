<?php

namespace App\Http\Controllers;

class CallbackController extends Controller
{
    /**
     * Callback Url.
     *
     * @return string
     */
    public function callbackUrl()
    {
        logger('recieved a post request now..');
        logger(request()->all());

        return "some json response";
    }
}
