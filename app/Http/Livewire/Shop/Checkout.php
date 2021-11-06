<?php

namespace App\Http\Livewire\Shop;

use App\Facades\Cart;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Checkout extends Component
{

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;
    public $city;
    public $postal_code;
    public $showFormCheckout;
    public $snapToken;

    protected $listeners = [
        'emptyCart'
    ];

    public function mount()
    {
        $this->showFormCheckout = true;
    }

    public function checkout()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        $cart = Cart::get()['products'];
        $amount = array_sum(
            array_column($cart, 'price')
        );

        $customerDetails = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postal_code
        ];

        $transactionDetails = [
            'order_id' => time(),
            'gross_amount' => $amount
        ];

        $payload = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails
        ];

        $this->showFormCheckout = false;

        // Midtrans Configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Get snap token midtrans
        $this->snapToken = Snap::getSnapToken($payload);
    }

    public function emptyCart()
    {
        Cart::clear();
        $this->emit('cartClear');
    }


    public function render()
    {
        return view('livewire.shop.checkout');
    }
}
