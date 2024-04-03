<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BusinessProfile;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;

class InvitationComponent extends Component
{
    #[Validate('required')]
    public $inputType = 'email';

    #[Validate('required_if:inputType,==,phone')]
    public $phone;

    #[Validate('required_if:inputType,==,email')]
    public $email;

    public $code;

    public function mount($code)
    {
        $this->code = $code;
        BusinessProfile::query()->where('custom_link_code', $code)->firstOrFail();
    }

    public function submit()
    {
        $this->validate();
        $profile = BusinessProfile::query()->where('custom_link_code', $this->code)->firstOrFail();
        ($this->inputType == 'email') ? $this->sendInvitationLinkToMail($profile) : $this->sendInvitationLinkToPhone($profile);
        session()->flash('flash.banner', 'The link has been sent successfully to given your email/phone!');
        $this->redirect(route('custom-link',$this->code), navigate:true);
    }

    private function sendInvitationLinkToMail($profile)
    {

        $data['profile'] = $profile;
        Mail::send('emails.email-invitation-link', $data, function ($m) use ($profile) {
            $m->from(env('MAIL_FROM_ADDRESS'), config('app.name', 'APP Name'));
            $m->to($profile->company_email, $profile->company_name)->subject('Invitation Link!');
        });
    }

    private function sendInvitationLinkToPhone($profile)
    {
        $data['profile'] = $profile;
        // send invitation link to phone
    }


    public function render()
    {
        return view('livewire.invitation-component');
    }
}
