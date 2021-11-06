<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($formVisible)
                @if (! $formEditProduct)
                    <livewire:product.create />
                @else
                    <livewire:product.update />
                @endif
            @endif

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    {{ __('Product List') }}

                    <button wire:click="$toggle('formVisible')" class="btn btn-sm btn-primary">+ Create</button>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div id="pagination_filter">
                            <label for="pagination">Filter data</label>
                            <select id="pagination" wire:model="pagination">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>

                        <div id="search_filter">
                            <label for="search">Keyword</label>
                            <input wire:model="search" id="search" type="text" placeholder="Keyword">
                        </div>
                    </div>

                    <hr>
                    <table class="table table-bordered">
                        <tr class="thead-dark">
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>

                        @foreach ( $products as $product)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->formated_price }}</td>
                            <td>
                                <div class="d-flex">
                                    <button wire:click="editProduct({{ $product->id }})" class="btn btn-sm btn-info text-white">Edit</button>
                                    <button wire:click="deleteProduct({{ $product->id }})" class="btn btn-sm btn-danger ml-1">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>