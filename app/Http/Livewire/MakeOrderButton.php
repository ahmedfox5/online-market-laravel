<?php

namespace App\Http\Livewire;

use App\Number;
use Livewire\Component;

class MakeOrderButton extends Component
{
    public $totalPrice;


    public function render()
    {
        return view('livewire.make-order-button');
    }

    public function makeOrder(){
        return redirect()->to('/order/make');
    }

    public function addNum(){
        Number::create([
            'number' => 1234,
        ]);

        session()->flash('success'  ,'added Successfuly');
    }
}
