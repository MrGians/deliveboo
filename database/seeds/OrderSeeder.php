<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Get from DB Restaurants IDs
        $restaurant_ids = Restaurant::pluck('id')->toArray();

        // Generating 15 orders for each Restaurant
        foreach($restaurant_ids as $restaurant_id){

            for($i = 1; $i <= 15; $i++){
                
                // Taking all the products from the restaurant
                $restaurant_products_ids = Product::where('restaurant_id', $restaurant_id)->pluck('id')->toArray();
                // Initializing the array that will contain the products of the order
                $order_products_ids = [];
                $products_quantity = [];

                // Randomly entering the products in order
                foreach($restaurant_products_ids as $product_id){
                    if($faker->boolean()) {
                        $order_products_ids[] = $product_id;
                        $products_quantity[] = $faker->randomNumber(1, true);
                    }
                };
                
                // Generating Total Amount of the order
                $total_amount = 0;
                for($i = 0; $i < count($order_products_ids) - 1; $i++){
                    $product = Product::find($order_products_ids[$i]);
                    $quantity = $products_quantity[$i];
                    
                    $total_amount += $product->price * $quantity;
                }


                $new_order = new Order();
                $new_order->restaurant_id = $restaurant_id;
                $new_order->status = rand(0,1) ? 'Pagato / In elaborazione' : 'Completato';
                $new_order->amount = $total_amount;
                $new_order->email = $faker->email();
                $new_order->full_name = "{$faker->firstName()} {$faker->lastName()}";
                $new_order->address = $faker->streetAddress();
                $new_order->tel = $faker->numberBetween(100000000, 999999999);
                $new_order->save();
                
                // Inserting the products of this order in the pivot table (order_product)
                for($i = 0; $i < count($order_products_ids) - 1; $i++){
                    $new_order->products()->attach($order_products_ids[$i], ['quantity' => $products_quantity[$i]]);
                };
            }
        }

    }
}
