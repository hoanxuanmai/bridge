<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Apis;

use HXM\Bridge\Contract\ApiResponseInterface;
use HXM\Bridge\Facades\Client;

class PaymentInitiation
{
    const BASE_PATH = '/v2/payment-requests';

    /**
     * {
     *  "successful_callback_url": "https://www.google.com?success",
     *  "unsuccessful_callback_url": "https://www.google.com?error",
     *  "transactions": [
     *   {
     *      "currency": "EUR",
     *      "label": "label test",
     *      "amount": 10.5,
     *      "beneficiary": {
     *      "name": "Jean Baptiste" ,
     *      "iban": "FR2310096000301695931368H67"
     *   },
     *      "client_reference": "ABCDE-EEEE_9398848",
     *      "end_to_end_id": "E2E_TEST-123"
     *   }
     *  ],
     *  "user": {
     *      "first_name": "Thomas",
     *      "last_name": "Pichet",
     *      "external_reference": "AEF142536-890"
     *   },
     *   "bank_id": 14
     * }
     * @return ApiResponseInterface
     */
    static public function create($data): ApiResponseInterface
    {
        return Client::post(static::BASE_PATH, ['json' => $data]);
    }
}
