<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MakeOrder extends Component
{
    public $firstName ;
    public $lastName ;
    public $email ;
    public $phone ;
    public $address;
    public $address2;
    public $user;

    protected $rules = [
        "firstName" => "required",
        "lastName" => "required",
        "email" => "required|email",
        "phone" => "required|numeric|min:11",
        "address" => "required|min:10",
    ];

    public function render()
    {
        $user = auth()->user();
        $this->firstName = $user->first_name;
        $this->lastName = $user->last_name;
        $this->email = $user->email;
        return view('livewire.make-order');
    }

    public function add(){
        $this->counter++;
    }

    public function orderEnd(){

        $this->validate();

//        save the order

        return redirect()->to('/order/end');
    }

}
