<?php

namespace App\Livewire;

use App\Models\BusinessProfile;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class ProfilesListComponent extends Component
{
    use WithPagination;

    public $isActiveFilter = '';
    public $search;


    #[Computed]
    public function profiles()
    {
        return BusinessProfile::query()
            ->with('user')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                        ->orWhere('company_name', 'like', '%' . $this->search . '%')
                        ->orWhere('website_url', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->isActiveFilter !== '', function ($query) {
                $query->where('is_active', $this->isActiveFilter === '1');
            })
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
