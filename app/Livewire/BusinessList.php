<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class BusinessList extends Component
{
    public $businesses = [];

    public function mount()
    {
        $this->loadBusinesses();
    }

    #[On('businessCreated')]
    public function refreshList()
    {
        $this->loadBusinesses();
    }

    private function loadBusinesses()
    {
        // Fetch and convert to array so Livewire can detect updates
        $this->businesses = Auth::user()
            ->businesses()
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.business-list', [
            'businesses' => $this->businesses,
        ]);
    }
}
