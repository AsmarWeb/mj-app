@extends('layouts.admin')
@section('content')
    <slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
        </h2>
        <div>
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm float-right">
                {{ __('Add User') }}
            </a>
        </div>
    </slot>
    <div class="py-2">
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                <span class="font-medium">
                    {{ session()->get('message') }}
                </span>
            </div>
        @endif
        <div class="min-w-full border-b border-gray-200 shadow overflow-x-auto">
            <form method="GET">
                <div class="py-2 flex">
                    <div class="flex pl-2">
                        <input type="search" name="search" value="{{ request()->input('search') }}" class="search-element"
                            placeholder="Search">
                        <button class="btn" type='submit'>
                            <i class="fas fa-search"></i>
                            {{ __('Search') }}
                        </button>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                <slot name="head">
                    <tr>
                        <th>#</th>
                        <th>
                            @include('admin.includes.sort-link', [
                                'label' => 'Name',
                                'attribute' => 'name',
                            ])
                        </th>
                        <th>
                            @include('admin.includes.sort-link', [
                                'label' => 'Email',
                                'attribute' => 'email',
                            ])
                        </th>
                        <th class="py-2 text-center">isBan</th>
                        <th class="py-2 text-center">Status</th>
                        <th class="py-2 text-center">Actions</th>
                        <th class="py-2 text-end">Ban/unBan</th>
                    </tr>
                </slot>
                <slot name="body">
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="text-sm text-gray-900">
                                    <a class="no-underline hover:underline text-cyan-600">{{ $user->id }}</a>
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-gray-900">
                                    <a href="{{ route('user.show', $user->id) }}"
                                        class="no-underline hover:underline text-cyan-600">{{ $user->name }}</a>
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-gray-900">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="py-2 text-center">
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm">
                                        {{ __('Edit') }}
                                    </a>

                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('{{ __('Are you sure you want to delete?') }}') || event.stopImmediatePropagation()">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if ($users->isEmpty())
                        <tr>
                            <td colspan="3">
                                <div class="flex flecol justify-center items-center py-4 text-lg">
                                    {{ __('No Result Found') }}
                                </div>
                            </td>
                        </tr>
                    @endif
                </slot>
            </table>
        </div>
        <div class="py-8">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
