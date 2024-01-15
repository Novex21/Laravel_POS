@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="float-start">USERS TABLE</h4>
            <a href="{{ route('users.create') }}" class="float-end btn btn-primary"> {{-- data-bs-toggle="modal" data-bs-target="#addUser" --}}
                <i class="fa fa-plus fa-lg me-3"></i>
                Add New Users
            </a>
        </div>
        <div class="card-body">
            <div class="my-2">
                {{$users->links()}}
            </div>
            <table class="table" >
                <thead class="text-center">
                    <tr class="h5">
                        <th>No.</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center" style="vertical-align: middle">
                    @foreach ($users as $key => $user )
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <img class="rounded" width="50" height="55"
                            src='{{ asset("storage/$user->photo")}}' alt="No Image">
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>@if ($user->is_admin == 1) Admin
                            @else Cashier
                            @endif
                        </td>
                        <td>
                            <div class="button-group">
                                <a class="btn btn-sm btn-info me-1" href="{{ route('users.edit', $user->id) }}" >     {{-- data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}" --}}
                                    <i class="fa fa-edit fa-lg me-2"></i>
                                    Edit User
                                </a>
                                <a href="#" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteUser{{$user->id}}">
                                    <i class="fa fa-trash fa-lg me-2"></i>
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>


                    {{-- edit user modal --}}

                    <div class="modal custom right fade" id="editUser{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog custom">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Edit User</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="name"
                                            value="{{$user->name}}" placeholder="Name" >
                                            <label for="floatingInput">Full Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" name="email"
                                            value="{{$user->email}}" placeholder="example@gmail.com" >
                                            <label for="floatingInput">Email Address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="phone"
                                            value="{{$user->phone}}" placeholder="1122333" >
                                            <label for="floatingInput">Phone</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" id="role" name="is_admin">
                                            <option value="1" @if ($user->is_admin == 1)
                                                selected
                                            @endif>Admin</option>
                                            <option value="2" @if ($user->is_admin == 2)
                                                selected
                                            @endif>Cashier</option>
                                            </select>
                                            <label for="floatingSelect">Select Roles</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="file" class="form-control" id="floatingInput" name='photo'>
                                            <label for="floatingInput">Choose Profile Photo</label>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-warning btn-lg" type="submit">Edit User &#x2713;</button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>

                    {{-- delete user modal --}}

                    <div class="modal fade" id="deleteUser{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> --}}
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Delete User</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <p class="text-center fw-bold h5">Are you sure you want to delete {{ $user->name }}?</p>
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
    {{-- <livewire:user /> --}}


    {{-- Add new user --}}
    {{-- <div class="modal custom right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Add User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="name" required>
                            <label for="floatingInput">Full Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name='email' required>
                            <label for="floatingInput">Email Address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name='phone' required>
                            <label for="floatingInput">Phone</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput" name='password' required>
                            <label for="floatingInput">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput" name='confirm_password' required>
                            <label for="floatingInput">Confirm Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" id="role" name='is_admin'>
                              <option value="1">Admin</option>
                              <option value="2">Cashier</option>
                            </select>
                            <label for="floatingSelect">Select Roles</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="floatingInput" name='photo'>
                            <label for="floatingInput">Choose Profile Photo</label>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary btn-lg" type="submit">Save User</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div> --}}





    <style>
        .modal.right.custom .modal-dialog.custom {
            top: 0;
            right: 0;
            margin-right: 1vh;
            /* position: absolute; */
        }
    </style>






@endsection
