<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BusinessList extends Component
{
    public $businesses;

    protected $listeners = ['businessCreated' => 'refreshList'];

    public function mount()
    {
        $this->refreshList();
    }

    public function refreshList()
    {
        $this->businesses = Auth::user()->businesses()->latest()->get();
    }

    public function render()
    {
        return view('livewire.business-list', [
            'businesses' => $this->businesses,
        ]);
    }
}
