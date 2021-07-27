<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Illuminate\Support\Facades\Redirect;
class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
    	$qty=$request->qty;
    	$product_id=$request->product_id;
        $product_info=DB::table('meals')
                      ->where('id',1)
                      ->first();

        $data['qty']=$qty;
        $data['id']=$product_info->id;
        $data['name']=$product_info->name;
        $data['price']=$product_info->price;
        $data['options']['image']=$product_info->image;

        Cart::add($data);
        return Redirect::to('/show-cart');
                     
    }

    public function show_cart()
    {
       $all_published_category=DB::table('categories')
                              ->where('publication_status',1)
                              ->get();
         $manage_published_category=view('pages.add_to_cart')
               ->with('all_published_category',$all_published_category);
       return view('layout')
               ->with('pages.add_to_cart',$manage_published_category);                      
   
    }
    public function delete_to_cart($rowId)
    {
    	Cart::update($rowId,0);
    	return Redirect::to('/show-cart');
    }
    
    public function update_cart(Request $request)
    {
       $qty=$request->qty;
       $rowId=$request->rowId;

       Cart::update($rowId,$qty);
      return Redirect::to('/show-cart');


    }
}
