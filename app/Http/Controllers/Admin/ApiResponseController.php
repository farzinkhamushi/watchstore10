<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiResponseController extends Controller
{
    public function getResponse()
    {
        return response()->json([
            "status" => 1,
            "status_code" => 200,
            "amount" => 10000,
            "currency" => "IRR",
            "order_id" => "123456",
            "callback_url" => "https://yourwebsite.com/callback",
            "token" => "abc123",
            "payment_url" => "https://paymentgateway.com/redirect?token=abc123"
        ]);
    }
}

