<div class="container">

    <div class="d-flex align-items-center justify-content-end py-2">
        <div class="d-flex">
            <label for="search" class="mr-2">Search</label>
            <input wire:model="search" id="search" type="text" class="form-control" placeholder="keyword">
        </div>
    </div>

    <hr>

    <div class="row">

        @forelse ($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    
                    <img class="card-img-top" src="{{ $product->image_product }}" alt="{{ $product->name }}" srcset="">
                    <div class="card-body">
                        <h5 class="font-weight-bold">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->short_description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button wire:click="addToCart({{ $product->id }})" wire:key="{{ $product->id }}" type="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-cart-plus-fill"></i> Add to cart</button>
                            </div>
                            <small class="text-muted">{{ $product->last_update }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        Produk tidak ditemukan
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    {{ $products->links() }}
</div>