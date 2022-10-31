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
            'token' => 'required',
            'amount' => 'required|numeric|min:0.01',
        ], [
            'token.required' => 'Il Token è obbligatorio',
            'amount.required' => 'Il totale è obbligatorio',
            'amount.numeric' => 'Il totale deve essere un numero',
            'amount.min' => 'Il totale non può essere inferiore a :min',
        ]);

        // Config Braintree Gateway
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'v3t2hg846dk826w5',
            'publicKey' => 'njvyr2jwfwgqwdmg',
            'privateKey' => '0ede10ba7ddefe1dcdeebf320b5157bc'

        ]);

        // Make a Transaction
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->token,
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
