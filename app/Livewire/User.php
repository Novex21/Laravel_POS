<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Livewire\Forms\UpdateUserForm;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;



class User extends Component
{
    public $users;
    public UserForm $form;


    public function mount()
    {
        return $this->users;
    }

    public function createUser()
    {
        if (Auth::user()->is_admin != 1) {
            abort(403);
        }

        $this->form->save();
        return redirect(route('users.index'))->with('status', 'User created successfully');
    }


    public function deleteUser(UserModel $user)
    {
        if (Auth::user()->is_admin != 1) {
            abort(403);
        }

        $this->form->delete($user);
        return redirect()->to(route('users.index'))->with('status', 'User deleted successfully');
    }


    public function render()
    {
        $this->users = UserModel::All();
        return view('livewire.user');
    }
}

