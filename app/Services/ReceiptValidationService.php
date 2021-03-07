<?php

namespace App\Services;

use App\Http\Requests\PurchaseRequest;
use App\Models\Device;
use Carbon\Carbon;

class ReceiptValidationService
{
    const STATUS_OK = 1;
    const STATUS_NOT_OK = 0;

    const NOT_OK = 'NOT OK';
    const OK = 'OK';

    /**
     * Purchase.
     *
     * @param PurchaseRequest $request
     */
    public static function purchase(PurchaseRequest $request)
    {
        $receipt = $request->input('receipt');
        $receiptLastCharacter = substr($receipt, -1);

        $message = self::NOT_OK;
        $status = self::STATUS_NOT_OK;
        if ($receiptLastCharacter % 2 == 1) {
            $message = self::OK;
            $status = self::STATUS_OK;
        }

        $device = Device::where('client_token', $request->input('client_token'))->first();
        $device->subscription_status = $status;
        $device->save();

        $data = new \stdClass();
        $data->status = $status;
        $data->message = $message;
        $data->expire_date = Carbon::now()->subHour(6)->format('Y-m-d H:i:s');

        return $data;
    }
}
