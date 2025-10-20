<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Business;

class UnitsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $business; // the Business instance

    protected $paginationTheme = 'tailwind';

    // Livewire mounts the component with a Business model
    public function mount(Business $business)
    {
        $this->business = $business;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $units = $this->business->units()
            ->where('name', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(5);

        return view('livewire.units-table', [
            'units' => $units,
        ]);
    }
}
