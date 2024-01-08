@extends('layouts.app')

@section('content')
    <div class="px-5">
        <div class="h3 text-light">
            User Management
        </div>
        <span class="text-light"> Add / Update User</span>
    </div>

    <div class="mt-3 px-5 card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                @method('patch')

                <div class="col-md-4 mb-3">
                    <label for="inputName">Full Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->name }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="inputEmail">Email Address</label>
                    <input type="email" class="form-control" id="inputEmail" name='email' value="{{ $user->email }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="inputPhone">Phone</label>
                    <input type="text" class="form-control" id="inputPhone" name='phone' value="{{ $user->phone }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputPass">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="inputPass" name='password' value="">
                        <span class="btn btn-outline-secondary" id="toggle"><i  id="toggleIcon" class="fa-solid fa-eye-slash"></i></span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputSelect">Select Roles</label>
                    <select class="form-select" id="inputSelect" aria-label="Floating label select example" id="role" name='is_admin'>
                        <option value="1" @if ($user->is_admin == 1)
                            selected
                        @endif>Admin</option>
                        <option value="2" @if ($user->is_admin == 2)
                            selected
                        @endif>Cashier</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="inputFile">Choose Profile Photo</label>
                    <input type="file" class="form-control" id="inputFile" name='photo'>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary btn-lg mx-3" type="submit">Edit User</button>
                    <a href="{{ route('users.index') }}" class="btn btn-lg btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Initial password state
            var isPasswordVisible = false;

            // Function to toggle password visibility
            function togglePassword() {
                var passwordInput = $('#inputPass');
                var toggleIcon = $('#toggleIcon');

                if (isPasswordVisible) {
                // If password is visible, hide it
                passwordInput.attr('type', 'password');
                toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                // If password is hidden, show it
                passwordInput.attr('type', 'text');
                toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }

                // Toggle the password state
                isPasswordVisible = !isPasswordVisible;
            }

            // Attach click event to the toggle icon
            $('#toggle').click(togglePassword);
        });
    </script>
@endsection
