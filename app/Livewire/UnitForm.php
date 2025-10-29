<?php

namespace App\Livewire;

use App\Models\Unit;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class UnitForm extends Component
{

    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|max:100')]
    public string $type = '';

    #[Validate('required|string|max:255')]
    public string $description = '';

    #[Validate('required|numeric|min:0')]
    public $pricePerDay = 0.0;


    #[Validate('required')]
    public bool $isAvailable = true;

    #[Validate('nullable|image|max:2048')] // 2MB Max
    public mixed $thumbnail = null;

    public string $existingThumbnailPath = '';
    public ?int $businessId = null;
    public bool $isEdit = false;

    public function createUnit()
    {
        // Validate all fields
        $validated = $this->validate();

        // Handle file upload
        if ($this->thumbnail && method_exists($this->thumbnail, 'store')) {
            $validated['thumbnail'] = $this->thumbnail->store('unit-thumbnails', 'public');
        }

        // Create unit in database
        Unit::create([
            'business_id'  => $this->businessId,
            'name' => $validated['name'],
            'type' => $validated['type'],
            'description' => $validated['description'],
            'price_per_day' => $validated['pricePerDay'],
            'is_available' => $validated['isAvailable'],
            'thumbnail' => $validated['thumbnail'] ?? null,
        ]);

        // Reset form
        $this->reset(['name', 'type', 'description', 'pricePerDay', 'isAvailable', 'thumbnail']);

        // Optional: dispatch events for modal closing or UI refresh
        $this->dispatch('unitcreated');
        $this->dispatch('closeunitmodal');

        session()->flash('message', 'Unit created successfully!');
    }

    #[On('openunitmodal')]
    public function openForm($businessId = null, $unitId = null): void
    {
        if ($unitId) {
            // $this->loadBusiness($id);
            $this->isEdit = true;
        } else if ($businessId) {
            $this->businessId = $businessId;
            $this->resetForm();
            $this->isEdit = false;
        } else {
            null;
        }

        $this->dispatch($this->isEdit ? 'openunitmodalupdate' : 'openunitmodalcreate');
    }

    // ── Reset Form ──────────────────────────────
    public function resetForm(): void
    {
        $this->reset(['name', 'type', 'description', 'pricePerDay', 'isAvailable', 'thumbnail']);

        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.unit-form');
    }
}
