<div>
    <div class="card">
        <div class="card-header">
            <h4 class="float-start">USERS TABLE</h4>
            <a href="#" class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                <i class="fa fa-plus fa-lg me-3"></i>
                Add New Users
            </a>
        </div>
        <div class="card-body">

            <table class="table">
                <thead class="text-center">
                    <tr class="h5">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $key => $user )
                            <tr wire:key='{{ $user->id }}'>
                                <td>{{$key + 1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>@if ($user->is_admin == 1) Admin
                                    @else Cashier
                                    @endif
                                </td>
                                <td>
                                    <div class="button-group">
                                        <a class="btn btn-sm btn-info me-1" href="#" data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}">
                                            <i class="fa fa-edit fa-lg "></i>

                                        </a>
                                        <a class="btn btn-sm btn-danger me-1" href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteUser{{$user->id}}"
                                        {{-- wire:click='deleteUser({{ $user->id }})' --}}
                                        >
                                            <i class="fa fa-trash fa-lg "></i>

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
                                            <form action="{{route('users.update', $user->id)}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="name"
                                                    placeholder="Name" value="{{ $user->name }}">
                                                    <label for="floatingInput">Full Name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" id="floatingInput"    name="email"
                                                    placeholder="example@gmail.com" value="{{ $user->email }}" >
                                                    <label for="floatingInput">Email Address</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="phone"
                                                    placeholder="phone number" value="{{ $user->phone }}">
                                                    <label for="floatingInput">Phone</label>
                                                </div>
                                                <div class="form-floating">
                                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" id="role" name="is_admin">
                                                    <option value="1" @if ($user->is_admin === 1)
                                                        selected
                                                    @endif>Admin</option>
                                                    <option value="2" @if ($user->is_admin === 2)
                                                        selected
                                                    @endif>Cashier</option>
                                                    </select>
                                                    <label for="floatingSelect">Select Roles</label>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-warning btn-lg" type="submit">Edit User &#x2713;</button>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            {{-- Delete user --}}
                            <div class="modal fade" id="deleteUser{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Removing User</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form  wire:submit='deleteUser({{ $user->id }})'>
                                                <p class="text-center fw-bold h5">
                                                    Are you sure you want to remove
                                                    "{{ $user->name }}"?
                                                </p>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger me-2 p-2" type="submit"><b>YES</b></button>
                                                    <button class="btn btn-secondary me-2 p-2" data-bs-dismiss="modal"><b>CANCEL</b></button>
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

    {{-- Add new user --}}
    <div class="modal custom right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mx-3 px-2" id="staticBackdropLabel">Add User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit='createUser'>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" wire:model='form.name' required>
                            <label for="floatingInput">Full Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" wire:model='form.email' required>
                            <label for="floatingInput">Email Address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" wire:model='form.phone' required>
                            <label for="floatingInput">Phone</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput" wire:model='form.password' required>
                            <label for="floatingInput">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput" wire:model='form.confirm_password' required>
                            <label for="floatingInput">Confirm Password</label>
                            @error('confirm_password') <span>{{ $message }}</span> @enderror
                        </div>
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" id="role" wire:model='form.is_admin'>
                              <option value="1">Admin</option>
                              <option value="2">Cashier</option>
                            </select>
                            <label for="floatingSelect">Select Roles</label>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary btn-lg" type="submit">Save User</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>


</div>


