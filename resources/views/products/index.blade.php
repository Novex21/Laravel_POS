@extends('layouts.app')

@section('content')
    <livewire:show-products/>





    {{--Modal--}}
    <!-- add product modal -->
    {{-- <div class="modal custom right fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Add product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
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
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="description" placeholder="###" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Description For Product</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="floatingInput" name='photo'>
                            <label for="floatingInput">Choose Product Photo</label>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-lg" type="submit">Save product</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div> --}}
    {{-- edit product modal --}}

                    {{-- <div class="modal custom right fade" id="editProduct{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog custom">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Edit Product</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="name"
                                            value="{{$product->name}}" placeholder="Name" required>
                                            <label for="floatingInput">Product Name</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="brand"
                                            value="{{$product->brand}}" placeholder="####" required>
                                            <label for="floatingInput">Brand Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" name="price"
                                            value="{{$product->price}}" placeholder="####" required>
                                            <label for="floatingInput">Price</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" name="quantity"  value="{{$product->quantity}}" placeholder="###" required>
                                            <label for="floatingInput">Quantity</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" name="alert_stock"
                                            value="{{$product->alert_stock}}" placeholder="####" required>
                                            <label for="floatingInput">Alert Stock </label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="description" placeholder="###"
                                            id="floatingTextarea">{{$product->description}}</textarea>
                                            <label for="floatingTextarea">Description For Product</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="file" class="form-control" id="floatingInput" name='photo'>
                                            <label for="floatingInput">Choose Product Photo</label>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary btn-lg" type="submit">Edit Product &#x2713;</button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div> --}}











@endsection
