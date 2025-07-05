<?php

namespace App\Http\Controllers;
use Modules\Product\App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function homeproduct($id){
        
       
        return view('frontend.home');
    }

    //cart view
    public function cart()
    {
        return view('addToCart');
    }

   
        
}
