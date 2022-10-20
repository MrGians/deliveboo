<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        return view('admin.products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,svg',
        ],[
            'name.required' => 'Il nome del prodotto è obbligatorio',
            'name.string' => 'Il nome del prodotto deve contenere solo caratteri',
            'price.required' => 'Il prezzo del prodotto è obbligatorio',
            'price.numeric' => 'Il prezzo del prodotto deve essere un numero',
            'price.min' => 'Il prezzo del prodotto deve essere almeno di :min',
            'description.required' => 'La descrizione del prodotto è obbligatoria',
            'description.string' => 'La descrizione del prodotto deve contenere solo caratteri',
            'image.required' => 'L\'immagine del prodotto è obbligatoria',
            'image.image' => 'L\'immagine del prodotto deve essere di un\'estensione valida (jpeg,jpg,png,svg)',
            'image.mimes' => 'L\'immagine del prodotto deve essere di un\'estensione valida (jpeg,jpg,png,svg)',
        ]);
        
        $data = $request->all();

        // Set restaurant_id of auth user
        $data['restaurant_id'] = Auth::user()->restaurant->id;

        // Check image file
        if(array_key_exists('image', $data)) $data['image'] = Storage::put('products_image', $data['image']);
        else $data['image'] = 'products_image/placeholder.png';

        // Check flag is_visible
        $data['is_visible'] = array_key_exists('is_visible', $data);

        // Create product instance and fill data
        $product = new Product();
        $product->fill($data);
        $product->save();

        return redirect()->route('admin.products.show', compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image !== 'products_image/placeholder.png') Storage::delete($product->image);

        $product->delete();

        return redirect()->route('admin.products.index');
    }

    public function isVisible(Product $product) 
    {
        $product->is_visible = !$product->is_visible;
        $product->save();
        return redirect()->route('admin.products.index');
    }
}
