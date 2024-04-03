<div class="w-full px-6 py-4 mx-auto mt-6 overflow-hidden bg-white sm:rounded-lg">

    @session('status')
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ $value }}
        </div>
    @endsession
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="border bg-slate-200">#</th>
                    <th class="border bg-slate-200">{{ __('Company Name') }}</th>
                    <th class="border bg-slate-200">{{ __('Company Email') }}</th>
                    <th class="border bg-slate-200">{{ __('Company Website') }}</th>
                    <th class="border bg-slate-200">{{ __('Custom Link') }}</th>
                    <th class="border bg-slate-200">{{ __('Is Active') }}</th>
                    <th class="border bg-slate-200">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->profiles as $index => $profile)
                    <tr>
                        <td class="border text-nowrap ">{{ $index }}</td>
                        <td class="border text-nowrap ">{{ $profile->company_name }}</td>
                        <td class="border text-nowrap ">{{ $profile->company_email }}</td>
                        <td class="border text-nowrap ">{{ substr($profile->website_url, 0, 30) }}</td>
                        <td class="border text-nowrap ">{{ $profile->custom_link_code }}</td>
                        <td class="border text-nowrap active">
                            {{ $profile->is_active ? 'Active' : 'Inactive' }}
                        </td>
                        <td class="border text-nowrap active">
                            @if ($profile->is_active)
                                <x-danger-button wire:confirm="Are you sure you want to inactive this profile?"
                                    type="button" class="px-2 py-1 text-sm"
                                    wire:click='inactiveProfile({{ $profile->id }})'>Inactive</x-danger-button>
                            @else
                                <x-button type="button" wire:confirm="Are you sure you want to active this profile?"
                                    class="px-2 py-1 text-sm"
                                    wire:click='activeProfile({{ $profile->id }})'>
                                    Active</x-button>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7"> No users found!</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <div class="mt-8">

        {{ $this->profiles->links() }}
    </div>
</div>
