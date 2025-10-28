<?php

namespace App\Livewire;

use App\Models\Unit;
use Livewire\Component;
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

    #[Validate('required|string|max:255')]
    public float $pricePerDay = 0.0;

    #[Validate('required')]
    public bool $isAvailable = true;

    #[Validate('required|string|max:255')]
    public mixed $thumbnail = null;

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
        $this->dispatch('unitCreated');

        session()->flash('message', 'Unit created successfully!');
    }

    public function openUnitForm()
    {
        dd('okey');
    }

    public function render()
    {
        return view('livewire.unit-form');
    }
}
