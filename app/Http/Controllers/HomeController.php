<?php

namespace App\Http\Controllers;
use App\Product;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function home()
    {
        return view('home');
    }

    public function show($id)
    {
        $products = User::with('products')->find($id)->products;
        return view('pages.index', compact('products'));
    }

    public function store(Request $request) 
    {
        $product = new Product;
        $product->product = $request->product;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->user_id = $request->user_id;
        $product->save();

        return back();
    }

    public function destroy($id)
    {   
        $product = Product::find($id);
        $product->delete();

        return back();
    }
}
