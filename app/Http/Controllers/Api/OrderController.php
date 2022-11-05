<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Order;
use App\Models\Product;
use App\Mail\CustomerMail;
use App\Mail\RestaurantMail;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Mail;
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
        $cart_order = $request->cartOrder;

        // Calculate Cart Total Amount
        $cart_amount = 0;
        foreach($cart_order as $cart_product){
            $product = Product::find($cart_product['id']);

            $cart_amount += $product->price * $cart_product['quantity'];
        };
        $cart_amount = round($cart_amount, 2);

        // Saving Products IDs & Products Quantity from Cart Order
        $cart_products_ids = [];
        $cart_products_quantity = [];
        foreach($cart_order as $cart_product){
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

            // Sending Email to Restaurant Owner
            $owner_id = Restaurant::select('user_id')->where('id', $order_restaurant_id)->get();
            $restaurant_mail = User::where('id', $owner_id[0]['user_id'])->get();
            $restaurant_mail = $restaurant_mail[0]['email'];
            $mail_to_restaurant = new RestaurantMail($new_order);
            Mail::to($restaurant_mail)->send($mail_to_restaurant);

            // Sending Email to Customer
            $customer_mail = $data['email'];
            $mail_to_customer = new CustomerMail($new_order, $order_restaurant_id);
            Mail::to($customer_mail)->send($mail_to_customer);

        };

        return response()->json($order_feedback, 200);

    }
}
