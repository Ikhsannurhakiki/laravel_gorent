<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Business  extends Component
{
    public $name, $email, $address, $phone;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:500',
        'phone' => 'nullable|string|max:20',
        // 'description' => 'nullable|string|max:1000',
    ];
    public function createBusiness()
    {
        $this->validate();
        Auth::user()->businesses()->create([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'Business created successfully.');

        // Reset form fields
        $this->reset(['name', 'email', 'address', 'phone']);
        $this->dispatch('businessCreated'); // refresh list component
        $this->dispatch('closeModal'); // trigger JS listener to close modal


    }

    public function render()
    {
        return view('livewire.business');
    }
}
