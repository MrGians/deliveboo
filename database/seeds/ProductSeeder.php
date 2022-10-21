<?php

use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Get from DB ids array of restaurant
        $restaurant_ids = Restaurant::pluck('id')->toArray();

        // For every restaurant on DB insert products
        foreach($restaurant_ids as $restaurant_id){

            foreach(config('data.products') as $product){

                $new_product = new Product();
                // Assign reference Restaurant to each Product
                $new_product->restaurant_id = $restaurant_id;

                $new_product->name = $product['name'];
                $new_product->description = $product['description'];
                $new_product->price = $product['price'];
                $new_product->image = $product['image'];
                $new_product->is_visible = rand(0,1);
                $new_product->save();

            }
        }


    }
}
