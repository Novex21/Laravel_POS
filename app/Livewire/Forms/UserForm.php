<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UserForm extends Form
{
    #[Rule('required')]
    public $name='';

    #[Rule('required')]
    public $email='';

    #[Rule('required')]
    public $phone='';

    #[Rule('required')]
    public $password='';

    #[Rule('required', 'confirmed:password')] ///not working properly
    public $confirm_password='';

    #[Rule('required')]
    public $is_admin='';

    public function updatedPassword() //update event
    {
       $this->password = bcrypt($this->password);
    }

    public function save()
    {
        $this->validate();
        User::create($this->only('name','email','phone','password','is_admin'));
        $this->reset();
        //
    }

    public function delete(User $user)
    {
        if(! $user) {
            return redirect(route('users.index'))->with('error', 'User not Found');
        }
        $user->delete();

    }

    public function update(User $user)
    {
        $this->validate();
        $user->update($this->only('name','email','phone','is_admin'));
        $this->reset();
    }


}
