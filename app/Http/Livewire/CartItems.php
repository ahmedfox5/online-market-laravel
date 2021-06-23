<?php

namespace App\Http\Livewire;

use App\Product;
use App\Shoppingcart;
use Livewire\Component;

class CartItems extends Component
{

    public $products ;
    public $quantities_ids;
    public $totalPrice;



    public function getTotalPrice(){
        $totalPrice = 0;
        for ($i = 0 ;$i < count($this->products) ;$i++){
            $totalPrice += $this->products[$i]->after_discount * $this->quantities_ids[$i][1];
        }
        $this->totalPrice = $totalPrice;
    }

    public function mount(){
        $user_cart_products = Shoppingcart::where('user_id' ,auth()->user()->id)->get();
        $products = array();
        $quantities_ids = array();
        foreach ($user_cart_products as $cart_product){
            $products[] = Product::find($cart_product->product_id);
            $quantities_ids[] = [$cart_product->id ,$cart_product->quantity];
        }
        $this->products = $products;
        $this->quantities_ids = $quantities_ids;
        $this->getTotalPrice();
    }

    public function render()
    {
        return view('livewire.cart-items');
    }


    public function removeItem($user_id ,$pro_id){
        $ele = Shoppingcart::where('user_id' ,$user_id)->where('product_id' ,$pro_id)->get();
        Shoppingcart::destroy($ele[0]->id);
        $this->mount();
    }

    public function minus($pro_id){
        $cart_product = Shoppingcart::find($pro_id);
        $new_quantity = $cart_product->quantity - 1;
        if ($new_quantity !== 0){
            $cart_product->update([
                'quantity' => $new_quantity,
            ]);
        }
        $this->mount();
    }

    public function plus($pro_id){
        $cart_product = Shoppingcart::find($pro_id);
        $new_quantity = $cart_product->quantity + 1;
        $cart_product->update([
            'quantity' => $new_quantity,
        ]);
        $this->mount();
    }


    public function makeOrder(){
        return redirect()->to('/order/make');
    }
}
