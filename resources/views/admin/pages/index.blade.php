<x-admin>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">


                <div>

                    <div class="flex items-center gap-3">

                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                            Pages
                        </h2>


                        <span class="px-3 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-full">
                            {{ $pages->total() }} Pages
                        </span>


                    </div>


                    <p class="mt-1 text-sm text-gray-500">
                        Manage website pages
                    </p>


                </div>




                <a href="{{ route('pages.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">


                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />

                    </svg>


                    Add Page

                </a>


            </div>





            {{-- Alert --}}
            @if (session('success'))
                <div class="p-4 mb-5 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif






            <div class="bg-white rounded-xl shadow border overflow-hidden">


                <div class="overflow-x-auto">


                    <table class="w-full text-left">


                        <thead class="bg-gray-50 border-b">


                            <tr>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    #
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    Name
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    Title
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    Slug
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    Created
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    Status
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">
                                    Actions
                                </th>


                            </tr>


                        </thead>





                        <tbody class="divide-y">


                            @forelse($pages as $page)
                                <tr class="hover:bg-gray-50">


                                    <td class="px-6 py-4 text-sm text-gray-700">

                                        {{ $page->id }}

                                    </td>




                                    <td class="px-6 py-4">

                                        <a href="{{ route('pages.edit', $page->id) }}"
                                            class="text-blue-600 hover:underline font-medium">

                                            {{ $page->name }}

                                        </a>

                                    </td>




                                    <td class="px-6 py-4 text-sm text-gray-700">

                                        {{ $page->title }}

                                    </td>




                                    <td class="px-6 py-4">

                                        <span class="px-2 py-1 text-xs bg-gray-100 rounded">

                                            {{ $page->slug }}

                                        </span>

                                    </td>




                                    <td class="px-6 py-4 text-sm text-gray-500">

                                        {{ $page->created_at->format('d/m/Y') }}

                                    </td>





                                    <td class="px-6 py-4">


                                        @if ($page->status == 'published')
                                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                                Published
                                            </span>
                                        @elseif($page->status == 'draft')
                                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                                Draft
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                                Archived
                                            </span>
                                        @endif


                                    </td>






                                    <td class="px-6 py-4 text-right">


                                        <div class="flex justify-end gap-2">


                                            <a href="{{ route('pages.edit', $page->id) }}"
                                                class="px-3 py-1.5 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">

                                                Edit

                                            </a>





                                            <form action="{{ route('page.delete', $page->id) }}" method="POST">

                                                @csrf
                                                @method('DELETE')


                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    class="px-3 py-1.5 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700">

                                                    Delete

                                                </button>


                                            </form>



                                        </div>


                                    </td>



                                </tr>



                            @empty


                                <tr>

                                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">

                                        No pages found

                                    </td>

                                </tr>
                            @endforelse



                        </tbody>


                    </table>


                </div>





                <div class="px-6 py-4 border-t">

                    {{ $pages->links() }}

                </div>



            </div>




        </div>

    </div>


</x-admin>
