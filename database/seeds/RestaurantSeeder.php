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
        $new_restaurant->user_id = 1;
        $new_restaurant->name = 'Pizzeria del team 1';
        $new_restaurant->description = 'Facciamo delle pizze veramente molto buone';
        $new_restaurant->address = 'Via del Team, N.1';
        $new_restaurant->logo = '';
        $new_restaurant->p_iva = '12345678901';
        $new_restaurant->save();
    }
}
