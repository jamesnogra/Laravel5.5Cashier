<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shopping_Cart;
use Auth;

class ProductController extends Controller
{

    public function index()
    {
    	$all_products = Product::all();
        return view('products/index', ['all_products'=>$all_products]);
    }

    public function addProduct()
    {
    	return view('products/add');
    }

    public function postAddProduct(Request $request)
    {
    	//validate and save photo
    	request()->validate([
            'product_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $image_name = time().'.'.request()->product_photo->getClientOriginalExtension();
        request()->product_photo->move(public_path('images')."\products", $image_name);

        $new_product = Product::create([
        	'name'		=> $request->product_name,
        	'details'	=> $request->product_details,
        	'cost'		=> $request->product_cost,
        	'image'		=> $image_name
        ]);

    	return redirect(action('ProductController@index'));
    }

    public function postAddToCart(Request $request)
    {
    	$user = Auth::user();
    	$new_cart = Shopping_Cart::create([
    		'user_id'	=> $user->id,
    		'product_id'=> $request->product_id,
    		'quantity'	=> $request->quantity,
    	]);
    	return $new_cart;
    }

    public function shoppingCart(Request $request)
    {
    	$user = Auth::user();
    	$all_items = Shopping_Cart::where('user_id', $user->id)->leftJoin('products', 'products.id', 'shopping_cart.product_id')->select('shopping_cart.*', 'products.name', 'products.cost', 'products.image')->get();
    	return view('products/shopping-cart', ['all_items'=>$all_items]);
    }

    public function deleteFromCart(Request $request)
    {
        $user = Auth::user();
        Shopping_Cart::where('user_id', $user->id)->where('id', $request->id)->delete();
        return $request->all();
    }

    public function updateShoppingCardRecordQuantity(Request $request)
    {
        $user = Auth::user();
        Shopping_Cart::where('user_id', $user->id)->where('id', $request->id)->update(['quantity'=>$request->quantity]);
        return $request->all();
    }

}
