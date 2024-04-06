<div class="w-full px-6 py-4 mx-auto mt-6 overflow-hidden bg-white sm:max-w-md sm:rounded-lg">

    @session('status')
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ $value }}
        </div>
    @endsession

    <form wire:submit="submitForm">

        <div class="mt-4">
            <x-label for="company_name" value="{{ __('Company Name') }}" />
            <x-input id="company_name" class="block w-full mt-1" type="text" wire:model='form.company_name'
                name="company_name" />
            <x-input-error for="form.company_name" />
        </div>
        <div class="mt-4">
            <x-label for="company_email" value="{{ __('Company Email') }}" />
            <x-input id="company_email" class="block w-full mt-1" type="text" wire:model='form.company_email'
                name="company_email" />
            <x-input-error for="form.company_email" />
        </div>
        <div class="mt-4">
            <x-label for="website_url" value="{{ __('Website Url') }}" />
            <x-input id="website_url" class="block w-full mt-1" type="text" wire:model='form.website_url'
                name="website_url" />
            <x-input-error for="form.website_url" />
        </div>

        <div class="mt-3 text-end">
            <p class="hidden mb-4 text-sm font-medium text-orange-800" wire:loading.class.remove="hidden"
                wire:target="submitForm">Sending email, Please wait!</p>
            <x-button wire:loading.disabled>
                {{ __('Submit') }}
            </x-button>
        </div>


    </form>
</div>
