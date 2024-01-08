@extends('layouts.app')

@section('content')
    <div class="px-5">
        <div class="h3 text-light">
            Products/Stocks Management
        </div>
        <span class="text-light"> Add / Update Products and Stocks</span>
    </div>
    <div class="mt-3 px-5 card">
        <div class="card-body">
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        <div class="col-md-4 mb-3">
                            <label for="nameInput">Product Name</label>
                            <input type="text" class="form-control" id="nameInput" name="name" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="brandInput">Brand Name</label>
                            <input type="text" class="form-control" id="brandInput" name="brand"  required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="priceInput">Price</label>
                            <input type="float" class="form-control" id="priceInput" name="price"  required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="qtyInput">Quantity</label>
                            <input type="number" class="form-control" id="qtyInput" name="quantity"  required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="alertInput">Alert Stock </label>
                            <input type="number" class="form-control" id="alertInput" name="alert_stock" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="category">Select Category</label>
                            <select class="form-select" id="category" name='category_id'>
                                @foreach ($categories as $category)

                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Textarea">Description For Product</label>
                            <textarea class="form-control" name="description" id="Textarea"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="fileInput">Choose Product Photo</label>
                            <input type="file" class="form-control" id="fileInput" name='photo'>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-lg" type="submit">Save product</button>
                        </div>
                    </form>
        </div>
    </div>
@endsection

