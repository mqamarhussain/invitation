<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Mail;
use App\Livewire\Forms\BusinessProfileForm;

class BusinessProfileComponent extends Component
{
    public BusinessProfileForm $form;
    public BusinessProfile $profile;
    public function mount()
    {
        // $user_id = auth()->id();
        $this->profile = new BusinessProfile();
        $this->form->setProfile($this->profile);
    }

    public function submitForm()
    {
        $this->profile = $this->form->save();
        $this->sendCustomLink();
        session()->flash('flash.banner', 'The link has been sent successfully, Please check your email!');
        $this->redirect(route('business_profile'), navigate:true);
    }

    private function sendCustomLink()
    {

        $data['profile'] = $this->profile;
        Mail::send('emails.email-custom-link', $data, function ($m) {
            $m->from(env('MAIL_FROM_ADDRESS'), config('app.name', 'APP Name'));
            $m->to($this->profile->company_email, $this->profile->company_name)->subject('Custom Link!');
        });
    }

    public function render()
    {
        return view('livewire.business-profile-component');
    }

}
