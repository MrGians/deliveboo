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

            for($i = 1; $i < 15; $i++){
                
                // Taking all the products from the restaurant
                $restaurant_products = Product::where('id', $restaurant_id)->get();
                // Initializing the array that will contain the products of the order
                $order_products = [];

                foreach($restaurant_products as $product){
                    // Randomly entering the products and quantities
                    if($faker->boolean()) {
                        $order_products[] = $product;
                        $product->quantity = rand(0,1) ? 1 : $faker->randomNumber(2, false);
                }
            }

            // Generating Total Amount of the order
            $total_amount = 0;
            foreach($order_products as $product){
                $price = $product->price;
                $quantity = $product->quantity;

                $total_amount += $product->sum($price, $quantity);
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
            $new_order->products()->attach($order_products);
            }
        }

        
    }
}
