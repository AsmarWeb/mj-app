<x-admin>
    <x-slot name="title">
        {{ __('Permissions') }}
    </x-slot>

    <div class="w-full py-2 overflow-hidden">

        <form method="POST" action="{{ route('permission.store') }}">
            @csrf

            <div class="py-2">
                <x-label for="name"
                    class="{{ $errors->has('name') ? 'text-red-400' : '' }}">{{ __('Name') }}</x-label>

                <x-input id="name" class="{{ $errors->has('name') ? 'border-red-400' : '' }}" type="text"
                    name="name" value="{{ old('name') }}" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button>{{ __('Create') }}</x-button>
            </div>
        </form>
    </div>
</x-admin>
