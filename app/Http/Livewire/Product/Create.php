<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public ?Product $product;
    public $image;

    protected $rules = [
        'product.name' => 'required|min:3',
        'product.price' => 'required|numeric|min:0',
        'product.description' => 'required|max:300',
        'image' => 'image|max:1024'
    ];

    public function mount()
    {
        $this->product = new Product();
    }

    public function store()
    {
        $this->validate();
        $image_path = null;

        if ($this->image) {
            $image_path = $this->image->store('products', [
                'disk' => 'public'
            ]);
        }

        $this->product->image_path = $image_path;
        $this->product->save();
        $this->emitUp('productStore');
    }

    public function render()
    {
        return view('livewire.product.create');
    }
}
