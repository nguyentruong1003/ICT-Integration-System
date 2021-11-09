<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{

    use WithFileUploads;
    
    public $productId;
    public $name;
    public $description;
    public $price;
    public $oldImage;

    public $image;

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required|numeric|min:0',
        'description' => 'required|max:300',
        'image' => 'nullable|image|max:1024'
    ];

    protected $listeners = ['editProduct'];

    public function editProduct(Product $product)
    {
        $this->productId = $product['id'];
        $this->name = $product['name'];
        $this->price = $product['price'];
        $this->description = $product['description'];
        $this->oldImage = is_null($product['image_path']) 
                        ? null 
                        : asset('/storage/'. $product['image_path']);
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->productId);

        if ($this->image) {
            Storage::disk('public')->delete($product->image_path);

            $image_path = $this->image->store('products', [
                'disk' => 'public'
            ]);

            $product->image_path = $image_path;
        }

        $product->name = $this->name;
        $product->price = $this->price;
        $product->description = $this->description;

        $product->save();
        $this->emitUp('productUpdate');
    }

    public function render()
    {
        return view('livewire.product.update');
    }
}
