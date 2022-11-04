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
        $restaurant= Auth::user()->restaurant->id;
        $products = Product::orderBy('name', 'ASC')->where('restaurant_id', $restaurant)->get();

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

        return redirect()->route('admin.products.show', compact('product'))
        ->with('message', 'Il Prodotto è stato creato con successo')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //Check product of other restaurant
        if(Auth::user()->restaurant->id !== $product->restaurant_id){
            $restaurant= Auth::user()->restaurant->id;
            $products = Product::where('restaurant_id', $restaurant)->get();
            return redirect()->route('admin.products.index', compact('products'))->with('message', 'Non puoi accedere ad un prodotto non presente nel tuo menù')->with('type', 'danger');
        };
        
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
        //Check product of other restaurant
        if(Auth::user()->restaurant->id !== $product->restaurant_id){
            $restaurant= Auth::user()->restaurant->id;
            $products = Product::where('restaurant_id', $restaurant)->get();
            return redirect()->route('admin.products.index', compact('products'))
            ->with('message', 'Non puoi accedere ad un prodotto non presente nel tuo menù')->with('type', 'danger');
        };

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
        // Validation
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,jpg,png,svg',
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

        // Check image file
        if(array_key_exists('image', $data)){
            if($product->image !== 'products_image/placeholder.png') Storage::delete($product->image);
            $data['image'] = Storage::put('products_image', $data['image']);
        }

        // Check flag is_visible
        $data['is_visible'] = array_key_exists('is_visible', $data);

        // Update product instance;
        $product->update($data);

        return redirect()->route('admin.products.show', compact('product'))
        ->with('message', 'Il Prodotto è stato modificato con successo')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Check if the product is contained in 1+ orders
        if(count($product->orders)){

            // Checking each order status that contain this product
            foreach($product->orders as $order_item){
                $order_status = ucfirst($order_item->status);
                
                // if order status is "in elaborazione" this product can't be deleted from menù
                if($order_status === "In elaborazione") {
                    $restaurant= Auth::user()->restaurant->id;
                    $products = Product::where('restaurant_id', $restaurant)->get();
                    return redirect()->route('admin.products.index', compact('products'))
                    ->with('message', 'Errore nella cancellazione! Un ordine non ancora completato contiene questo prodotto.')->with('type', 'danger');
                }
            };
        };


        if($product->image !== 'products_image/placeholder.png') Storage::delete($product->image);

        $product->delete();

        return redirect()->route('admin.products.index')
        ->with('message', 'Il prodotto è stato eliminato con successo')->with('type', 'success');
    }

    public function isVisible(Product $product) 
    {
        $product->is_visible = !$product->is_visible;
        $product->save();

        // Changing message to display
        if($product->is_visible) $custom_message = 'Il Prodotto è stato aggiunto al menù';
        else $custom_message = 'Il Prodotto è stato rimosso dal menù';
        
        return redirect()->route('admin.products.index')
        ->with('message', $custom_message)->with('type', 'success');
    }
}
