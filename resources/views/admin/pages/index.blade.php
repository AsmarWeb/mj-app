<x-admin>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Pages / List </h2>
                        <span
                            class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">2
                            pages
                        </span>
                    </div>
                </div>

                <div class="flex items-center mt-4 gap-x-3">
                    <a href="{{ route('pages.create') }}"
                        class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <span>{{ __('Add Page') }}</span>
                    </a>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

                </div>
                <div class="bg-gray-200 bg-opacity-25 overflow-scroll px-0 gap-6 lg:gap-8 p-6 lg:p-8">
                    @if (session()->has('message'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                            <span class="font-medium">
                                {{ session()->get('message') }}
                            </span>
                        </div>
                    @endif
                    <div>
                        <table
                            class="mt-4 w-full min-w-max table-auto text-left divide-y divide-gray-200 dark:divide-gray-700">
                            <thead name="head" class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th
                                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                        #
                                    </th>
                                    <th
                                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                        @include('admin.includes.sort-link', [
                                            'label' => 'Name',
                                            'attribute' => 'name',
                                        ])
                                    </th>
                                    <th
                                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                        Title
                                    </th>
                                    <th
                                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                        Slug
                                    </th>
                                    <th
                                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                        Created at
                                    </th>
                                    <th
                                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                        Status
                                    </th>
                                    <th
                                        class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <slot name="body">
                                @foreach ($pages as $page)
                                    <tr>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <div class="flex items-center gap-3">
                                                <a class="text-sm leading-5 text-gray-800">{{ $page->id }}</a>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <div class="flex items-center gap-3">
                                                <a href="#"
                                                    class="no-underline hover:underline text-cyan-600">{{ $page->name }}</a>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <div class="flex items-center gap-3">
                                                <a class="text-sm leading-5 text-gray-800">{{ $page->title }}</a>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <div class="flex items-center gap-3">
                                                <a class="text-sm leading-5 text-gray-800">{{ $page->slug }}</a>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            {{ date('d/m/Y', strtotime($page->created_at)) }}
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            @if ($page->status == 'active')
                                                <span
                                                    class="mr-2 bg-green-600 text-white p-2 rounded  leading-none items-center">Active</span>
                                            @else
                                                <span
                                                    class="mr-2 bg-red-600 text-white p-2 rounded  leading-none items-center">Not
                                                    Active</span>
                                            @endif
                                        </td>
                                        <td class="p-4 border-b border-blue-gray-50">
                                            <form action="{{ route('page.delete', $page->id) }}" method="POST">
                                                <a href="{{ route('pages.edit', $page->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    {{ __('Edit') }}
                                                </a>

                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($pages->isEmpty())
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

                        <div class="py-8">
                            {{ $pages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
