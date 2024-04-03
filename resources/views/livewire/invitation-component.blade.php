<div class="w-full px-6 py-4 mx-auto mt-6 overflow-hidden bg-white sm:max-w-md sm:rounded-lg">

    @session('status')
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ $value }}
        </div>
    @endsession

    <form wire:submit="submit">
        <div class="flex mt-4">

            <div class="items-center flex-1">
                <input wire:model.live='inputType' id="default-radio-2" type="radio" value="email"
                    name="default-radio"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 ">Email</label>
            </div>
            <div class="items-center flex-1">
                <input wire:model.live='inputType' id="default-radio-1" type="radio" value="phone" name="default-radio"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 ">Phone</label>
            </div>
        </div>
        <x-input-error for="inputType" />
        @if ($inputType == 'email')
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" placeholder="{{__('Enter email')}}" class="block w-full mt-1" type="email" wire:model='email'
                    name="email" />
                <x-input-error for="email" />
            </div>
        @endif
        @if ($inputType == 'phone')
            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="phone" placeholder="{{__('Enter phone')}}" class="block w-full mt-1" type="text" wire:model='phone'
                    name="phone" />
                <x-input-error for="phone" />
            </div>
        @endif

        <div class="mt-3 mb-3 text-end">

            <x-button wire:loading.disabled class="ms-4">
                {{ __('Submit') }}
            </x-button>

        </div>

    </form>
</div>
