<?php

namespace App\Http\Controllers;

use App\Like;
use App\Product;
use Illuminate\Http\Request;

class pagesCont extends Controller
{
    public function likes($user_id){
        $licked_ids = Like::where('user_id' ,$user_id)->get();
        $products = array();
        foreach ($licked_ids as $id){
            $products[] = Product::find($id->product_id);
        }
        return view('likes')->with(['products' => $products]);
    }


    public function deleteLikedProduct(Request $request){
        $like = Like::where('product_id' ,$request->pro_id)->where('user_id' ,$request->user_id)->get();
        Like::destroy($like[0]->id);
    }

}   /////   end of controller
