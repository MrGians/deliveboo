<?php

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = config('data.categories'); 
                    
            foreach ($categories as $category) {
                $new_category = new Category();
                $new_category->id = $category['id'];
                $new_category->label = $category['label'];
                $new_category->save();
            }
    }
}
