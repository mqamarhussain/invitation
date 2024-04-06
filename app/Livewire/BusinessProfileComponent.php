<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Mail;
use App\Livewire\Forms\BusinessProfileForm;
use App\Mail\BusinessProfileEmail;
use Illuminate\Support\Facades\Auth;

class BusinessProfileComponent extends Component
{
    public BusinessProfileForm $form;
    public BusinessProfile $profile;

    public function mount()
    {
        $user = Auth::user();
        $this->profile = $user->business_profile ?? new BusinessProfile(['user_id' => $user->id, 'is_active' => true]);
        $this->form->setProfile($this->profile);
    }

    public function submitForm()
    {
        $this->profile = $this->form->save();
        if ($this->profile->is_active) {
            $this->sendCustomLink();
            session()->flash('flash.banner', 'The link has been sent successfully. Please check your email!');
        } else {
            session()->flash('flash.banner', 'Your profile is saved but is not activated yet');
        }
        $this->redirect(route('business_profile'));
    }

    private function sendCustomLink()
    {
        $subject = "Business Profile";
        Mail::to($this->profile->company_email, $this->profile->company_name)
            ->send(new BusinessProfileEmail($subject, $this->profile));
    }

    public function render()
    {
        return view('livewire.business-profile-component');
    }
}
