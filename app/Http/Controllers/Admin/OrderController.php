<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $restaurant = Auth::user()->restaurant->id;
        $orders = Order::orderBy('created_at', 'DESC')->where('restaurant_id', $restaurant)->get();
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Display the specified resource.
     *
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //Check product of other restaurant
        if(Auth::user()->restaurant->id !== $order->restaurant_id){
            $restaurant = Auth::user()->restaurant->id;
            $orders = Order::where('restaurant_id', $restaurant)->get();
            return view('admin.orders.index', compact('orders'));
        };
        
        return view('admin.orders.show', compact('order'));
    }

    
}
