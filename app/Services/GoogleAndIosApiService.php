<?php

namespace App\Services;

use Exception;

class GoogleAndIosApiService
{
    /**
     * Request.
     *
     * @param $receipt
     */
    public static function request($receipt)
    {
        $receiptLastCharacter = substr($receipt, -2);

        if ($receiptLastCharacter % 6 == 0) {
            throw new Exception("Rate Limit Error");
            logger("It seems divided by 6");
        }
    }
}
