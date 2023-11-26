@extends('layouts.app')

@section('content')


    <div class="card">
        <div class="card-header">
            <h4 class="float-start">PRODUCT LIST</h4>
            <a href="#" class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">
                <i class="fa fa-plus fa-lg me-3"></i>
                Add New Products
            </a>
        </div>
        <div class="card-body">
            {{$products->links()}}
            <table class="table" >
                <thead class="text-center">
                    <tr class="h5">
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Brand Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Alert Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($products as $key => $product )
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->brand}}</td>
                        <td>{{number_format($product->price, 2)}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>@if ($product->alert_stock >= $product->quantity)
                            <span class="badge bg-danger">Low Stock -> {{$product->alert_stock}}</span>
                            @else <span class="badge bg-success">{{$product->alert_stock}}</span>
                        @endif</td>
                        <td>
                            <div class="button-group">
                                <a class="btn btn-sm btn-info me-1" href="#" data-bs-toggle="modal" data-bs-target="#editProduct{{$product->id}}">
                                    <i class="fa fa-edit fa-lg "></i>
                                    {{-- Edit product --}}
                                </a>
                                <a href="#" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteProduct{{$product->id}}">
                                    <i class="fa fa-trash fa-lg "></i>
                                    {{-- Delete --}}
                                </a>
                            </div>
                        </td>
                    </tr>


                        {{-- edit product modal --}}

                    <div class="modal custom right fade" id="editProduct{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog custom">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Edit Product</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('products.update', $product->id)}}" method="POST">
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
                                        <div class="form-floating">
                                            <textarea class="form-control" name="description" placeholder="###"
                                            id="floatingTextarea">{{$product->description}}</textarea>
                                            <label for="floatingTextarea">Description For Product</label>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary btn-lg" type="submit">Edit Product &#x2713;</button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>

                    {{-- delete product modal --}}

                    <div class="modal fade" id="deleteProduct{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Delete Product</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <p class="text-center fw-bold h5">
                                            Are you sure you want to delete
                                            "{{ $product->name }}" product?
                                        </p>
                                        <div class="modal-footer btn-group">
                                            <button class="btn btn-danger btn-lg me-3" type="submit">DELETE</button>
                                            <button class="btn btn-secondary btn-lg me-3" data-bs-dismiss="modal">CANCEL</button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                    @endforeach

                </tbody>
            </table>
        </div>
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
                            <input type="number" class="form-control" id="floatingInput" name="price" placeholder="####" required>
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




    <style>
        .modal.right.custom .modal-dialog.custom {
            top: 0;
            right: 0;
            margin-right: 1vh;
            /* position: absolute; */
        }
    </style>





@endsection
