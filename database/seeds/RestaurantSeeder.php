<?php

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_restaurant = new Restaurant();
        $category_ids = Category::pluck('id')->toArray();
       
        $new_restaurant->user_id = 1;
        $new_restaurant->name = 'Pizzeria del team 1';
        $new_restaurant->description = 'Facciamo delle pizze veramente molto buone';
        $new_restaurant->address = 'Via del Team, N.1';
        $new_restaurant->logo = 'restaurants_logos/placeholder.png';
        $new_restaurant->p_iva = '12345678901';
        $new_restaurant->save();
        
        $restaurant_category_ids = [];

        foreach($category_ids as $category_id){

            if(count($restaurant_category_ids) < 5){
                if($faker->boolean()) $restaurant_category_ids[] = $category_id; 
            }
        };
        $new_restaurant->categories()->attach([$restaurant_category_ids]);
    }

}
