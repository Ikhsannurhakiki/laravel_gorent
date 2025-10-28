<?php

namespace App\Livewire;

use Livewire\Component;

class AdminBusinessTab extends Component
{

    public $activeTab = 'profile';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }


    public function render()
    {
        return view('livewire.admin-business-tab');
    }
}
