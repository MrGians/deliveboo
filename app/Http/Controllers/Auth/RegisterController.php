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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'restaurant_name' => ['required', 'string'],
            'restaurant_address' => ['required', 'string'],
            'restaurant_description' => ['required', 'string'],
            'categories' => ['required', 'exists:categories,id'],
            'restaurant_logo' => ['required', 'image', 'mimes:jpeg,jpg,png,svg'],
            'p_iva' => ['required', 'string','size:11', 'unique:restaurants'],
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
