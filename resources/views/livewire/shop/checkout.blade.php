<div class="container">
        <div class="card">

            <div class="card-header">
                Checkout Form
            </div>

            <div class="card-body">

                @if ($showFormCheckout)
                <form method="POST" wire:submit.prevent="checkout">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input wire:model="first_name" type="text" class="form-control @error('first_name') is_invalid @enderror" id="firstName" placeholder="" value="" required>
                            @error('first_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input wire:model="last_name" type="text" class="form-control @error('last_name') is_invalid @enderror" id="lastName" placeholder="" value="" required>
                            @error('last_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input wire:model="email"  type="email" class="form-control @error('email') is_invalid @enderror" id="email" placeholder="acme@example.com">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <textarea wire:model="address"  name="address" id="address" class="form-control @error('address') is_invalid @enderror" placeholder="Input address"></textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="city">City</label>
                            <input wire:model="city" type="text" class="form-control @error('city') is_invalid @enderror" id="city">
                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="postal_code">Postal Code</label>
                            <input wire:model="postal_code" type="text" class="form-control @error('postal_code') is_invalid @enderror" id="postal_code" placeholder="" required>
                            @error('postal_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="phone">Phone</label>
                            <input wire:model="phone" type="text" class="form-control @error('phone') is_invalid @enderror" id="phone" placeholder="+62" required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <hr class="mb-4">

                    <button type="submit" class="btn btn-block btn-outline-primary">Submit</button>
                </form>

                @else
                <button wire:click="$emit('payment', '{{ $snapToken }}')" class="btn btn-primary">Payment</button>

                <script type="text/javascript">
                    window.Livewire.on('payment', function (snapToken) {
                        snap.pay(snapToken, {
                            // Success
                            onSuccess: function (result) {
                                window.livewire.emit('emptyCart')
                                window.location.href = "/"
                            },
                            // Pending
                            onPending: function (result) {
                                location.reload()
                            },
                            // Failed
                            onError: function (result) {
                                location.reload()
                            }
                        })
                    })
                </script>
                @endif
            </div>
        </div>
</div>
