<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;

class OrderController extends Controller
{
    public function generateToken(Request $request)
    {
        // Config Braintree Gateway
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'v3t2hg846dk826w5',
            'publicKey' => 'njvyr2jwfwgqwdmg',
            'privateKey' => '0ede10ba7ddefe1dcdeebf320b5157bc'
        ]);

        // Generating Client Token
        $token = $gateway->clientToken()->generate();
        $data = ['token' => $token];

        return response()->json($data, 200);
    }
}
