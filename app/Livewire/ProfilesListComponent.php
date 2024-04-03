<?php

namespace App\Livewire;

use App\Models\BusinessProfile;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class ProfilesListComponent extends Component
{
    use WithPagination;

    #[Computed]
    public function profiles()
    {
        return BusinessProfile::query()
            ->latest()
            ->paginate(50);
    }

    public function activeProfile(BusinessProfile $profile)
    {
        $profile->update(['is_active' => true]);
        session()->flash('status', 'Business Profile activated successfully.');
    }
    public function inactiveProfile(BusinessProfile $profile)
    {
        $profile->update(['is_active' => false]);
        session()->flash('status', 'Business Profile inactivated successfully.');
    }

    public function render()
    {
        return view('livewire.profiles-list-component');
    }
}
