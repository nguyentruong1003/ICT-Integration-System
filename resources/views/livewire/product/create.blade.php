<div class="row justify-content-center mb-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" wire:submit.prevent="store">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="name">Name</label>
                                <input wire:model.lazy="product.name" type="text" id="name" class="form-control @error('product.name') is-invalid @enderror" placeholder="Product Name">
                                @error('product.name')
                                    <span class="invalid-feeback">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="price">Price</label>
                                <input wire:model.lazy="product.price" type="number" min="0" step="any" id="price" class="form-control @error('product.price') is-invalid @enderror" placeholder="Product Price">
                                @error('product.price')
                                    <span class="invalid-feeback">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="description">Description</label>
                                <textarea wire:model.lazy="product.description" id="description" class="form-control @error('product.description') is-invalid @enderror" placeholder="Product Description"></textarea>
                                @error('product.description')
                                    <span class="invalid-feeback">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="image">Image</label>
                                <input wire:model="image" type="file" id="image">
                                @error('image')
                                    <span class="invalid-feeback">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                @if($image)
                                    <div class="d-block">
                                        <label for="image_preview" class="d-block">Image Preview</label>
                                        <img id="image_preview" src="{{ $image->temporaryUrl() }}" class="border rounded p-1" height="200">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button wire:click="$emitUp('formClose')" type="button" class="btn btn-secondary">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>