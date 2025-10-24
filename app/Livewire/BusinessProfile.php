<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Business;
use Livewire\Attributes\On;

class BusinessProfile extends Component
{
    public $business;
    public $businessId;

    public function mount($businessId)
    {
        $this->businessId = $businessId;
        $this->business = Business::findOrFail($businessId);
    }

    #[On('businessUpdated')]
    public function refresh()
    {
        $this->business = Business::findOrFail($this->businessId);
    }

    public function render()
    {
        return view('livewire.business-profile');
    }
}
