@extends('layouts.app')

@section('content')
    <div class="px-5">
        <div class="h3 text-light">
            Categories Management
        </div>
        <span class="text-light"> Add / Update Products and Stocks</span>
    </div>

    <div class="mt-3 px-5 card">
        <div class="card-body">
            <form action="{{route('categories.update', $category->id)}}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('patch')
                        <div class="col-12 mb-3">
                            <label for="nameInput">Category Name</label>
                            <input type="text" class="form-control" id="nameInput" name="name" value="{{ $category->name }}">
                        </div>

                        <input type="hidden" name="user" value={{ auth()->user()->id }}>

                        <div class="col-12 mb-3">
                            <label for="codeInput">Category Code</label>
                            <input type="text" class="form-control" id="codeInput" name="code" value="{{ $category->code }}" required>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary btn-lg" type="submit">Save Category</button>
                        </div>
                    </form>
        </div>
    </div>
@endsection
