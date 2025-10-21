<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Business extends Component
{
    use WithFileUploads;

    // ── Form Fields ──────────────────────────────
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|max:255')]
    public string $address = '';

    #[Validate('required|string|max:255')]
    public string $phone = '';

    #[Validate('nullable|image|max:2048')] // 2MB Max
    public $logo;

    // ── Create Business ───────────────────────────
    public function createBusiness(): void
    {
        try {
            $validated = $this->validate();

            // Handle logo upload
            if ($this->logo) {
                $validated['logo'] = $this->logo->store('logos', 'public');
            }

            // Create new business
            Auth::user()->businesses()->create([
                'name' => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'phone' => $this->phone,
                'logo' => $validated['logo']
            ]);

            // Reset form
            $this->reset(['name', 'email', 'address', 'phone', 'logo']);

            // Notify front-end
            $this->dispatch('businessCreated');

            // Optional flash message
            session()->flash('message', 'Business created successfully.');
        } catch (ValidationException $e) {
            // Keep modal open on validation failure
            $this->dispatch('validationFailed');
            throw $e;
        }
    }

    // ── Render ────────────────────────────────────
    public function render()
    {
        return view('livewire.business');
    }
}
