<?php

namespace App\Http\Livewire;

use App\Number;
use Livewire\Component;

class OrderEnd extends Component
{
    public function render()
    {
        $numbers = Number::all();
        return view('livewire.order-end' ,[
            'numbers' => $numbers
        ]);
    }
}
