@extends('layouts.admin')
@section('content')
    <slot name="title">
        {{ __('Users') }}
    </slot>

    <div>
        <a href="{{ route('user.index') }}" title="{{ __('Create user') }}">
            {{ __('<< Back to all users') }}</a>
        @if ($errors->any())
            <ul class="mt-3 list-none list-inside text-sm text-red-400">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="w-full py-2 bg-gray-900 overflow-hidden">

        <form method="POST" action="{{ route('user.store') }}">
            @csrf

            <div class="py-2">
                <label for="name" class="{{ $errors->has('name') ? 'text-red-400' : '' }}">
                    {{ __('Name') }}</label>

                <input id="name" class="{{ $errors->has('name') ? 'border-red-400' : '' }}" type="text"
                    name="name" value="{{ old('name') }}" />
            </div>

            <div class="py-2">
                <label for="username" class="{{ $errors->has('username') ? 'text-red-400' : '' }}">
                    {{ __('Username') }}</label>

                <input id="username" class="{{ $errors->has('username') ? 'border-red-400' : '' }}" type="text"
                    name="username" value="{{ old('username') }}" />
            </div>

            <div class="py-2">
                <label for="phone" class="{{ $errors->has('phone') ? 'text-red-400' : '' }}">
                    {{ __('Phone') }}</label>

                <input id="phone" class="{{ $errors->has('phone') ? 'border-red-400' : '' }}" type="tel"
                    name="phone" value="{{ old('phone') }}" />
            </div>

            <div class="py-2">
                <label for="email" class="{{ $errors->has('email') ? 'text-red-400' : '' }}">
                    {{ __('Email') }}</label>

                <input id="email" class="{{ $errors->has('email') ? 'border-red-400' : '' }}" type="email"
                    name="email" value="{{ old('email') }}" />
            </div>

            <div class="py-2">
                <label for="password" class="{{ $errors->has('password') ? 'text-red-400' : '' }}">
                    {{ __('Password') }}</label>

                <input id="password" class="{{ $errors->has('password') ? 'border-red-400' : '' }}" type="password"
                    name="password" />
            </div>

            <div class="py-2">
                <label for="password_confirmation"
                    class="block font-medium text-sm text-gray-700{{ $errors->has('password') ? 'text-red-400' : '' }}">
                    {{ __('Password Confirmation') }}</label>

                <input id="password_confirmation" class="{{ $errors->has('password') ? 'border-red-400' : '' }}"
                    type="password" name="password_confirmation" />
            </div>

            <div class="py-2">
                <h4
                    class="inline-block text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight py-4 sm:inline-block ">
                    Roles</h4>
                <div class="grid grid-cols-4 gap-4">
                    @forelse ($roles as $role)
                        <div class="col-span-4 sm:col-span-2 md:col-span-1">
                            <label class="form-check-label">
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                {{ $role->name }}
                            </label>
                        </div>
                    @empty
                        ----
                    @endforelse
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button>{{ __('Create') }}</button>
            </div>
        </form>
    </div>
@endsection
