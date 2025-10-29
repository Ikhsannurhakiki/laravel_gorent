<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Business;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class UnitsTable extends Component
{
    use WithPagination;

    public $query = '';
    public $business; // the Business instance

    protected $paginationTheme = 'tailwind';

    // Livewire mounts the component with a Business model
    public function mount(Business $business)
    {
        $this->business = $business;
    }

    public function search()
    {
        $this->resetPage();
    }

    #[On('unitcreated')]
    public function refreshList()
    {
        $this->loadUnits($this->business->id);
    }

    public function loadUnits($businessId): void
    {
        $this->business->units()
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        $units = $this->business->units()
            ->where('name', 'like', "%{$this->query}%")
            ->latest()
            ->paginate(5);

        return view('livewire.units-table', [
            'units' => $units,
        ]);
    }
}
