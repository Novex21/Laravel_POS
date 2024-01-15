<div>
    <div class="row g-2 mb-4">
        <div class="col col-md-6">
            <h4 class="text-light">Categories List</h4>

            <p class="text-light">
                Welcome! Here you can view and manage the list of Categories available in our inventory. Take actions like adding new Categories, updating information, and monitoring stock levels to ensure a smooth workflow.
            </p>
        </div>
    </div>

    <div class="row no-gutters flex-lg-nowrap mb-3">
        <div class="col-lg-4  me-0">

        </div>
        <div class="col-lg-4 btn-group me-0">
            <select class="form-select me-1" wire:model.live='sortBy' id="select">
                <option value="name">Category Name</option>
                <option value="code">Category Code</option>
                <option value="user_name">Created By</option>
            </select>
            <button class="btn btn btn-primary me-1" wire:click='sortASC'><i class="fa-solid fa-arrow-up"></i></button>
            <button class="btn btn btn-primary me-1" wire:click='sortDESC'><i class="fa-solid fa-arrow-down"></i></button>

        </div>
        <div class='col-lg-4 me-0'>
            <div class="btn-group ms-5 me-0" >
                <input type="search" wire:model.live="search"  class="form-control me-1" placeholder="Searh....">
                <button class="btn btn-sm btn-primary" wire:click='reboot'>Reset</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="float-start">CATEGORIES LIST</h4>
            <a href="{{ route('categories.create') }}" class="float-end btn btn-primary">
                <i class="fa fa-plus fa-lg me-3"></i>
                Add New Category
            </a>
        </div>
        <div class="card-body">
            <table class="table" >
                <thead class="text-center">
                    <tr class="h5">
                        <th>No.</th>
                        <th>Category Name</th>
                        <th>Category Code</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center" style="vertical-align: middle">
                    @foreach ($categories as $key => $category )
                    <tr>
                        <td>{{$key + 1}}</td>

                        <td>{{$category->name}}</td>
                        <td>{{$category->code}}</td>
                        <td>{{ $category->user->name }}</td>
                        <td>
                            <div class="button-group">
                            <a class="btn btn-sm btn-info me-1" href="{{ route('categories.edit',$category->id )}}">
                                    <i class="fa fa-edit fa-lg "></i>

                                </a>
                                <a href="#" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteCategory{{$category->id}}">
                                    <i class="fa fa-trash fa-lg "></i>
                                </a>
                            </div>
                        </td>
                    </tr>



                    {{-- delete product modal --}}

                    <div class="modal fade" id="deleteCategory{{$category->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Delete Product</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('categories.destroy', $category->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <p class="text-center fw-bold h5">
                                            Are you sure you want to delete
                                            "{{ $category->name }}" Category?
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
    <div class="mt-3">
        {{ $categories->links() }}
    </div>

</div>

