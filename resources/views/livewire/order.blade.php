<div>
    <div class="row g-3">
        <h4 class="text-white my-2">Choose the Products and Add to Cart!!</h4>
        <div class="col-md-8">
            <div class="col-lg-4 btn-group mb-3">
                <select class="form-select" wire:model.live='selectCategory' id="select">
                    <option selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3 d-flex flex-md-row justify-content-evenly align-items-stretch">
                @foreach ($products as $product)
                    <div class="card p-3 me-4" style="width: 30rem;">
                        <img src="{{ asset("storage/$product->photo")}}" class="card-img-top" width="120" height="105" alt="Product Photo">
                        <div class="text-center pt-2">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="pt-2">
                                <p class="text-sm text-danger">{{number_format($product->price, 2)}} SGD</p>
                                <p class="text-sm text-secondary">{{$product->quantity}} units</p>
                                <button wire:click.prevent='insertToCart({{ $product->id }})'class="btn btn-sm btn-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>

        @if($message)
            <div class="mt-3 alert alert-info alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        </div>
        <div class="col-md-4">

            <ul class="list-group">
                @foreach ($productInCart as $cart )
                <li class="list-group-item">
                    <table class="table table-borderless">
                        <tr>
                            <td class="col-2">{{$cart->product->name}}</td>
                            <td class="col-3">
                                <div class="input-group">

                                        <button wire:click.prevent='IncrementQty({{$cart->id}})' class="btn btn-sm btn-success me-2"> + </button>

                                        <label class="text-center me-2  " for="">{{ $cart->product_qty }}</label>


                                        <button wire:click.prevent='DecrementQty({{$cart->id}})' class="btn btn-sm  btn-danger me-2"> - </button>

                                </div>
                            </td>
                            <td class="col-3">
                                <input type="number" class="form-control"  placeholder="Discount %" wire:change='Discount({{ $cart->id }}, $event.target.value)'>
                            </td>
                            <td class="col-2">
                                {{$cart->product_price}}
                            </td>
                            <td class="col-2">
                                <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-lg fa-xmark" wire:click='removeProduct({{$cart->id}})'></i></a>
                            </td>
                        </tr>
                    </table>
                </li>
                @endforeach
            </ul>

            <div class="card mt-3">
                <div class="card-header">
                    <h4>Total  $<b class="text-success">{{$productInCart->sum('product_price')}}</b></h4>
                </div>
                <form action="{{route('orders.store')}}" method="POST">
                    @csrf
                    @foreach ($productInCart as $key=>$cart )

                        <input type="hidden" name='product_id[]'  value="{{$cart->product->id}}" class="form-control">
                        <input type="hidden" name="quantity[]" value="{{ $cart->product_qty }}">
                        <input type="hidden" name="price[]"  class="form-control price" readonly
                        value="{{$cart->product->price}}">
                        <input type="hidden" name="discount[]"  class="form-control discount" value="{{ $cart->discount }}">
                        <input type="hidden" name="total_amount[]"  class="form-control total_amount" readonly value="{{$cart->product_price}}">

                    @endforeach
                    <div class="card-body">
                        <div class="panel">
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="p-2">
                                        <label for="name" class="form-label">Customer Name</label>
                                        <input type="text" name="customer_name" id="name" class="form-control">
                                    </div>
                                    <div class="p-2">
                                        <label for="phone" class="form-label">Customer Phone</label>
                                        <input type="text" name="customer_phone" id="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="h5">Payment Method</div>
                                        <div class="form-check form-check-inline ms-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="cash" checked class="true">
                                        <label class="form-check-label " for="payment_method"><i class="text-success fa-solid fa-wallet fa-lg me-2"></i>Cash</label>
                                    </div>
                                    <div class="form-check form-check-inline ms-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="bank transfer"  class="true">
                                        <label class="form-check-label " for="payment_method"><i class="text-primary fa-solid fa-building-columns fa-lg me-2"></i>Banking</label>
                                    </div>
                                    <div class="form-check form-check-inline ms-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="credit Card"  class="true">
                                        <label class="form-check-label " for="payment_method"><i class="text-danger fa-regular fa-credit-card fa-lg me-2"></i>Credit Card</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="paid_amount" class="form-label">Payment</label>
                                    <input type="float" class="form-control" id="paid_amount"
                                        wire:model.live='pay_money' wire:input='updateBalance()' name="paid_amount" placeholder="">
                                </div>
                                <div class="mb-3" >
                                    <label for="balance" class="form-label">Return Change</label>
                                    <input type="float" class="form-control" id="balance"
                                    wire:model.live='balance' name="balance" readonly value="number_format({{ $balance }},2)">
                                </div>
                                <div>
                                    <button class=" float-end ms-4 btn  btn-lg btn-success" type="submit">ORDER</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>






</div>


