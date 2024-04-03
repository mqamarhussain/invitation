<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BusinessProfile;
use Livewire\Attributes\Validate;

class RatingComponent extends Component
{
    #[Validate('required|gt:0|lt:6')]
    public $rating = 0;
    public $code;

    public function setRating($r)
    {
        $this->rating = $r;
    }
    public function mount($code)
    {
        $this->code = $code;
        BusinessProfile::query()->where('custom_link_code', $code)->firstOrFail();
    }

    public function submit()
    {
        $this->validate();
        $profile = BusinessProfile::query()->where('custom_link_code', $this->code)->firstOrFail();
        if ($this->rating != 5) {

            return redirect()->to($profile->website_url);
        }

        session()->flash('flash.banner', 'Thanks for your time...');
        $this->redirect(route('business_profile'), navigate: true);
    }

    public function render()
    {
        return view('livewire.rating-component');
    }
}
