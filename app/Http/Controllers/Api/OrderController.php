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

    public function makePayment(Request $request)
    {
        // Validating payment request
        $request->validate([
            'paymentMethodNonce' => 'required',
            'name' => 'required|string',
            'address' => 'required|string',
            'tel' => 'required|string|size:9',
            'email' => 'required|email',
        ]);

        $data = $request->all();
        // TODO Create order here

        
        // TODO Make transaction 
        // Config Braintree Gateway
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'v3t2hg846dk826w5',
            'publicKey' => 'njvyr2jwfwgqwdmg',
            'privateKey' => '0ede10ba7ddefe1dcdeebf320b5157bc'

        ]);

        // Make a Transaction
        $result = $gateway->transaction()->sale([
            'amount' => $data['amount'],
            'paymentMethodNonce' => $data['paymentMethodNonce'],
            'options' => [
            'submitForSettlement' => true,
            ],
        ]);

        // Manages transaction's response
        if($result->success){
            $data = [
                'success' => true,
                'message' => 'Transazione eseguita con successo'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => 'Transazione Fallita'
            ];
            
            return response()->json($data, 401);
        }
    }
}
