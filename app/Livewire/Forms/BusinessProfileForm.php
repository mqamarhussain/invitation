<?php

namespace App\Livewire\Forms;

use App\Models\BusinessProfile;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BusinessProfileForm extends Form
{
    public ?BusinessProfile $profile;

    #[Validate('required|min:5')]
    public $company_name = '';

    #[Validate('required|min:5|email')]
    public $company_email = '';

    #[Validate('required|min:5|url')]
    public $website_url = '';



    public function setProfile(BusinessProfile $profile)
    {
        $this->profile = $profile;

        $this->company_name = $profile->company_name;
        $this->company_email = $profile->company_email;
        $this->website_url = $profile->website_url;
    }

    public function save()
    {
        $data = $this->validate();
        $data['is_active'] = true;
        $data['custom_link_code'] = str()->random(20);
        return BusinessProfile::Create($data);
    }

}
