<?php
namespace App\Livewire\Forms;

use App\Models\BusinessProfile;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BusinessProfileForm extends Form
{
    public BusinessProfile $profile;

    #[Validate('required|min:5')]
    public $company_name;

    #[Validate('required|min:5|email')]
    public $company_email;

    #[Validate('required|min:5|url')]
    public $website_url;

    #[Locked]
    public $user_id;

    #[Locked]
    public $is_active;

    public function setProfile(BusinessProfile $profile)
    {
        $this->profile = $profile;
        $this->fill($profile->toArray());
    }

    public function save()
    {
        $this->validate();

        $this->profile->fill([
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
            'custom_link_code' => Str::random(20),
            'company_name' => $this->company_name,
            'company_email' => $this->company_email,
            'website_url' => $this->website_url,
        ])->save();

        return $this->profile;
    }
}
