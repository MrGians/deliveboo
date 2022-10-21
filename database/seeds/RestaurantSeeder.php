<?php

use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\User;
use Faker\Generator as Faker;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Get from DB ids array of categories
        $category_ids = Category::pluck('id')->toArray();
        // Get from DB ids array of users
        $user_ids = User::pluck('id')->toArray();

        foreach(config('data.restaurants') as $key => $restaurant){
            $new_restaurant = new Restaurant();

            // Assign user to each restaurant
            $new_restaurant->user_id = $user_ids[$key];

            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->description = $restaurant['description'];
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->logo = $restaurant['logo'];
            $new_restaurant->p_iva = $restaurant['p_iva'];
            $new_restaurant->save();

            // Randomize relation category-restaurant with Faker
            // Max categories for each restaurant: 5
            $restaurant_category_ids = [];
            foreach($category_ids as $category_id){
    
                if(count($restaurant_category_ids) < 5){
                    if($faker->boolean()) $restaurant_category_ids[] = $category_id; 
                }
            };
            $new_restaurant->categories()->attach([$restaurant_category_ids]);
        }
    }

}
