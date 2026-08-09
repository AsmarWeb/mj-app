<x-admin>
    <x-slot name="title">
        {{ __('Users') }}
    </x-slot>

    <div class="w-full py-2">

        {{-- ========================================================= --}}
        {{-- USER INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="min-w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <table class="table-fixed w-full text-sm">

                <tbody>

                    {{-- Name --}}
                    <tr>
                        <td class="w-1/3 border-b border-slate-100 p-4 pl-8 font-medium text-slate-500">
                            {{ __('Name') }}
                        </td>

                        <td class="border-b border-slate-100 p-4 text-slate-700 font-semibold">
                            {{ $user->name }}
                        </td>
                    </tr>


                    {{-- Email --}}
                    <tr>
                        <td class="border-b border-slate-100 p-4 pl-8 font-medium text-slate-500">
                            {{ __('Email') }}
                        </td>

                        <td class="border-b border-slate-100 p-4 text-slate-700">
                            {{ $user->email }}
                        </td>
                    </tr>


                    {{-- Roles --}}
                    <tr>
                        <td class="border-b border-slate-100 p-4 pl-8 font-medium text-slate-500">
                            {{ __('Roles') }}
                        </td>

                        <td class="border-b border-slate-100 p-4 text-slate-700">

                            <div class="py-2">

                                <div class="grid grid-cols-4 gap-4">

                                    @forelse ($roles as $role)
                                        <div class="col-span-4 sm:col-span-2 md:col-span-2">

                                            <label class="flex items-center gap-2">

                                                <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                                    {{ in_array($role->id, $userHasRoles) ? 'checked' : '' }} disabled
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm">

                                                <span>
                                                    {{ $role->name }}
                                                </span>

                                            </label>

                                        </div>

                                    @empty

                                        <span class="text-slate-400">
                                            No roles assigned.
                                        </span>
                                    @endforelse

                                </div>

                            </div>

                        </td>
                    </tr>


                    {{-- Created --}}
                    <tr>
                        <td class="border-b border-slate-100 p-4 pl-8 font-medium text-slate-500">
                            {{ __('Created') }}
                        </td>

                        <td class="border-b border-slate-100 p-4 text-slate-700">
                            {{ $user->created_at?->toDateTimeString() }}
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>



        {{-- ========================================================= --}}
        {{-- LOGIN SESSIONS --}}
        {{-- ========================================================= --}}

        <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center
                                   rounded-xl bg-indigo-100 text-xl">

                                🔐

                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-slate-900">
                                    Login Sessions
                                </h3>

                                <p class="text-sm text-slate-500">
                                    Devices and IP addresses currently associated with this user.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Session Count --}}
                    <div>

                        <span
                            class="inline-flex items-center rounded-full
                               bg-indigo-100 px-3 py-1.5
                               text-xs font-bold text-indigo-700">

                            {{ $sessions->count() }}
                            {{ Str::plural('Session', $sessions->count()) }}

                        </span>

                    </div>

                </div>

            </div>



            {{-- Sessions --}}
            @if ($sessions->count())

                <div class="divide-y divide-slate-100">

                    @foreach ($sessions as $session)
                        @php

                            $lastActivity = \Carbon\Carbon::createFromTimestamp($session->last_activity);

                            $isRecent = $lastActivity->gt(now()->subMinutes(30));

                        @endphp


                        <div class="p-6">

                            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">


                                {{-- Device --}}
                                <div class="flex items-start gap-4">

                                    <div
                                        class="flex h-11 w-11 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           {{ $isRecent ? 'bg-green-100 text-green-600' : 'bg-slate-100 text-slate-500' }}">

                                        💻

                                    </div>


                                    <div class="min-w-0">

                                        <div class="flex flex-wrap items-center gap-2">

                                            <h4 class="font-bold text-slate-900">
                                                {{ $session->ip_address ?? 'Unknown IP' }}
                                            </h4>


                                            @if ($isRecent)
                                                <span
                                                    class="inline-flex items-center gap-1
                                                       rounded-full bg-green-100
                                                       px-2 py-1 text-xs
                                                       font-bold text-green-700">

                                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                                    Recent

                                                </span>
                                            @endif

                                        </div>


                                        {{-- User Agent --}}
                                        <p class="mt-1 break-all text-xs text-slate-500">
                                            {{ $session->user_agent ?? 'Unknown device' }}
                                        </p>


                                        {{-- Last Activity --}}
                                        <p class="mt-2 text-xs text-slate-400">

                                            Last activity:
                                            <span class="font-medium text-slate-500">
                                                {{ $lastActivity->diffForHumans() }}
                                            </span>

                                        </p>

                                    </div>

                                </div>


                                {{-- Session Information --}}
                                <div class="flex flex-wrap items-center gap-3 lg:justify-end">

                                    <div
                                        class="rounded-xl bg-slate-50
                                           px-4 py-3">

                                        <p class="text-xs font-medium text-slate-400">
                                            IP Address
                                        </p>

                                        <p class="mt-1 font-mono text-sm font-bold text-slate-700">
                                            {{ $session->ip_address ?? 'Unknown' }}
                                        </p>

                                    </div>


                                    <div
                                        class="rounded-xl bg-slate-50
                                           px-4 py-3">

                                        <p class="text-xs font-medium text-slate-400">
                                            Last Activity
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-slate-700">
                                            {{ $lastActivity->format('M d, Y H:i') }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                {{-- No sessions --}}
                <div class="px-6 py-12 text-center">

                    <div
                        class="mx-auto flex h-14 w-14 items-center
                           justify-center rounded-2xl
                           bg-slate-100 text-2xl">

                        🔒

                    </div>

                    <h4 class="mt-4 font-bold text-slate-900">
                        No active sessions
                    </h4>

                    <p class="mt-1 text-sm text-slate-500">
                        This user currently has no database sessions.
                    </p>

                </div>

            @endif

        </div>



        {{-- ========================================================= --}}
        {{-- SECURITY WARNING --}}
        {{-- ========================================================= --}}

        <div class="mt-6 rounded-2xl border border-amber-200
               bg-amber-50 p-5">

            <div class="flex items-start gap-3">

                <div class="text-xl">
                    ⚠️
                </div>

                <div>

                    <h4 class="font-bold text-amber-900">
                        Security Information
                    </h4>

                    <p class="mt-1 text-sm leading-6 text-amber-800">
                        IP addresses and session information can help identify
                        suspicious activity, but an IP address alone should not
                        be used as proof that a user is attacking the site.
                    </p>

                </div>

            </div>

        </div>

    </div>
</x-admin>
