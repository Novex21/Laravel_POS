<div>

    <div class="card mb-4">

        <div class="card-header">
            <h4 class="float-start">ORDER PRODUCTS</h4>
            <a href="#" class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">
                <i class="fa fa-plus fa-lg me-3"></i>
                Add New Products
            </a>
        </div>

        @if($message)
            <div class="m-3 alert alert-info alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-4">
                    <form wire:submit='insertToCart'>

                        <div class="input-group">
                            <div class="input-group-text bg-primary"><i class="fa-solid fa-lg fa-search text-light"></i></div>
                            <input type="text" class="form-control" name="" id="" placeholder="Enter Product Code to Search Products" wire:model.live='product_code'>
                        </div>

                    </form>
                </div>
            </div>

            <table id="myTable" class="table table-bordered table-left" >
                <thead class="text-center">
                    <tr class="h5">
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount(%)</th>
                        <th colspan="6">Total</th>
                    </tr>
                </thead>

                <tbody class="addMoreProduct">
                    @foreach ($productInCart as $key=>$cart )
                    <tr>
                        <td class="row-number text-center align-middle">{{$key + 1}}</td>
                        <td width="30%">
                            <input type="text"  value="{{$cart->product->name}}" class="form-control">
                        </td>
                        <td width="13%">
                            <div class="row">
                                <div class="col">
                                    <button wire:click.prevent='IncrementQty({{$cart->id}})' class="btn  btn-success"> + </button>
                                </div>
                                <div class="col">
                                    <label class="text-center" for="">{{ $cart->product_qty }}</label>
                                </div>
                                <div class="col">
                                    <button wire:click.prevent='DecrementQty({{$cart->id}})' class="btn  btn-danger"> - </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input type="float" class="form-control" readonly
                            value="{{$cart->product->price}}">
                        </td>
                        <td>
                            <input type="number" class="form-control"  wire:change='Discount({{ $cart->id }}, $event.target.value)'>
                        </td>
                        <td>
                            <input type="float"  class="form-control total_amount" readonly value="{{$cart->product_price}}">
                        </td>
                        <td class="text-center align-middle">
                            <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-lg fa-xmark" wire:click='removeProduct({{$cart->id}})'></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="card mb-3">
        <div class="card-header">
            <h4>Total  $<b>{{$productInCart->sum('product_price')}}</b></h4>
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
                            wire:model.live='balance' name="balance" readonly value="number_format({{$balance}},2)">
                        </div>
                        <div>
                            <button class=" float-end ms-4 btn  btn-lg btn-success" type="submit">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>






    {{--Modal--}}
    <!-- add product modal -->
    <div class="modal custom right fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Add product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('products.store')}}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Name" required>
                            <label for="floatingInput">Product Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="brand" placeholder="####" required>
                            <label for="floatingInput">Brand Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="float" class="form-control" id="floatingInput" name="price" placeholder="####" required>
                            <label for="floatingInput">Price</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" name="quantity" placeholder="###" required>
                            <label for="floatingInput">Quantity</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" name="alert_stock" placeholder="####" required>
                            <label for="floatingInput">Alert Stock </label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="description" placeholder="###" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Description For Product</label>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary btn-lg" type="submit">Save product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


