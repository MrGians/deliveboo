<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
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
            'cartOrder' => 'required|array|min:1'
        ]);
        
        $data = $request->all();

        // Calculate Cart Total Amount
        $cart_amount = 0;
        foreach($request->cartOrder as $cart_product){
            $product = Product::find($cart_product['id']);

            $cart_amount += $product->price * $cart_product['quantity'];
        };
        $cart_amount = round($cart_amount, 2);

        // Saving Products IDs & Products Quantity from Cart Order
        $cart_products_ids = [];
        $cart_products_quantity = [];
        foreach($request->cartOrder as $cart_product){
            $cart_products_ids[] = $cart_product['id'];
            $cart_products_quantity[] = $cart_product['quantity'];
        };
        
        // Checks the correspondence of the restaurant to the products and save it
        $order_restaurant_id = Product::select('restaurant_id')->whereIn('id', $cart_products_ids)->groupBy('restaurant_id')->get();
        $order_restaurant_id = $order_restaurant_id[0]['restaurant_id'];
        

        // Config Braintree Gateway
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'v3t2hg846dk826w5',
            'publicKey' => 'njvyr2jwfwgqwdmg',
            'privateKey' => '0ede10ba7ddefe1dcdeebf320b5157bc'

        ]);

        // Make a Transaction
        $result = $gateway->transaction()->sale([
            'amount' => $cart_amount,
            'paymentMethodNonce' => $data['paymentMethodNonce'],
            'options' => [
            'submitForSettlement' => true,
            ],
        ]);

        
        // Create New Order
        $new_order = new Order();
        $new_order->restaurant_id = $order_restaurant_id;
        $new_order->amount = $cart_amount;
        if($result->success) $new_order->status = 'In elaborazione';
        $new_order->full_name = $data['name'];
        $new_order->email = $data['email'];
        $new_order->address = $data['address'];
        $new_order->tel = $data['tel'];
        $new_order->save();
  
        // Inserting the products of this order in the pivot table (order_product)
        for($i = 0; $i <= count($cart_products_ids) - 1; $i++){
            $new_order->products()->attach($cart_products_ids[$i], ['quantity' => $cart_products_quantity[$i]]);
        };

        // Response feedback
        $order_feedback = ['success' => false, 'message' => 'Transazione Fallita.'];
        if($result->success){
            $order_feedback = ['success' => true, 'message' => 'Transazione eseguita con successo.'];
        };

        return response()->json($order_feedback, 200);

    }
}
