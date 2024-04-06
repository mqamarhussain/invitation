<div class="w-full px-6 py-4 mx-auto mt-6 overflow-hidden bg-white sm:rounded-lg">
    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <!-- Filter Form -->
    <form class="mb-4 md:flex md:items-center" wire:submit.prevent="$refresh">
        <div class="flex flex-col mb-2 md:flex-row md:items-center">
            <div>
                <label for="search" class="mr-2 md:mr-4">Search:</label>
                <input wire:model.live.debounce.500ms="search" type="text" id="search"
                    class="mb-2 mr-2 border-gray-300 rounded-lg shadow-sm md:mb-0 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="isActiveFilter" class="mr-2 md:mr-4">Status:</label>
                <select wire:model.live="isActiveFilter" id="isActiveFilter"
                    class="mb-2 mr-2 border-gray-300 rounded-lg shadow-sm md:mb-0 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <x-button type="submit"
                class="px-4 py-2 mt-2 text-white bg-indigo-500 rounded-lg md:mt-0 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                {{ __('Filter') }}
            </x-button>
        </div>
    </form>


    <div class="overflow-x-auto">
        <table class="min-w-full rounded-md table-auto">
            <thead>
                <tr>
                    <th class="p-3 border bg-slate-200">#</th>
                    <th class="p-3 border bg-slate-200">{{ __('User') }}</th>
                    <th class="p-3 border bg-slate-200">{{ __('Company Name') }}</th>
                    <th class="p-3 border bg-slate-200">{{ __('Company Email') }}</th>
                    <th class="p-3 border bg-slate-200">{{ __('Company Website') }}</th>
                    <th class="p-3 border bg-slate-200">{{ __('Custom Link') }}</th>
                    <th class="p-3 border bg-slate-200">{{ __('Is Active') }}</th>
                    <th class="p-3 border bg-slate-200">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->profiles as $index => $profile)
                    <tr>
                        <td class="border">{{ $index + 1 }}</td>
                        <td class="border">{{ $profile->user->name }}</td>
                        <td class="border">{{ $profile->company_name }}</td>
                        <td class="border">{{ $profile->company_email }}</td>
                        <td class="border">
                            <a class="flex justify-center" title="{{ $profile->website_url }}"
                                href="{{ $profile->website_url }}">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                                </svg>
                            </a>
                        </td>
                        <td class="border">
                            <a class="flex justify-center"
                                title="{{ route('custom-link', $profile->custom_link_code) }}"
                                href="{{ route('custom-link', $profile->custom_link_code) }}">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                                </svg>
                            </a>
                        </td>
                        <td class="p-2 border">
                            {{ $profile->is_active ? 'Active' : 'Inactive' }}
                        </td>
                        <td class="border active  class="flex justify-center"">
                            <div class="flex justify-center">

                                @if ($profile->is_active)
                                    <x-danger-button wire:confirm="Are you sure you want to inactive this profile?"
                                        type="button" class="px-1 py-0.5 text-xs"
                                        wire:click='inactiveProfile({{ $profile->id }})'>Inactive</x-danger-button>
                                @else
                                    <x-button type="button"
                                        wire:confirm="Are you sure you want to active this profile?"
                                        class="px-1 py-0.5 text-xs" wire:click='activeProfile({{ $profile->id }})'>
                                        Active
                                    </x-button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7"> No profiles found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        {{ $this->profiles->links() }}
    </div>
</div>
