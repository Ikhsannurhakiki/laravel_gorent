<div class="flex">
    <ul class="w-60">
        <li><button wire:click="setTab('profile')">Profile</button></li>
        <li><button wire:click="setTab('dashboard')">Dashboard</button></li>
        <li><button wire:click="setTab('units')">Units</button></li>
    </ul>

    <div class="flex-1">
        @if ($activeTab === 'profile')
            <livewire:business-profile :businessId="$business->id" :key="$business->id . '-profile'" />
        @elseif($activeTab === 'dashboard')
            <livewire:dashboard :business="$business" />
        @elseif($activeTab === 'units')
            <livewire:units-table :business="$business" :key="$business->id . '-units'" />
        @endif
    </div>
</div>
