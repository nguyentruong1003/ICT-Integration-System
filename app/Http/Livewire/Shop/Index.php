<?php

namespace App\Http\Livewire\Shop;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $pagination = 12;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        Cart::add($product);

        $this->emit('addToCart');
    }

    public function render()
    {
        $products = (isset($this->search))
                    ? Product::where('name', 'like', '%'. $this->search .'%')->latest()->paginate($this->pagination)
                    : Product::latest()->paginate($this->pagination);

        return view('livewire.shop.index', compact('products'));
    }
}
