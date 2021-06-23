<?php

namespace App\Http\Controllers;

use App\Product;
use App\Shoppingcart;
use Illuminate\Http\Request;

class shoppingCartCont extends Controller
{

    public function index(){

        $user_cart_products = Shoppingcart::where('user_id' ,auth()->user()->id)->get();
        $products = array();
        $quantities_ids = array();
        foreach ($user_cart_products as $cart_product){
            $products[] = Product::find($cart_product->product_id);
            $quantities_ids[] = [$cart_product->id ,$cart_product->quantity];
        }


        return view('shoppingcart')->with([
            'products'=>$products,
            'quantities_ids' => $quantities_ids,
        ]);
    }

//    plus and minus
    public function plus(Request $request){
        $cart_product = Shoppingcart::find($request->id);
        $new_quantity = $cart_product->quantity + 1;
        $cart_product->update([
            'quantity' => $new_quantity,
        ]);
    }

    public function minus(Request $request){
        $cart_product = Shoppingcart::find($request->id);
        $new_quantity = $cart_product->quantity - 1;
        if ($new_quantity !== 0){
            $cart_product->update([
                'quantity' => $new_quantity,
            ]);
        }
    }


    //  ////////////// add to shopping cart
    public function add(Request $request){
        $quantity = 1;
        if ($request->quantity){
            $quantity = $request->quantity;
        }
        Shoppingcart::create([
           'product_id' => $request->pro_id,
           'user_id' => $request->user_id,
            'quantity' => $quantity,
        ]);
    }///end of adding


    /////  ////////////// remove from shopping cart
    public function delete(Request $request){
        $ele = Shoppingcart::where('user_id' ,$request->user_id)->where('product_id' ,$request->pro_id)->get();
        Shoppingcart::destroy($ele[0]->id);
    }///end of adding


} ///// end of controller
