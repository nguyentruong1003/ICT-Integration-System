<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $pagination = 10;
    public $search = '';
    public $formVisible = false;
    public $formEditProduct = false;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $listeners = ['formClose', 'productStore', 'productUpdate'];

    public function formClose()
    {
        $this->formVisible = false;
    }

    public function editProduct($productId)
    {
        $this->formVisible = true;
        $this->formEditProduct = true;
        $product = Product::findOrFail($productId);

        $this->emit('editProduct', $product);
    }

    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();
        session()->flash('message', 'Product was deleted.');
    }

    public function productStore()
    {
        $this->formVisible = false;
        session()->flash('message', 'Your product was stored.');
    }

    public function productUpdate()
    {
        $this->formVisible = false;
        $this->formEditProduct = false;

        session()->flash('message', 'Your product was updated.');
    }

    public function render()
    {
        $products = (isset($this->search))
                    ? Product::where('name', 'like', '%'. $this->search .'%')->latest()->paginate($this->pagination)
                    : Product::latest()->paginate($this->pagination);

        return view('livewire.product.index', compact('products'));
    }
}
