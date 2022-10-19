<?php

use App\Models\Product;
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
        $new_product = new Product();
        $new_product->restaurant_id = 1;
        $new_product->name = 'Pizza Margherita';
        $new_product->description = 'Pizza super buona';
        $new_product->price = 10.2;
        $new_product->image = 'products_image/placeholder.png';
        $new_product->is_visible = 0;
        $new_product->save();
    }
}
