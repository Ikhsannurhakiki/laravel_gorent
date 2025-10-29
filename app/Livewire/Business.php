<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
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
    public mixed $logo = null;

    public string $existingLogoPath = '';

    public ?int $businessId = null;
    public bool $isEdit = false;

    // ── Submit ──────────────────────────────
    public function submitBusiness()
    {
        $this->isEdit ? $this->updateBusiness() : $this->createBusiness();
    }

    // ── Create Business ──────────────────────────
    public function createBusiness(): void
    {
        try {
            $validated = $this->validate();

            if ($this->logo && method_exists($this->logo, 'store')) {
                $validated['logo'] = $this->logo->store('logos', 'public');
            }

            Auth::user()->businesses()->create([
                'name' => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'phone' => $this->phone,
                'logo' => $validated['logo'] ?? null,
            ]);

            $this->resetForm();
            $this->dispatch('businessCreated');
            $this->dispatch('closemodal');
            session()->flash('message', 'Business created successfully.');
        } catch (ValidationException $e) {
            $this->dispatch('validationFailed');
            throw $e;
        }
    }

    // ── Update Business ──────────────────────────
    public function updateBusiness(): void
    {
        $validated = $this->validate();

        $business = Auth::user()->businesses()->findOrFail($this->businessId);

        $logoPath = $this->logo && method_exists($this->logo, 'store')
            ? $this->logo->store('logos', 'public')
            : $business->logo;

        $business->update([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'logo' => $logoPath,
        ]);

        // ✅ Refresh profile/list components
        $this->dispatch('businessUpdated');

        // ✅ Close modal after 150ms delay (so DOM morph settles)
        $this->dispatch('closemodal');

        // ✅ Reset AFTER modal is closed (not before!)
        $this->resetForm();

        session()->flash('message', 'Business updated successfully.');
    }


    // ── Reset Form ──────────────────────────────
    public function resetForm(): void
    {
        $this->reset(['name', 'email', 'address', 'phone', 'logo', 'businessId', 'existingLogoPath']);
        $this->isEdit = false;
    }

    // ── Open Form ───────────────────────────────
    #[On('openbusinessmodal')]
    public function openForm($id = null): void
    {
        // dd('okey');
        if ($id) {
            $this->loadBusiness($id);
            $this->isEdit = true;
        } else {
            $this->resetForm();
            $this->isEdit = false;
        }

        // 🔥 Use a different browser event name so it won’t call itself again
        $this->dispatch($this->isEdit ? 'openbusinessmodalupdate' : 'openbusinessmodalcreate');
    }


    public function loadBusiness($businessId): void
    {
        $business = Auth::user()->businesses()->findOrFail($businessId);

        $this->businessId = $businessId;
        $this->name = $business->name;
        $this->email = $business->email;
        $this->address = $business->address;
        $this->phone = $business->phone;
        $this->existingLogoPath = $business->logo ? asset('storage/' . $business->logo) : '';
    }

    public function render()
    {
        return view('livewire.business');
    }
}
