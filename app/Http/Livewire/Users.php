<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
//    public $id;
    public $name;
    public $email;
    public $phone_number;
    public $created_at;

    public function mount(User $user)
    {

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->created_at = $user->created_at;
    }


    public function render()
    {
        return view('livewire.users');
    }
}
