<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cart list') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr class="thead-dark">
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>


                        @foreach ($cart['products'] as $product)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->formated_price }}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger" wire:click="removeProductFromCart({{ $product->id }})"><i class="bi bi-trash"></i> Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="card-footer">
                    <a class="btn btn-primary float-right" href="{{ route('shop.checkout') }}"><i class="bi bi-cart-fill"></i> Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>