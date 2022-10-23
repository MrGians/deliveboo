<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Category;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'restaurant_name' => ['required', 'string'],
            'restaurant_address' => ['required', 'string'],
            'restaurant_description' => ['required', 'string'],
            'categories' => ['required', 'exists:categories,id'],
            'restaurant_logo' => ['required', 'image', 'mimes:jpeg,jpg,png,svg'],
            'p_iva' => ['required', 'string','size:11', 'unique:restaurants'],
        ], [
            'name.required' => 'Il nome è obbligatorio',
            'name.string' => 'Il nome deve essere una stringa',
            'name.max' => 'Il nome può contenere massimo :max caratteri',
            'email.required' => 'l\'email è obbligatoria',
            'email.string' => 'l\'email deve essere una stringa',
            'email.email' => 'l\'email deve essere in un formato valido (example@gmail.com)',
            'email.max' => 'l\'email può contenere massimo :max caratteri',
            'email.unique' => 'Questa email è già stata registrata sul sito',
            'password.required' => 'La password è obbligatoria',
            'password.string' => 'La password deve essere un stringa',
            'password.min' => 'La password deve contenere almeno :min caratteri',
            'password.confirmed' => 'La password deve essere confermata',
            'restaurant_name.required' => 'Il nome del ristorante è obbligatorio',
            'restaurant_name.string' => 'Il nome del ristorante deve essere una stringa',
            'restaurant_address.required' => 'L\'indirizzo del ristorante è obbligatorio',
            'restaurant_address.string' => 'L\'indirizzo del ristorante deve essere una stringa',
            'restaurant_description.required' => 'La descrizione del ristorante è obbligatoria',
            'restaurant_description.string' => 'La descrizione del ristorante deve essere una stringa',
            'categories.required' => 'La categoria del ristorante è obbligatoria',
            'categories.exists' => 'La categoria del ristorante deve essere presente tra quelle in lista',
            'restaurant_logo.required' => 'Il logo del ristorante è obbligatorio',
            'restaurant_logo.image' => 'Il logo del ristorante deve essere di un\'estensione valida (jpeg,jpg,png,svg)',
            'restaurant_logo.mimes' => 'Il logo del ristorante deve essere di un\'estensione valida (jpeg,jpg,png,svg)',
            'p_iva.required' => 'La Partita Iva è obbligatoria',
            'p_iva.string' => 'La Partita Iva deve essere una stringa',
            'p_iva.size' => 'La Partita Iva deve contenere esattamente :size caratteri',
            'p_iva.unique' => 'Questa Partita Iva è già stata registrata in precedenza',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // Creating new user instance
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Creating new restaurant instance
        $user_restaurant = new Restaurant();
        $user_restaurant->user_id = $user->id;
        $user_restaurant->name = $data['restaurant_name'];
        $user_restaurant->description = $data['restaurant_description'];
        $user_restaurant->address = $data['restaurant_address'];

        // Check restaurant logo
        if(array_key_exists('restaurant_logo', $data)){
            $data['restaurant_logo'] = Storage::put('restaurants_logos', $data['restaurant_logo']);
        } else $data['restaurant_logo'] = 'restaurants_logos/placeholder.png';
        
        $user_restaurant->logo = $data['restaurant_logo'];
        $user_restaurant->p_iva = $data['p_iva'];
        $user_restaurant->save();
        
        // Check restaurant categories
        if (array_key_exists('categories', $data)) $user_restaurant->categories()->attach($data['categories']);
        return $user;
    }

    public function showRegistrationForm()
    {
        $categories = Category::all();
        return view("auth.register", compact("categories"));
    }
}
