<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $filter = $request->query('search');
        if($filter){

            
            $categories = Category::where('label', 'LIKE', "%$filter%")->get();
            $restaurants = [];
            $restaurants_ids = [];
            foreach($categories as $category){
                
                foreach($category->restaurants as $restaurant){

                    if(!in_array($restaurant->id, $restaurants_ids)) {
                        $restaurants[] = $restaurant;
                        $restaurant->pivot = $restaurant->categories;
                        $restaurants_ids[] = $restaurant->id;
                    }
                };
            }
            
            return response()->json($restaurants);
        };
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::with(['categories', 'products'])->find($id);
        if(!$restaurant) return response('Not Found', 404);
        
        return response()->json($restaurant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
