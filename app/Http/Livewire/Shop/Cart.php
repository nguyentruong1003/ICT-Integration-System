<?php

namespace App\Http\Livewire\Shop;

use App\Facades\Cart as FacadesCart;
use Livewire\Component;

class Cart extends Component
{
 
    public $cart;

    public function mount()
    {
        $this->cart = FacadesCart::get();
    }

    public function removeProductFromCart($id)
    {
        FacadesCart::remove($id);
        $this->cart = FacadesCart::get();
        $this->emit('removeProductFromCart');
    }

    public function render()
    {
        return view('livewire.shop.cart');
    }
}
