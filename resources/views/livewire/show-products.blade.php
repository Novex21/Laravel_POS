<div>
    <div class="row g-2 mb-4">
        <div class="col col-md-6">
            <h4 class="text-light">Products List</h4>

            <p class="text-light">
                Welcome! Here you can view and manage the list of products available in our inventory. Take actions like adding new products, updating information, and monitoring stock levels to ensure a smooth workflow.
            </p>
        </div>
    </div>

    <div class="row no-gutters flex-lg-nowrap mb-3">
        <div class="col-lg-4 btn-group me-0">
            <select class="form-select" wire:model.live='selectCategory' id="select">
                <option selected>Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 btn-group me-0">
            <select class="form-select" wire:model.live='sortBy' id="select">
                <option value="name">Product Name</option>
                <option value="brand">Brand</option>
                <option value="price">Price</option>
                <option value="quatity">Quantity</option>
                <option value="alert_stock">Alert-Stock Level</option>
                <option value="category_name">Category</option>
            </select>
            <button class="btn btn btn-primary" wire:click='sortASC'><i class="fa-solid fa-arrow-up"></i></button>
            <button class="btn btn btn-primary" wire:click='sortDESC'><i class="fa-solid fa-arrow-down"></i></button>

        </div>
        <div class='col-lg-4'>
            <div class="btn-group ms-5 me-0" >
                <input type="search" wire:model.live="search"  class="form-control" placeholder="Searh....">
                <button class="btn btn-sm btn-primary" wire:click='reboot'>Reset</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="float-start">PRODUCT LIST</h4>
            <a href="{{ route('products.create') }}" class="float-end btn btn-primary">
                <i class="fa fa-plus fa-lg me-3"></i>
                Add New Products
            </a>
        </div>
        <div class="card-body">
            <table class="table" >
                <thead class="text-center">
                    <tr class="h5">
                        <th>No.</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Brand Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Alert Stock</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center" style="vertical-align: middle">
                    @foreach ($products as $key => $product )
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <img class="rounded" width="50" height="55"
                            src='{{ asset("storage/$product->photo")}}' alt="Image Error">
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->brand}}</td>
                        <td>{{number_format($product->price, 2)}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>@if ($product->alert_stock >= $product->quantity)
                            <span class="badge bg-danger">Low Stock -> {{$product->alert_stock}}</span>
                            @else <span class="badge bg-success">{{$product->alert_stock}}</span>
                            @endif
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <div class="button-group">
                            <a class="btn btn-sm btn-info me-1" href="{{ route('products.edit',$product->id )}}"> {{-- data-bs-toggle="modal" data-bs-target="#editProduct{{$product->id}} --}}
                                    <i class="fa fa-edit fa-lg "></i>

                                </a>
                                <a href="#" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteProduct{{$product->id}}">
                                    <i class="fa fa-trash fa-lg "></i>
                                </a>
                            </div>
                        </td>
                    </tr>



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
    <div>
        {{ $products->links() }}
    </div>

</div>
