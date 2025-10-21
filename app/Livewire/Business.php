<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Business extends Component
{
    // ── Form Fields ──────────────────────────────
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|max:255')]
    public string $address = '';

    #[Validate('required|string|max:255')]
    public string $phone = '';

    // ── Create Business ───────────────────────────
    public function createBusiness(): void
    {
        try {
            $validated = $this->validate();

            Auth::user()->businesses()->create($validated);

            // Reset form
            $this->reset(['name', 'email', 'address', 'phone']);

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
